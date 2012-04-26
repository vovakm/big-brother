<?php

class Users_model extends BB_Model
{

	public $table = '';
	public $idkey = '';
	public $suffix = '';

	function __construct()
	{

		parent::__construct();
		$this->table = $this->db->dbprefix($this->db_structure['accounts']['name']);
		$this->idkey = 'id' . $this->db_structure['accounts']['suffix'];
		$this->suffix = $this->db_structure['accounts']['suffix'];
	}

	public function getUserByName($name)
	{
		$query = $this->db->query("
            SELECT `$this->idkey`
            FROM `$this->table`
            WHERE `login{$this->suffix}` = '{$this->db->escape_str($name)}'
			LIMIT 1
        ");
		$result = $query->row_array();
		if (sizeof($result) == 1)
			return $result[$this->idkey];
		else
			return FALSE;
	}
	public function getUserById($id)
	{
		$usergroup_t = $this->db->dbprefix($this->db_structure['usergroups']['name']);
		$usergroup_s = $this->db_structure['usergroups']['suffix'];
		$usergroup_i = 'id' . $this->db_structure['usergroups']['suffix'];
		$status_t = $this->db->dbprefix($this->db_structure['statuses']['name']);
		$status_s = $this->db_structure['statuses']['suffix'];
		$status_i = 'id' . $this->db_structure['statuses']['suffix'];
		$this->db->select("
				id{$this->suffix} AS id,
				number_pass{$this->suffix} AS pass_num,
				login{$this->suffix} AS login,
				password{$this->suffix} AS password,
				first_name{$this->suffix} AS f_name, middle_name{$this->suffix} AS m_name, last_name{$this->suffix} AS l_name,
				name{$usergroup_s} AS user_group,
				name{$status_s} AS status,
				account_note{$this->suffix} AS note,
				blocked{$this->suffix} AS block,
				birthday_date{$this->suffix} AS bday,
				create_date{$this->suffix} AS cday,
				update_date{$this->suffix} AS uday,
				deleted{$this->suffix} AS deleted,
				internet_lock{$this->suffix} AS internet_lock,
				shell{$this->suffix} AS shell,
				access_to_database{$this->suffix} AS access_to_database,
				in_samba{$this->suffix} AS in_samba,
				
				quota{$this->suffix} AS quota
			");
				/*picture{$this->suffix} AS picture,*/
		$this->db->where("id{$this->suffix}", $id);
		$this->db->join($usergroup_t, "{$usergroup_t}.{$usergroup_i} = {$this->table}.id_usergroup{$this->suffix}", "left");
		$this->db->join($status_t, "{$status_t}.{$status_i} = {$this->table}.id_status{$this->suffix}", "left");

		$this->db->limit(1);

		$query = $this->db->from($this->table);
		$query = $this->db->get();
		
		return $query->result_array();
	}

}