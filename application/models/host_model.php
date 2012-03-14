<?php

/*
 * @copyright	Copyright 2011-2012, Vladimir Kopot, vovakm@mail.ua
 * @license 	Apache/BSD-style open source license
 */

class Host_model extends CI_Model
{

	public $table = '';
	public $idkey = '';

	function __construct()
	{
		parent::__construct();
		$this->table = $this->db->dbprefix('hosts');
		$this->idkey = 'id_host';
	}
	public function getIdByIP($ip, $notes = '')
	{
		$query = $this->db->query("
				SELECT `$this->idkey`
				FROM `$this->table` 
				WHERE `ip_address_host` = '{$ip}'");

		$return = $query->row_array();
		if (sizeof($return) == 0)
			return $this->addNewItem($ip, $notes);
		else
			return $return[$this->idkey];
	}

	/*public function getIdByName($name, $notes = '')
	{
		$query = $this->db->query("
				SELECT `$this->idkey`
				FROM `$this->table` 
				WHERE `name_host` = '{$name}'");

		$return = $query->row_array();
		if (sizeof($return) == 0)
			return $this->addNewItem($name, $notes);
		else
			return $return[$this->idkey];
	}
*/
	public function addNewItem($ip, $notes = '')
	{
		$sql = "INSERT INTO `$this->table` (
			`$this->idkey`, `ip_address_host`, `name_host`, `note_host`, `hit_host`)
			VALUES (
			NULL,'$ip', '', '$notes', 0)";
		$this->db->query($sql);
		return $this->db->insert_id();
	}

	public function getAll($order_by_field_name = 'hit_host', $type_order = 'ASC')
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
				SET `hit_host` = $hits
				WHERE `$this->idkey` = $id");
		$return = $query->result();
		return $return;
	}

}

