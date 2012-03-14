<?php

/*
 * @copyright	Copyright 2011-2012, Vladimir Kopot, vovakm@mail.ua
 * @license 	Apache/BSD-style open source license
 */

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Logs extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		echo 'logs controller<pre>';
		$this->load->model('Extend_dictionary_model');
		$tt = $this->Extend_dictionary_model->getAll();
		var_dump($tt);
	}

	public function addInternetLog()
	{
		$seek = $this->input->get('seek');
		if ($seek == '')
			$seek = 0;
//redirect(base_url().current_url().'?seek=asd', 'refresh');
		$path = '/home/vovakm/www/www/parser/access.log';
//0-1310388340.276 
//1-941 
//2-172.16.5.18 
//3-TCP_MISS/200 
//4-10916 
//5-GET 
//6-http://portal.opera.com/ 
//7-miha_admin 
//8-DEFAULT_PARENT/172.16.11.1 
//9-text/html
		$this->load->model('Internet_logs_model');
		$this->load->model('Users_model');
		$this->load->model('Extend_dictionary_model');
		$this->load->model('Content_type_model');
		$this->load->model('Host_model');
		$this->load->model('Http_code_model');
		$this->load->model('Http_method_model');
		$this->load->model('Squid_code_model');
		$this->load->model('Squid_hierarchy_model');
		/*
		  $dictionary = $this->Extend_dictionary_model->getAll();
		  $all_content_type = $this->Content_type_model->getAll();
		  $all_host = $this->Host_model->getAll();
		  $all_http_code = $this->Http_code_model->getAll();
		  $all_http_method = $this->Http_method_model->getAll();
		  $all_squid_code = $this->Squid_code_model->getAll();
		  $all_squid_hierarchy = $this->Squid_hierarchy_model->getAll();
		 */

		$handle = fopen($path, "r");
		$i = 0;
		$k = 0;
		echo '<pre>';
//exit;
		fseek($handle, $seek);
		while ($i < 10000 && !feof($handle))
		{
			$i++;
			$data = array();
			$data = explode(' ', preg_replace('/  +/', ' ', fgets($handle)));
			if (trim($data[0]) != '')
			{

				$data['event_date'] = date('Y-m-d', $data[0]);  //date:time
				$data['event_time'] = date('H:i:s', $data[0]);  //date:time
			}
			else
				continue;
			//if ($data['event_date'] < '2011-11-20')
			//continue;
			$data['duration'] = trim($data[1]); //how long time 
			$data['id_host_user'] = $this->Host_model->getIdByIP(trim($data[2])); //user ip
			$tmp = explode('/', $data[3]);
			if (trim($tmp[0]) != '')
			{
				$data['id_squid'] = $this->Squid_code_model->getIdByName(trim($tmp[0]));
			}
			else
				continue;
			if (trim($tmp[1]) != '')
			{
				$data['id_http_code'] = $this->Http_code_model->getIdByName(trim($tmp[1]));
			}
			else
				continue;
			if (trim($data[4]) != '')
				$data['size'] = intval(trim($data[4]));
			else
				continue;
			if (trim($data[5]) != '')
			{
				$data['id_http_method'] = $this->Http_method_model->getIdByName(trim($data[5]));
			}
			else
				continue;
			$data['url'] = (trim($data[6]));

			if (trim($data[7]) != '')
			{
				$data['id_user'] = $this->Users_model->getUserByName(trim($data[7]));
				if ($data['id_user'] === FALSE)
					continue;
			}
			else
				continue;

			if (trim($data[8]) != '')
			{
				$tmp = explode('/', $data[8]);
				if (trim($tmp[0]) != '')
				{
					$data['id_squid_hierarchy'] = $this->Squid_hierarchy_model->getIdByName(trim($tmp[0]));
				}
				else
					continue;
				if (trim($tmp[1]) != '')
				{
					$data['id_host_requested'] = $this->Host_model->getIdByIP(trim($tmp[1])); //user ip
				}
				else
					continue;
			}
			else
				continue;
			if (trim($data[9]) != '' && trim($data[9]) != '-')
			{

				$data['id_content_type'] = $this->Content_type_model->getIdByName($this->db->escape_str(trim($data[9])));
			}
			else
				$data['id_content_type'] = 1;


			$data['id_log_source'] = 1; //$this->Extend_dictionary_model->getIdByName('access.log');
			$data['md5'] = md5($data['event_time'] . $data['id_user'] . $data['url']);

//if (!$this->Internet_logs_model->findByHash($data['md5']))
			{
				($this->Internet_logs_model->addNewLog($data));
				$k++;
			}
		}
		echo $k . '<br/>';
		echo '--------------<br/>';
		echo $i . '<br/>';
		usleep(1000000);
		if (!feof($handle))
		{
			$seek = ftell($handle);
			redirect(base_url() . current_url() . '?seek=' . $seek, 'refresh');
		}
		else
			echo 'done';
		fclose($handle);
	}

	public function checkInDictionaryCache($dictionary, $target)
	{
		foreach ($dictionary as $row)
			if ($row->value_ed == $target)
				return $row->id_ed;
		return FALSE;
	}

	public function getStatByDay($day = '2011-09-15')
	{
		$this->load->model('Internet_logs_model');
		$stat = $this->Internet_logs_model->getSizeByDay($day);
		//echo '<pre>';
		$result = array();
		foreach ($stat as $key => $row)
		{
			//$stat[$key]->hours = $this->Internet_logs_model->getSizeByHour($row->id_user, $day);
			$stat[$key]->h_name = array();
			$stat[$key]->h_trafic = array();

			$hours = $this->Internet_logs_model->getSizeByHour($row->id_user, $day);
			foreach ($hours as $value)
			{
				array_push($stat[$key]->h_name, $value->hour);
				array_push($stat[$key]->h_trafic, $value->h_trafic);
			}

			//print_r($stat[$key]);
			//exit;
			//array_push($stat[$key], array('hours'=>($this->Internet_logs_model->getSizeByHour($row->id_user, $day))));
			//var_dump(json_encode(($row)));
		}



		echo(json_encode(($stat)));
	}

	public function generateHourlyReport($id_user, $day)
	{
		$this->load->model('Internet_logs_model');
		$stat = $this->Internet_logs_model->getSizeByHour($id_user, $day);
	}

}

/* End of file main.php */
/* Location: ./application/controllers/main.php */
