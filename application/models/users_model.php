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
		$this->idkey = 'id'.$this->db_structure['accounts']['suffix'];
		$this->suffix = $this->db_structure['accounts']['suffix'];
	}

	public function getUserByName($name)
	{
		$this->db->select($this->idkey);
		$this->db->from($this->table);
		$this->db->like("login$this->suffix", $name);
		$this->db->limit(1);
		$query = $this->db->get();
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
		$usergroup_i = 'id'.$this->db_structure['usergroups']['suffix'];
		$status_t = $this->db->dbprefix($this->db_structure['statuses']['name']);
		$status_s = $this->db_structure['statuses']['suffix'];
		$status_i = 'id'.$this->db_structure['statuses']['suffix'];
		$this->db->select("
				id{$this->suffix} AS id,
				number_pass{$this->suffix} AS pass_num,
				login{$this->suffix} AS login,
				first_name{$this->suffix} AS f_name, middle_name{$this->suffix} AS m_name, last_name{$this->suffix} AS l_name,
				name{$usergroup_s} AS user_group,
				id_usergroup{$this->suffix} AS id_user_group,
				name{$status_s} AS status,
				id_status{$this->suffix} AS id_status,
				account_note{$this->suffix} AS note,
				blocked{$this->suffix} AS block,
				birthday_date{$this->suffix} AS bday,
				create_date{$this->suffix} AS cday,
				update_date{$this->suffix} AS uday,
				deleted{$this->suffix} AS deleted,
				internet_lock{$this->suffix} AS internet_lock,
				shell{$this->suffix} AS shell,
				access_to_database{$this->suffix} AS access_to_database,
				id_sambagroup{$this->suffix} AS id_samba_group,
				in_samba{$this->suffix} AS in_samba,
				quota{$this->suffix} AS quota
			");
		/*picture{$this->suffix} AS picture,*/
		$this->db->where("id{$this->suffix}", $id);
		$this->db->join($usergroup_t, "{$usergroup_t}.{$usergroup_i} = {$this->table}.id_usergroup{$this->suffix}", "left");
		$this->db->join($status_t, "{$status_t}.{$status_i} = {$this->table}.id_status{$this->suffix}", "left");

		$this->db->limit(1);

		$this->db->from($this->table);
		$query = $this->db->get();

		return $query->result_array();
	}

	public function showPhoto($id_user)
	{
		$this->db->select("picture$this->suffix AS photo");
		$this->db->from($this->table);
		$this->db->where($this->idkey, $id_user);
		$this->db->limit(1);
		$query = $this->db->get();
		$result = $query->row_array();
		if (sizeof($result) == 1)
			return $result['photo'];
		else
			return FALSE;
	}

	public function editUser($ud, $id_account)
	{
		$this->db->where($this->idkey, $id_account);
		$this->db->update($this->table, $ud);
		return TRUE;
	}
	public function createUser($ud)
	{
		$this->db->insert($this->table, $ud);
		return TRUE;
	}
}