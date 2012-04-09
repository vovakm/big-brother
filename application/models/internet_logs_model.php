<?php

/*
 * @copyright	Copyright 2011-2012, Vladimir Kopot, vovakm@mail.ua
 * @license 	Apache/BSD-style open source license
 */

class Internet_logs_model extends CI_Model
{

	public $table = '';
	public $idkey = '';

	function __construct()
	{
		parent::__construct();
		$this->table = $this->db->dbprefix('internet_logs');
		$this->idkey = 'id_log';
	}

	public function index()
	{
		
	}

	public function findByHash($hash)
	{
		$query = $this->db->query("
				SELECT `$this->idkey`
				FROM `$this->table` 
				WHERE `md5` = '{$hash}'");

		$return = $query->row_array();
		//echo $table;
		;
		if (sizeof($return) == 0)
			return FALSE;
		else
			return $return;
	}

	public function addNewLog($data)
	{
		return $query = $this->db->query("
				INSERT INTO `$this->table` (
				`id_log`, `event_date`, `event_time`, `duration`, 
				`id_host_user`, `id_squid`, `id_http_code`, 
				`transfer_size`, `id_http_method`, `url`, 
				`id_user`, `id_squid_hierarchy`, `id_host_requested`, 
				`id_content_type`, `log_source`, `md5`) 
				VALUES (
				NULL,'{$data['event_date']}','{$data['event_time']}','{$data['duration']}',
				'{$data['id_host_user']}','{$data['id_squid']}','{$data['id_http_code']}',
				'{$data['size']}','{$data['id_http_method']}','{$data['url']}',
				'{$data['id_user']}','{$data['id_squid_hierarchy']}','{$data['id_host_requested']}',
				'{$data['id_content_type']}','{$data['id_log_source']}','{$data['md5']}')");
	}

<<<<<<< HEAD
	public function getSizeByDay($day = '2011-09-15')
	{
		$query = $this->db->query("
				SELECT `id_user`,`login`, ROUND(SUM(`transfer_size`)/1024/1024, 3) AS 'trafic', `event_date`
=======
		public function getSizeByDay($day = '2011-09-15')
	{
		$query = $this->db->query("
				SELECT `id_user`,`login`, ROUND(SUM(`transfer_size`)/1024/1024, 3) AS 'trafic'
>>>>>>> d7c19a200a2d68b9025e17ce4a23b1e0fa4c76ff
				FROM `ci_internet_logs`
				LEFT JOIN `myci`.`ci_accounts` ON  `ci_internet_logs`.`id_user` =`ci_accounts`.`id_account` 
				WHERE `event_date` =  '$day'
				GROUP BY `id_user`
				ORDER BY `trafic` DESC");

		$return = $query->result();
		//echo $table;
		;
		if (sizeof($return) == 0)
			return FALSE;
		else
<<<<<<< HEAD
			return $return;
	}

	public function getSizeByHour($id_user, $day)
	{
		$query = $this->db->query("
				SELECT ROUND(SUM(`transfer_size`)/1024/1024, 3) AS 'h_trafic' , HOUR(`event_time`) AS 'hour'
=======
			return $return;	
	}
	
	public function getSizeByHour($id_user, $day)
	{
		$query = $this->db->query("
				SELECT `transfer_size` AS 'h_trafic' , HOUR(`event_time`) AS 'hour'
>>>>>>> d7c19a200a2d68b9025e17ce4a23b1e0fa4c76ff
				FROM `ci_internet_logs`
				WHERE `event_date` =  '$day' 
				AND `id_user` = '$id_user'
				 GROUP BY HOUR(`event_time`)
				");

		$return = $query->result();
		//echo $table;
<<<<<<< HEAD
		
		if (sizeof($return) == 0)
			return FALSE;
		else
			return $return;
	}

	public function getallTrffiAllUserDay($day)
	{
	//SELECT SUM(`transfer_size`), HOUR(`event_time`), `id_user` FROM `ci_internet_logs`  GROUP BY  HOUR(`event_time`), `id_user`	
		$query = $this->db->query("
				SELECT 
				SUM(`transfer_size`) AS `sum`, HOUR(`event_time`) AS `hour`, `id_user` 
				FROM `ci_internet_logs`  
				WHERE `event_date` =  '$day' 
				GROUP BY  HOUR(`event_time`), `id_user`	
				");
		$return = $query->result();
		if (sizeof($return) == 0)
			return FALSE;
		else
			return $return;
=======
		;
		if (sizeof($return) == 0)
			return FALSE;
		else
			return $return;	
>>>>>>> d7c19a200a2d68b9025e17ce4a23b1e0fa4c76ff
	}

}

