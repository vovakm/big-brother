<?php

/*
 * @copyright	Copyright 2011-2012, Vladimir Kopot, vovakm@mail.ua
 * @license 	Apache/BSD-style open source license
 */

class Settings_model extends MY_Model
{

	public $table = '';
	public $idkey = '';
	public $suffix = '';

	function __construct()
	{
		parent::__construct();
		$this->table = $this->db->dbprefix($this->db_structure['settings']['name']);
		$this->idkey = 'id'.$this->db_structure['settings']['suffix'];
		$this->suffix = $this->db_structure['settings']['suffix'];
	}

	public function getValueByName($name)
	{
		$this->db->cache_off();
		$this->db->select("value{$this->suffix} AS value");

		$this->db->where("name{$this->suffix}", $name);
		$this->db->from($this->table);
		$query = $this->db->get();

		$return = $query->row_array();
		$this->db->cache_on();
		if (sizeof($return) == 0)
			return '0';
		else
			return $return['value'];
	}

	public function setValueByName($name, $value)
	{
		$sql = "UPDATE `{$this->table}` SET `value{$this->suffix}` = '{$value}' WHERE `name{$this->suffix}` = '{$name}'";
		$this->db->query($sql);
		return $this->db->insert_id();
	}

}

