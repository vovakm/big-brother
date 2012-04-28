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

class Statistic_model extends BB_Model
{

	public $table = '';
	public $idkey = '';
	public $suffix = '';

	function __construct()
	{
		parent::__construct();
		$this->table = $this->db->dbprefix($this->db_structure['internet_logs']['name']);
		$this->idkey = 'id'.$this->db_structure['internet_logs']['suffix'];
		$this->suffix = $this->db_structure['internet_logs']['suffix'];
	}

	public function index()
	{
		hash('sha512', 'test');

	}


	public function usersList($day, $start, $limit)
	{
		$account_t = $this->db->dbprefix($this->db_structure['accounts']['name']);
		$account_s = $this->db_structure['accounts']['suffix'];
		$account_i = 'id'.$this->db_structure['accounts']['suffix'];
		$usergroup_t = $this->db->dbprefix($this->db_structure['usergroups']['name']);
		$usergroup_s = $this->db_structure['usergroups']['suffix'];
		$usergroup_i = 'id'.$this->db_structure['usergroups']['suffix'];

		$this->db->select("
				id_user{$this->suffix} AS id_user,
				number_pass{$account_s} AS pass_num,
				login{$account_s} AS login,
				CONCAT_WS(' ',`last_name{$account_s}` ,  `first_name{$account_s}` ,  `middle_name{$account_s}` ) AS name,
				name{$usergroup_s} AS user_group,
				SUM(transfer_size{$this->suffix}) AS daily_traffic
			");
		$this->db->join($account_t, "{$account_t}.{$account_i} = {$this->table}.id_user{$this->suffix}", "left");
		$this->db->join($usergroup_t, "{$usergroup_t}.{$usergroup_i} = {$account_t}.id_usergroup{$account_s}", "left");
		$this->db->like("event_date{$this->suffix}", $day);
		$this->db->limit($limit, $start);
		$this->db->group_by('id_user'.$this->suffix);
		$this->db->order_by('daily_traffic', 'desc');
		$this->db->from($this->table);
		$query = $this->db->get();
		return $query->result_array();

	}

	public function getUserLastActivityByDay($id_user, $day)
	{
		$hosts_t = $this->db->dbprefix($this->db_structure['hosts']['name']);
		$hosts_s = $this->db_structure['hosts']['suffix'];
		$hosts_i = 'id'.$this->db_structure['hosts']['suffix'];
		$this->db->select("
				event_time{$this->suffix} AS last_activity,
				ip_address{$hosts_s} AS last_active_ip
		");
		$this->db->from($this->table);
		$this->db->join($hosts_t, "{$hosts_t}.{$hosts_i} = {$this->table}.id_host_user{$this->suffix}", 'left');
		$this->db->where('event_date'.$this->suffix, $day);
		$this->db->where('id_user'.$this->suffix, $id_user);
		$this->db->order_by($this->idkey, 'DESC');
		$this->db->limit(1);
		$query = $this->db->get();
		//print_r($this->db);
		return $query->row_array();
//			SELECT *
//			FROM  `ci_internet_logs`
//			WHERE  `id_user_internet_log` = 3991
//			AND  `event_date_internet_log` = '2011-09-01'
//			ORDER BY  `id_internet_log` DESC
//			LIMIT 1
	}

	public function getUserHourlyActivityByDay($id_user, $day)
	{
		$this->db->select("
				SUM(transfer_size{$this->suffix}) AS traffic,
				HOUR(event_time{$this->suffix}) AS hour
		");
		$this->db->from($this->table);
		$this->db->where('event_date'.$this->suffix, $day);
		$this->db->where('id_user'.$this->suffix, $id_user);
		$this->db->group_by(array("HOUR(event_time{$this->suffix})", "id_user{$this->suffix}"));
		$query = $this->db->get();

//		print_r($this->db);
		return $query->result_array();


//				SELECT
//				SUM(`transfer_size`) AS `sum`, HOUR(`event_time`) AS `hour`, `id_user`
//				FROM `ci_internet_logs`
//				WHERE `event_date` =  '$day'
//				GROUP BY  HOUR(`event_time`), `id_user`
	}
}
