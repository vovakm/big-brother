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
		if ($this->input->post('action') !== FALSE && $this->input->post('content') !== FALSE && $this->input->post('type') !== FALSE)
		{
			$a = $this->input->post('action');
			$c = $this->input->post('content');
			$t = $this->input->post('type'); //на данный момент не нужно
			if ($a === 'search-by-login-form')
				return $this->searchUsers($a, $c, $t, $start, $limit);
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
		if ($action === 'search-by-login-form')
			$users = $this->Search_user_model->searchByLogin($content, $start, $limit);
		elseif ($action === 'search-simple-form')
			$users = $this->Search_user_model->searchSimple($content, $start, $limit);
		elseif ($action === 'search-by-pass-form')
			$users = $this->Search_user_model->searchByPass($content, $start, $limit);
		elseif ($action === 'search-by-name-form')
			$users = $this->Search_user_model->searchByName($content, $start, $limit);
		elseif ($action === 'search-advanced-form')
		{
			//$users = $this->Search_user_model->searchByLogin($content, $start, $limit);
		}
		elseif ($action === 'search-by-ugroup-form')
			$users = $this->Search_user_model->searchByGroup($content, $start, $limit);
		
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
