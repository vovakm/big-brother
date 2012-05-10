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

class Statistic extends BB_Controller
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
		if ($this->input->post('startDate') !== FALSE && $this->input->post('type') !== FALSE)
		{
			$s = $this->input->post('startDate');
			$e = $this->input->post('endDate');
			$t = $this->input->post('type'); //тип отображения статистики
			if ($t == 'users')
				echo json_encode($this->usersList($s, $e, $start, $limit));
			elseif ($t == 'dataByUser')
			{
				$id_user = $this->input->post('uid');
				echo json_encode($this->userHourlyActivity($id_user, $s, $e));
			}
			else
				echo json_encode(
					array(
						'success' => FALSE,
						'error_code' => 'e2',
						'msg' => printMessage('e2')
					)
				);
		}
		else
			echo json_encode(
				array(
					'success' => FALSE,
					'error_code' => 'e3',
					'msg' => printMessage('e3')
				)
			);
	}

	public function usersList($startDate = '2011-09-01', $endDate = '2011-09-01', $start = 0, $limit = 50)
	{
		//выборка за конкретный день
		//список пользователей
		//информация по каждому пользователю
		$users = $this->Statistic_model->usersList($startDate, $endDate, $start, $limit);
		if ($users !== FALSE)
		{
			foreach ($users as $key => $value)
			{
				$activity = $this->Statistic_model->getUserLastActivityByDay($value['id_user'], $startDate, $endDate);
//				$h_traffic = $this->Statistic_model->getUserHourlyActivityByDay($value['id_user'], $day);
//				foreach($h_traffic as $kitem => $item)
//					$h_traffic[$kitem]['traffic'] = round($h_traffic[$kitem]['traffic'] / 1024 / 1024, 3);
//				$users[$key]['hourly_traffic'] = $h_traffic;
				$users[$key] = array_merge($users[$key], $activity);
				$users[$key]['daily_traffic'] = round($users[$key]['daily_traffic'] / 1024 / 1024, 3);
			}
//			echo '<pre>';
//			print_r($users);
			$result['users'] = $users;
			$result['totalCount'] =$this->Statistic_model->countUsers($startDate, $endDate);
			$result['success'] = TRUE;
//			$result['startDate'] = $startDate;
//			$result['endDate'] = $endDate;
			return $result;
		}
		else
			echo json_encode(
				array(
					'success' => FALSE,
					'error_code' => 'e1',
					'msg' => printMessage('e1')
				)
			);
	}

	public function userHourlyActivity($id_user = 3991, $startDate = '2011-09-01', $endDate = '2011-09-01')
	{
		$h_traffic = $this->Statistic_model->getUserHourlyActivityByDay($id_user, $startDate, $endDate);
		$result = array('traffic' => array());
		foreach ($h_traffic as $kitem => $item)
			$h_traffic[$kitem]['traffic'] = round($h_traffic[$kitem]['traffic'] / 1024 / 1024, 3);

		return $h_traffic;
//		echo '<pre>';
//		print_r($h_traffic);

	}

}
