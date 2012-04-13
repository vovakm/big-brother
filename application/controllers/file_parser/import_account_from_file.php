<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');
/*
 *  @author		Vladimir Kopot
 *  @email		vovakop@gmail.com
 *  @copyright	2012
 *  @license	GNU/GPL
 *  @description
 */

class Import_account_from_file extends CI_Controller
{

	public $file = 'tmp/accounts/fileToparselegend/Stud.txt';
	public $sep = ';';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('file_parser/import_account_from_file_model');
		$this->load->helper('translit_helper');

		//12134;Бодрова;Ксенія;Геннадіївна;06.12.1992;БО-118К;D:\Programming\Winter2007\Dekanat\Dekanat\Fotos\12400.jpg;
	}

	public function index()
	{
		$rows = file($this->file);
		foreach ($rows as $value)
		{
			//проходимся по массиву и собираем группы. 
			//после добавляем в БД группы пользователей и самбагруппу.
			//контролируем связь
			$fields = explode($this->sep, $value);
			$ugroups[] = $fields[5];
		}
		$ugroups = array_unique($ugroups);
		$this->insertUserGroup($ugroups);

		foreach ($rows as $value)
		{
			$fields = explode($this->sep, $value);
			if ($fields[0] !== '')
			{
				$pass_num = $fields[0]; //номер пропуска
				$f_name = $fields[2]; //Имя
				$l_name = $fields[1]; //Фамилмя
				$m_name = $fields[3]; //Отчество

				if (function_exists('date_parse_from_format'))
					$bdate = date_parse_from_format("d.m.Y", $fields[4]); //парсинг строки даты  в массив
				else
					$bdate = substr($fields[4], 6, 4) . "-" . substr($fields[4], 0, 2) . "-" . substr($fields[4], 3, 2);


				$bdate = $bdate['year'] . '-' . $bdate['month'] . '-' . $bdate['day']; //собираем строку даты для MySQL
				$login = $this->generateLogin($l_name, $f_name, $m_name); // генерируем логин пользователя
				$photo_file_name = explode('\\', $fields[6]); //разбираем строку пути к файлу
				$image = $this->getImage(end($photo_file_name), 'tmp/accounts/fileToparselegend/Fotos/'); //получаем контент файла картинки
				$password = hash('sha512', $pass_num);
				$groups = $this->import_account_from_file_model->getUserGroupsId($fields[5]);

				//insert data to the main account table
				$this->import_account_from_file_model->insertToMain(
						$pass_num, $f_name, $l_name, $m_name, $bdate, $login, $password, $image, $groups
				);
			}
		}
		echo 'done';
	}

	public function insertUserGroup($ugroups)
	{
		foreach ($ugroups as $ugroup)
		{
			$sgroup = translit(mb_strtolower($ugroup));
			preg_match_all("#^(\w{1,7})*#is", $sgroup, $tmp);
			$sgroup = $tmp[0][0];
			$id_sgroup = $this->import_account_from_file_model->insertSambaGroup($sgroup);
			$this->import_account_from_file_model->insertUserGroup($ugroup, $id_sgroup);
		}
	}

	public function generateLogin($last, $first, $middle)
	{
		$login = translit(mb_strtolower($last));
		$login .= '_';
		$login .= translit(mb_strtolower(substr($first, 0, 2)));
		$login .= translit(mb_strtolower(substr($middle, 0, 2)));
		return $login;
	}

	public function getImage($file_name, $path_to_folder)
	{
		$fname = $path_to_folder . $file_name;
		$file = fopen($fname, "r");
		$image = fread($file, filesize($fname));
		fclose($file);
		return addslashes($image);
	}

}

