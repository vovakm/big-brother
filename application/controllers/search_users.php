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

class Search_users extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Search_user_model');
	}

	public function index()
	{

		$start = $this->input->post('start');
		$limit = $this->input->post('limit');
		if (
				
				$this->input->post('action') !== FALSE && //вызываемый метод
				$this->input->post('content') !== FALSE && //данные для поиска
				$this->input->post('type') !== FALSE  // тип передаваемых данных (строка, массив)
		)
		{
			$a = $this->input->post('action');
			$p = $this->input->post('content');
			$a = 'sblog';
			$t = $this->input->post('type'); //на данный момент не нужно
			if ($a === 'sblog')
				return $this->searchByLogin($p, $start, $limit);
			elseif ($a === 'sbfio')
			{
				return $this->searchByLogin($p, $start, $limit);
			}
			else
				return json_encode(array(
							'success' => FALSE,
							'error_code' => 1,
							'error_msg' => array(
								'title' => 'Ошибка обращения к серверу',
								'msg' => 'Не указано действие, которое следует выполнить',
								'note' => ''
							)
						));
		}
		else
		{
			$content = $this->searchByLastEdit($start, $limit);
		}
	}

	public function searchByLogin($login = '', $start = 0, $limit = 50)
	{
		$users = $this->Search_user_model->searchByLogin($login, $start, $limit);
		if ($users !== FALSE)
			echo json_encode(array(
				'success' => TRUE,
				'totalCount' => $users[0],
				'users' => $users[1]
			));
		else
			echo json_encode(array(
				'success' => TRUE,
				'totalCount' => 0,
				'users' => FALSE
			));
	}
	
	public function searchByLastEdit($start = 0, $limit = 25)
	{
		$users = $this->Search_user_model->searchByLastEdit($start, $limit);
		if ($users !== FALSE)
			echo json_encode(array(
				'success' => TRUE,
				'totalCount' => $users['num_rows'],
				'users' => $users['users_array']
			));
		else
			echo json_encode(array(
				'success' => TRUE,
				'totalCount' => 0,
				'users' => FALSE
			));
	}

}
