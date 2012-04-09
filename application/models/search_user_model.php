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

class Search_user_model extends CI_Model
{

	public $table = '';
	public $idkey = '';
	public $table_sufics = '';

	function __construct()
	{
		parent::__construct();
		$this->table = $this->db->dbprefix('accounts');
		$this->idkey = 'id_accounts';
		$this->table_sufics = '_accounts';
	}

	public function index()
	{
		hash('sha512', 'test');
	}

	public function searchByLogin($login, $start, $limit)
	{
		$ts = $this->table_sufics;
		//num rows
		/*$this->db->select("COUNT(*) AS `total`");
		$this->db->like("login$ts", $login);
		$count = $this->db->get($this->table);
		$total = $count->result_array();*/
		$this->db->select("
				id$ts AS id,
				number_pass$ts AS pass_num,
				login$ts AS login,
				first_name$ts AS f_name,
				middle_name$ts AS m_name,
				last_name$ts AS l_name,
				name_usergroup AS user_group,
				account_note$ts AS note,
				blocked$ts AS block
			");
		//TODO вынести все имена таблиц и суффиксы в CRUD
		$this->db->like("login$ts", $login);
		$this->db->join("ci_usergroups", "ci_usergroups.id_usergroup = $this->table.id_usergroup_accounts", "left");
		
		$this->db->limit($start, $limit);
		
		$query = $this->db->get($this->table);

		return array(
			0=>$this->db->count_all_results(),
			1=>$query->result_array()
				);
	}

	public function searchByLastEdit($start, $limit)
	{

		$ts = $this->table_sufics;
		$this->db->select("
				id$ts AS id,
				number_pass$ts AS pass_num,
				login$ts AS login,
				first_name$ts AS f_name,
				middle_name$ts AS m_name,
				last_name$ts AS l_name,
				name_usergroup AS user_group,
				account_note$ts AS note,
				blocked$ts AS block
			");
		//TODO вынести все имена таблиц и суффиксы в CRUD
		$this->db->from($this->table);
		$this->db->order_by("update_date_accounts", "desc"); 
		$this->db->join("ci_usergroups", "ci_usergroups.id_usergroup = $this->table.id_usergroup_accounts", "left");

		$this->db->limit($limit, $start);
		$query = $this->db->get();

		return array(
			'num_rows'=>$this->db->count_all_results($this->table),
			'users_array'=>$query->result_array()
				);
	}
}