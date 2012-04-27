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
		$this->load->model('Statistic_model');
	}

	public function index()
	{

		$start = $this->input->post('start');
		$limit = $this->input->post('limit');

		$users = $this->usersList();

		echo json_encode($users);
		exit;
		if ($this->input->post('content') !== FALSE && $this->input->post('type') !== FALSE)
		{
			$c = $this->input->post('content');
			$t = $this->input->post('type'); //тип отображения статистики


			if ($t == 'users')
			{

			}

//			if ($c !== '')
//				echo json_encode(
//					array(
//						'success' => TRUE,
//						'totalCount' => 2,
//						'users' => array(
//							0 => array(
//								'id_user' => 2,
//								'pass_num' => 123456,
//								'login' => 'pupkin_va',
//								'name' => 'Пупкин В',
//								'user_group' => 'Ю-123',
//								'daily_traffic' => '126.4',
//								'hourly_traffic' => array(
//									array('hour' => 10, 'traffic' => 81.3),
//									array('hour' => 11, 'traffic' => 100.5),
//									array('hour' => 12, 'traffic' => 231.6),
//									array('hour' => 13, 'traffic' => 200.7),
//								),
//								'last_active_ip' => '172.16.5.11',
//								'last_activity' => '15:53:59'
//							),
//							1 => array(
//								'id_user' => 3,
//								'pass_num' => 65823,
//								'login' => 'new_va',
//								'name' => 'New В',
//								'user_group' => 'R-123',
//								'daily_traffic' => '156.4',
//								'hourly_traffic' => array(
//									array('hour' => 14, 'traffic' => 15.3),
//									array('hour' => 15, 'traffic' => 36.5),
//									array('hour' => 16, 'traffic' => 74.6),
//									array('hour' => 17, 'traffic' => 12.7),
//								),
//
//								'last_active_ip' => '172.16.5.21',
//								'last_activity' => '17:30:59'
//							)
//						)
//					)
//				);
//			else
//				echo json_encode(
//					array(
//						'success' => FALSE,
//						'error_code' => 1,
//						'error_msg' => array(
//							'title' => 'Ошибка обращения к серверу',
//							'msg' => 'Не указано действие, которое следует выполнить',
//							'note' => ''
//						)
//					)
//				);
		}
		else
		{
			echo json_encode(
				array(
					'success' => FALSE,
					'error_code' => 1,
					'error_msg' => array(
						'title' => 'Ошибка обращения к серверу',
						'msg' => 'Не указано действие, которое следует выполнить',
						'note' => ''
					)
				)
			);
		}
	}

	public function usersList($day = '2011-09-01', $start = 0, $limit = 50)
	{
//		echo '<pre>';
		//выборка за конкретный день
		//список пользователей
		//информация по каждому пользователю
		$users = $this->Statistic_model->usersList($day, $start, $limit);
		if ($users !== FALSE)
		{
//			echo'<pre>';
			//print_r($users);

			foreach ($users as $key => $value)
			{
//print_r($value->id_user);
				$activity = $this->Statistic_model->getUserLastActivityByDay($value['id_user'], $day);
				$h_traffic = $this->Statistic_model->getUserHourlyActivityByDay($value['id_user'], $day);
//				print_r($h_traffic);
				foreach($h_traffic as $kitem => $item)
					$h_traffic[$kitem]['traffic'] = round($h_traffic[$kitem]['traffic'] / 1024 / 1024, 3);
				$users[$key]['hourly_traffic'] = $h_traffic;
				$users[$key] = array_merge($users[$key], $activity);
				$users[$key]['daily_traffic'] = round($users[$key]['daily_traffic'] / 1024 / 1024, 3);
//				print_r($users[$key]);
//				exit;
			}
			return $users;
		}
		else
		{
			json_encode(array(
				'success' => FALSE,
				'error_code' => 'e1',
				'msg' => printMessage('e1')
			));
		}
	}

}
