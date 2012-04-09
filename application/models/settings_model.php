<?php

/*
 * @copyright	Copyright 2011-2012, Vladimir Kopot, vovakm@mail.ua
 * @license 	Apache/BSD-style open source license
 */

class Settings_model extends MY_Model
{

    public $table_name = '';
    public $table_id_field = '';
    public $table_base_name = '';

    function __construct()
    {
	parent::__construct();
	$this->table_base_name = 'settings';
	$this->table_name = $this->db->dbprefix($this->table_base_name);
	$this->table_id_field = 'id_' . $this->table_base_name;
    }

    public function getValueByName($name)
    {
	$this->db->cache_off();
	$query = $this->db->query("SELECT `value_{$this->table_base_name}` AS `value` FROM `{$this->table_name}` WHERE `name_{$this->table_base_name}` = '{$name}' LIMIT 1");
	$return = $query->row_array();
	$this->db->cache_on();
	if (sizeof($return) == 0)
	    return '0';
	else
	    return $return['value'];
    }

    public function setValueByName($name, $value)
    {
	$sql = "UPDATE `{$this->table_name}` SET `value_{$this->table_base_name}` = '{$value}' WHERE `name_{$this->table_base_name}` = '{$name}'";
	$this->db->query($sql);
	return $this->db->insert_id();
    }

}

