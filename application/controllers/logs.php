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

	public function test()
	{
		$this->load->model('Content_type_model');

		echo $this->Content_type_model->getIdByName('test');
		$tt = $this->Content_type_model->getAll();
		echo '<pre>';
		print_r($tt);
		echo '</pre>';
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
		$this->load->model('Internet_logs_model');
		$this->load->model('Users_model');
		$this->load->model('Settings_model');
		$seek = $this->input->get('seek');
		if ($seek == '')
			$seek = $this->Settings_model->getValueByName('parser_seek_access_file');
//redirect(base_url().current_url().'?seek=asd', 'refresh');
		$path = '/home/vovakm/tmp/access.log';
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


		$this->load->model('Content_type_model');
		$this->load->model('Host_model');
		$this->load->model('Http_code_model');
		$this->load->model('Http_method_model');
		$this->load->model('Squid_code_model');
		$this->load->model('Squid_hierarchy_model');
		// $dictionary = $this->Extend_dictionary_model->getAll();
		$all_content_type = $this->Content_type_model->getAll();
		$all_host = $this->Host_model->getAllIP();
		$all_http_code = $this->Http_code_model->getAll();
		$all_http_method = $this->Http_method_model->getAll();
		$all_squid_code = $this->Squid_code_model->getAll();
		$all_squid_hierarchy = $this->Squid_hierarchy_model->getAll();
;
		$handle = fopen($path, "r");
		$i = 0;
		$k = 0;

		fseek($handle, $seek);
		while ($i < 1000 && !feof($handle))
		{
			$i++;
			$data = array();
			$data = explode(' ', preg_replace('/  +/', ' ', fgets($handle)));
			//print_r($data);
			if (trim($data[0]) != '')
			{

				$data['event_date'] = date('Y-m-d', $data[0]); //date:time
				$data['event_time'] = date('H:i:s', $data[0]); //date:time
			}
			else
				continue;
			$data['duration'] = trim($data[1]); //how long time 
			// host here
			if (sizeof($all_host) > 1) //if database not empty
				$tmp_dictionary = $this->checkInDictionaryCache($all_host, trim($data[2])); // return FALSE if not found on array. return array (id item, line in array) 
			else
				$tmp_dictionary = FALSE;
			if ($tmp_dictionary === FALSE || !isset($tmp_dictionary)) //user ip
				$data['id_host_user'] = $this->Host_model->getIdByIP(trim($data[2]));
			else
			{
				$data['id_host_user'] = $tmp_dictionary[0];
				$all_host[$tmp_dictionary[1]]->hit++;
			}


			//squid code here
			$tmp = explode('/', $data[3]);
			if (trim($tmp[0]) != '')
			{
				if (sizeof($all_squid_code) > 1) //if database not empty
					$tmp_dictionary = $this->checkInDictionaryCache($all_squid_code, trim($tmp[0])); // return FALSE if not found on array. return array (id item, line in array) 
				else
					$tmp_dictionary = FALSE;
				if ($tmp_dictionary === FALSE || !isset($tmp_dictionary))
					$data['id_squid'] = $this->Squid_code_model->getIdByName(trim($tmp[0]));
				else
				{
					$data['id_squid'] = $tmp_dictionary[0];
					$all_squid_code[$tmp_dictionary[1]]->hit++;
				}
			}
			else
				continue;
			if (trim($tmp[1]) != '')
			{
				if (sizeof($all_http_code) > 1) //if database not empty
					$tmp_dictionary = $this->checkInDictionaryCache($all_http_code, trim($tmp[1])); // return FALSE if not found on array. return array (id item, line in array) 
				else
					$tmp_dictionary = FALSE;
				if ($tmp_dictionary === FALSE || !isset($tmp_dictionary))
					$data['id_http_code'] = $this->Http_code_model->getIdByName(trim($tmp[1]));
				else
				{
					$data['id_http_code'] = $tmp_dictionary[0];
					$all_http_code[$tmp_dictionary[1]]->hit++;
				}
			}
			else
				continue;

			if (trim($data[4]) != '')
				$data['size'] = intval(trim($data[4]));
			else
				continue;

			if (trim($data[5]) != '')
			{
				if (sizeof($all_http_method) > 1) //if database not empty
					$tmp_dictionary = $this->checkInDictionaryCache($all_http_method, trim($data[5])); // return FALSE if not found on array. return array (id item, line in array) 
				else
					$tmp_dictionary = FALSE;
				if ($tmp_dictionary === FALSE || !isset($tmp_dictionary))
					$data['id_http_method'] = $this->Http_method_model->getIdByName(trim($data[5]));
				else
				{
					$data['id_http_method'] = $tmp_dictionary[0];
					$all_http_method[$tmp_dictionary[1]]->hit++;
				}
			}
			else
				continue;
			$data['url'] = mysql_real_escape_string(trim($data[6]));

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

				if (sizeof($all_content_type) > 1) //if database not empty
					$tmp_dictionary = $this->checkInDictionaryCache($all_content_type, trim($data[9])); // return FALSE if not found on array. return array (id item, line in array) 
				else
					$tmp_dictionary = FALSE;
				if ($tmp_dictionary === FALSE || !isset($tmp_dictionary))
					$data['id_content_type'] = $this->Content_type_model->getIdByName($this->db->escape_str(trim($data[9])));
				else
				{
					$data['id_content_type'] = $tmp_dictionary[0];
					$all_content_type[$tmp_dictionary[1]]->hit++;
				}
			}
			else
				$data['id_content_type'] = 1;


			$data['id_log_source'] = 1; //$this->Extend_dictionary_model->getIdByName('access.log');
			$data['md5'] = md5($data['event_time'].$data['id_user'].$data['url']);

//if (!$this->Internet_logs_model->findByHash($data['md5']))
			{
				($this->Internet_logs_model->addNewLog($data));
				$k++;
			}
		}
		$this->Content_type_model->updateHits($all_content_type);
		$this->Host_model->updateHits($all_host);
		$this->Http_code_model->updateHits($all_http_code);
		$this->Http_method_model->updateHits($all_http_method);
		$this->Squid_code_model->updateHits($all_squid_code);
		$this->Squid_hierarchy_model->updateHits($all_squid_hierarchy);


		echo $k.'<br/>';
		echo '--------------<br/>';
		echo $i.'<br/>';

		usleep(19000);
//		exit;
		if (!feof($handle))
		{
			$seek = ftell($handle);
			$this->Settings_model->setValueByName('parser_seek_access_file', $seek);
			exit;
			redirect(base_url().current_url().'?seek='.$seek, 'refresh');
		}
		else
			echo 'done';
		fclose($handle);
	}

	public function checkInDictionaryCache($dictionary, $target)
	{
		foreach ($dictionary as $key => $row)
			if ($row->name == $target)
				return array($row->id, $key);
		return FALSE;
	}

	public function getStatByDay($day = '2011-09-15')
	{
		$this->load->model('Internet_logs_model');
		if ($this->input->post('date') != '')
			$day = $this->input->post('date');
		$stat = $this->Internet_logs_model->getSizeByDay($day);
		$result = array();


		echo(json_encode(($stat)));
	}

	public function generateHourlyReport($id_user = 0, $day = 0)
	{
		$this->load->model('Internet_logs_model');
		$stat = $this->Internet_logs_model->getSizeByHour(1, '2011-09-05');
		print_r($stat);
	}

	public function getDataByUser()
	{
		$this->load->model('Internet_logs_model');

		if ($this->input->post('day') != '')
			$day = $this->input->post('day');
		if ($this->input->post('login') != '')
			$login = $this->input->post('login');
		$result = array();


		$hours = $this->Internet_logs_model->getSizeByHour(60174, '2011-09-05');
		//print_r($hours);

		$max = 1;
		foreach ($hours as $value)
			if ($value->h_trafic > $max)
				$max = $value->h_trafic;
		foreach ($hours as $value)
		{
			//if ($value->h_trafic > (float)0.01)
			$result[] = array('hour' => $value->hour, 'trafic' => $value->h_trafic / $max);
		}
		echo json_encode($hours);
	}

	public function allTrffiAllUserDay()
	{
		$this->load->model('Internet_logs_model');
		$this->load->model('Users_model');
		if ($this->input->post('day') != '')
			$day = $this->input->post('day');

		$result = array();
		$day = '2011-09-01';
		$hours = $this->Internet_logs_model->getallTrffiAllUserDay($day);
		//echo '<pre>';
		//print_r($hours);
		$max = 1;
		foreach ($hours as $value)
			if ($value->sum > $max)
				$max = $value->sum;
		foreach ($hours as $value)
		{
			//if ($value->h_trafic > (float)0.01)	
			$result[] = array('hour' => $value->hour, 'sum' => $value->sum / $max, 'user' => $value->id_user);
		}
		echo json_encode($result);
	}

}

/* End of file main.php */
/* Location: ./application/controllers/main.php */
