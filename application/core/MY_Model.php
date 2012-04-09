<?php

/*
 * @copyright	Copyright 2011-2012, Vladimir Kopot, vovakm@mail.ua
 * @license 	Apache/BSD-style open source license
 */

class MY_Model extends CI_Model
{

	public $table_name = '';
	public $table_id_field = '';
	public $table_base_name = '';

	function __construct()
	{
		parent::__construct();
	}

	public function getIdByName($name)
	{
		$this->db->cache_off();
		$query = $this->db->query("SELECT `{$this->table_id_field}` FROM `{$this->table_name}` WHERE `name_{$this->table_base_name}` = '{$name}' LIMIT 1");
		$return = $query->row_array();
		$this->db->cache_on();
		if (sizeof($return) == 0)
			return $this->addNewItem($name);
		else
			return $return[$this->table_id_field];
	}

	public function addNewItem($name)
	{
		$sql = "INSERT INTO `{$this->table_name}` 
	(`{$this->table_id_field}`, `name_{$this->table_base_name}`, `hit_{$this->table_base_name}`)
	VALUES (
	NULL, '$name', 1)";
		$this->db->query($sql);
		return $this->db->insert_id();
	}

	public function getAll($type_order = 'DESC')
	{
		$this->db->cache_off();
		$query = $this->db->query("SELECT `id_{$this->table_base_name}` AS `id`, `name_{$this->table_base_name}` AS `name`, `hit_{$this->table_base_name}` AS `hit`
	FROM `{$this->table_name}`
	ORDER BY `hit` $type_order");
		$return = $query->result();
		$this->db->cache_on();
		if (sizeof($return) == 0)
			return FALSE;
		else
			return $return;
	}

	public function updateHits($dictionary)
	{
		if (sizeof($dictionary) > 1)
			foreach ($dictionary as $row)
			{
				$sql = "UPDATE `{$this->table_name}` SET `hit_{$this->table_base_name}` = '{$row->hit}' WHERE `id_{$this->table_base_name}` = {$row->id}";
				$this->db->query($sql);
			}
	}

}

