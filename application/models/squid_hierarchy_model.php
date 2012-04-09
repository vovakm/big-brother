<?php

/*
 * @copyright	Copyright 2011-2012, Vladimir Kopot, vovakm@mail.ua
 * @license 	Apache/BSD-style open source license
 */

<<<<<<< HEAD
class Squid_hierarchy_model extends MY_Model
{

    public $table_name = '';
    public $table_id_field = '';
    public $table_base_name = '';

    function __construct()
    {
	parent::__construct();
	$this->table_base_name = 'squid_hierarchy';
	$this->table_name = $this->db->dbprefix($this->table_base_name);
	$this->table_id_field = 'id_' . $this->table_base_name;
    }

}
=======
class Squid_hierarchy_model extends CI_Model
{

	public $table = '';
	public $idkey = '';

	function __construct()
	{
		parent::__construct();
		$this->table = $this->db->dbprefix('squid_hierarchy');
		$this->idkey = 'id_squid_hierarchy';
	}

	public function getIdByName($name, $notes = '')
	{
		$query = $this->db->query("
				SELECT `$this->idkey`
				FROM `$this->table` 
				WHERE `name_squid_hierarchy` = '{$name}'");

		$return = $query->row_array();
		if (sizeof($return) == 0)
			return $this->addNewItem($name, $notes);
		else
			return $return[$this->idkey];
	}

	public function addNewItem($name, $notes = '')
	{
		$sql = "INSERT INTO `$this->table` (
			`$this->idkey`, `name_squid_hierarchy`, `note_squid_hierarchy`, `hit_squid_hierarchy`)
			VALUES (
			NULL, '$name', '$notes', 0)";
		$this->db->query($sql);
		return $this->db->insert_id();
	}

	public function getAll($order_by_field_name = 'hit_squid_hierarchy', $type_order = 'ASC')
	{
		$query = $this->db->query("
				SELECT *
				FROM `$this->table` 
				ORDER BY '$order_by_field_name' $type_order");
		$return = $query->result();
		if (sizeof($return) == 0)
			return FALSE;
		else
			return $return;
	}
	public function updateHits($id, $hits)
	{
		$query = $this->db->query("
				UPDATE `$this->table`
				SET `hit_squid_hierarchy` = $hits
				WHERE `$this->idkey` = $id");
		$return = $query->result();
		return $return;
	}

}

>>>>>>> d7c19a200a2d68b9025e17ce4a23b1e0fa4c76ff
