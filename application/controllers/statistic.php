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

class Statistic extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		//$this->load->model('Search_user_model');
	}

	public function index()
	{

		$start = $this->input->post('start');
		$limit = $this->input->post('limit');
		
		if ($this->input->post('content') !== FALSE && $this->input->post('type') !== FALSE)
		{
			$c = $this->input->post('day');
			$t = $this->input->post('type'); //тип отображения статистики
			
			if ($a !== '')
				return json_encode(array(
									   'success'
								   ));
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
	public function searchUsers($action, $content, $type, $start = 0, $limit = 25)
	{
			$users = $this->Search_user_model->searchByParam($action, $content, $start, $limit);
		
		
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
				'users' => array()
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
