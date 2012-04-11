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
	}

	public function index()
	{
		$rows = file($this->file);
		foreach ($rows as $value)
		{
			$fields = explode($this->sep, $value);
			$users = $this->import_account_from_file_model->insertUserGroup($fields[5]);
			print_r($fields[5]);
			echo '<br/>';
		}
	}

}

