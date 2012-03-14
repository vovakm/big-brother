<?php

class Users_model extends CI_Model
{
		public $table = '';
	public $idkey = '';

	function __construct()
	{

		parent::__construct();
		$this->table = $this->db->dbprefix('accounts');
		$this->idkey = 'id_account';
	}

	public function getUserByName($name)
	{
		$query = $this->db->query("
            SELECT `$this->idkey`
            FROM `$this->table`
            WHERE `login` = '{$this->db->escape_str($name)}'
			LIMIT 1
        ");
		$result = $query->row_array();
		if(sizeof($result) == 1)
			return $result[$this->idkey];
		else 
			return FALSE;
	}

}