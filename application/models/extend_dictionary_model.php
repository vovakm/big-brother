<?php

/*
 * @copyright	Copyright 2011-2012, Vladimir Kopot, vovakm@mail.ua
 * @license 	Apache/BSD-style open source license
 */

<<<<<<< HEAD
class Extend_dictionary_model extends MY_Model
{

	public $table_name = '';
	public $table_id_field = '';
	public $table_base_name = '';
/*
	function __construct()
	{
		parent::__construct();
		$this->table_base_name = 'content_type';
		$this->table_name = $this->db->dbprefix($this->table_base_name);
		$this->table_id_field = 'id_'.$this->table_base_name;
	}									    
 */
}
=======
class Extend_dictionary_model extends CI_Model
{

	public $table = '';
	public $idkey = '';

	function __construct()
	{
		parent::__construct();
		$this->table = $this->db->dbprefix('extend_dictionary');
		$this->idkey = 'id_ed';
	}

	public function getIdByName($name, $notes = '')
	{
		$query = $this->db->query("
				SELECT `$this->idkey`
				FROM `$this->table` 
				WHERE `value_ed` = '{$name}'");

		$return = $query->row_array();
		if (sizeof($return) == 0)
			return $this->addNewItem($name, $notes);
		else
			return $return[$this->idkey];
	}

	public function addNewItem($name, $notes = '')
	{
		$sql = "INSERT INTO `$this->table` (
			`$this->idkey`, `value_ed`, `notes_ed`)
			VALUES (
			NULL, '$name', '$notes')";
		$this->db->query($sql);
		return $this->db->insert_id();
	}

	public function addNewLog($data)
	{
		return $query = $this->db->query("
				INSERT INTO `ci_logs` (
				`id_log`, `event_time`, `duration`, 
				`host_ip`, `id_query_code`, `id_query_status`, 
				`transfer_size`, `result_status`, `url`, 
				`id_user`, `id_ident`, `id_type`, 
				`log_source`, `md5`) 
				VALUES (
				NULL,'{$data[0]}','{$data[1]}',
				'{$data[2]}','{$data['id_query_code']}','{$data['id_query_status']}',
				'{$data['size']}','{$data['result_status']}','{$data['url']}',
				'{$data['id_user']}','{$data['id_ident']}','{$data['id_type']}',
				'{$data['id_log_source']}','{$data['md5']}')");
	}

	public function getAll()
	{
		$query = $this->db->query("
				SELECT *
				FROM `$this->table`");
		$return = $query->result();
		if (sizeof($return) == 0)
			return FALSE;
		else
			return $return;
	}

}

>>>>>>> d7c19a200a2d68b9025e17ce4a23b1e0fa4c76ff
