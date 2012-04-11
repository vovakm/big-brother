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

class Search_user_model extends BB_Model
{

	public $table = '';
	public $idkey = '';
	public $suffix = '';

	function __construct()
	{
		parent::__construct();
		$this->table = $this->db->dbprefix($this->db_structure['accounts']['name']);
		$this->idkey = 'id'.$this->db_structure['accounts']['suffix'];
		$this->suffix = $this->db_structure['accounts']['suffix'];
	}

	public function index()
	{
		hash('sha512', 'test');
	}

	public function searchByLogin($login, $start, $limit)
	{

		$usergroup_t = $this->db->dbprefix($this->db_structure['usergroups']['name']);
		$usergroup_s = $this->db_structure['usergroups']['suffix'];
		$usergroup_i = 'id'.$this->db_structure['usergroups']['suffix'];
		//num rows
		$this->db->select("COUNT(`{$this->idkey}`) AS `total`");
		$this->db->like("login{$this->suffix}", $login);
		$count = $this->db->get($this->table);
		$total = $count->result_array();
		
		$this->db->select("
				id{$this->suffix} AS id,
				number_pass{$this->suffix} AS pass_num,
				login{$this->suffix} AS login,
				first_name{$this->suffix} AS f_name,
				middle_name{$this->suffix} AS m_name,
				last_name{$this->suffix} AS l_name,
				name{$usergroup_s} AS user_group,
				account_note{$this->suffix} AS note,
				blocked{$this->suffix} AS block
			");
		$this->db->like("login{$this->suffix}", $login);
		$this->db->join($usergroup_t, "{$usergroup_t}.{$usergroup_i} = {$this->table}.id_usergroup{$this->suffix}", "left");
		
		$this->db->limit($limit, $start);
		
		$query = $this->db->from($this->table);
		$query = $this->db->get();
		return array(
			'num_rows'=>$total[0]['total'],
			'users_array'=>$query->result_array()
				);
	}

	public function searchByLastEdit($start, $limit)
	{

		$usergroup_t = $this->db->dbprefix($this->db_structure['usergroups']['name']);
		$usergroup_s = $this->db_structure['usergroups']['suffix'];
		$usergroup_i = 'id'.$this->db_structure['usergroups']['suffix'];
		
		$this->db->select("
				id{$this->suffix} AS id,
				number_pass{$this->suffix} AS pass_num,
				login{$this->suffix} AS login,
				first_name{$this->suffix} AS f_name,
				middle_name{$this->suffix} AS m_name,
				last_name{$this->suffix} AS l_name,
				name{$usergroup_s} AS user_group,
				account_note{$this->suffix} AS note,
				blocked{$this->suffix} AS block
			");
		//TODO вынести все имена таблиц и суффиксы в CRUD
		$this->db->from($this->table);
		$this->db->order_by("update_date{$this->suffix}", "desc"); 
		$this->db->join($usergroup_t, "{$usergroup_t}.{$usergroup_i} = {$this->table}.id_usergroup{$this->suffix}", "left");

		$this->db->limit($limit, $start);
		$query = $this->db->get();

		return array(
			'num_rows'=>$this->db->count_all_results($this->table),
			'users_array'=>$query->result_array()
				);
	}
}