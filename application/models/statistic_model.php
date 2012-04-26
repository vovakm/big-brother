<?php

if ( !defined ('BASEPATH') )
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
		parent::__construct ();
		$this->table = $this->db->dbprefix ($this->db_structure['internet_logs']['name']);
		$this->idkey = 'id' . $this->db_structure['internet_logs']['suffix'];
		$this->suffix = $this->db_structure['internet_logs']['suffix'];
	}

	public function index()
	{
		hash ('sha512', 'test');

	}


	public function usersList($day, $start, $limit)
	{
		$account_t = $this->db->dbprefix ($this->db_structure['accounts']['name']);
		$account_s = $this->db_structure['accounts']['suffix'];
		$account_i = 'id' . $this->db_structure['accounts']['suffix'];
		$usergroup_t = $this->db->dbprefix ($this->db_structure['usergroups']['name']);
		$usergroup_s = $this->db_structure['usergroups']['suffix'];
		$usergroup_i = 'id' . $this->db_structure['usergroups']['suffix'];

		$this->db->select ("
				id_user{$this->suffix} AS id_user,
				number_pass{$account_s} AS pass_num,
				login{$account_s} AS login,
				CONCAT_WS(' ',`last_name{$account_s}` ,  `first_name{$account_s}` ,  `middle_name{$account_s}` ) AS name,
				name{$usergroup_s} AS user_group,
				SUM(transfer_size{$this->suffix}) AS daily_traffic
			");
		$this->db->join ($account_t, "{$account_t}.{$account_i} = {$this->table}.id_user{$this->suffix}", "left");
		$this->db->join ($usergroup_t, "{$usergroup_t}.{$usergroup_i} = {$account_t}.id_usergroup{$account_s}", "left");
		$this->db->like ("event_date{$this->suffix}", $day);
		$this->db->limit ($limit, $start);
		$this->db->group_by('id_user'.$this->suffix);
		$this->db->order_by ('daily_traffic', 'desc');
		$this->db->from ($this->table);
		$query = $this->db->get ();

	}


	public function searchByLogin( $login, $start, $limit )
	{

		$usergroup_t = $this->db->dbprefix ($this->db_structure['usergroups']['name']);
		$usergroup_s = $this->db_structure['usergroups']['suffix'];
		$usergroup_i = 'id' . $this->db_structure['usergroups']['suffix'];
		//num rows
		$this->db->select ("COUNT(`{$this->idkey}`) AS `total`");
		$this->db->like ("login{$this->suffix}", $login);
		$count = $this->db->get ($this->table);
		$total = $count->result_array ();

		$this->db->select ("
				id{$this->suffix} AS id,
				number_pass{$this->suffix} AS pass_num,
				login{$this->suffix} AS login,
				first_name{$this->suffix} AS f_name, middle_name{$this->suffix} AS m_name, last_name{$this->suffix} AS l_name,
				name{$usergroup_s} AS user_group,
				account_note{$this->suffix} AS note,
				blocked{$this->suffix} AS block,
				birthday_date{$this->suffix} AS bday,
				create_date{$this->suffix} AS cday,
				update_date{$this->suffix} AS uday,
				deleted{$this->suffix} AS deleted,
				internet_lock{$this->suffix} AS internet_lock
			");
		$this->db->like ("login{$this->suffix}", $login);
		$this->db->join ($usergroup_t, "{$usergroup_t}.{$usergroup_i} = {$this->table}.id_usergroup{$this->suffix}", "left");

		$this->db->limit ($limit, $start);

		$query = $this->db->from ($this->table);
		$query = $this->db->get ();
		return array(
			'num_rows' => $total[0]['total'],
			'users_array' => $query->result_array ()
		);
	}

}
