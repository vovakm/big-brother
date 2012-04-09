<?php

/*
 * @copyright	Copyright 2011-2012, Vladimir Kopot, vovakm@mail.ua
 * @license 	Apache/BSD-style open source license
 */

class Host_model extends MY_Model
{

    public $table_name = '';
    public $table_id_field = '';
    public $table_base_name = '';

    function __construct()
    {
	parent::__construct();
	$this->table_base_name = 'host';
	$this->table_name = $this->db->dbprefix($this->table_base_name);
	$this->table_id_field = 'id_' . $this->table_base_name;
	$this->table_ip_field = 'ip_address_' . $this->table_base_name;
    }

    public function getIdByIP($ip)
    {
	$this->db->cache_off();
	$sql = "SELECT `{$this->table_id_field}` FROM `{$this->table_name}` WHERE `{$this->table_ip_field}` LIKE '{$ip}'";
	$query = $this->db->query($sql);
	$return = $query->row_array();
	$this->db->cache_on();
	if (sizeof($return) == 0)
	    return $this->addNewIP($ip);
	else
	    return $return[$this->table_id_field];
    }

    public function addNewIP($ip)
    {
	$sql = "INSERT INTO `$this->table_name` (
			`$this->table_id_field`, `{$this->table_ip_field}`, `name_{$this->table_base_name}`, `hit_{$this->table_base_name}`)
			VALUES (
			NULL,'{$ip}',  '', 0)";
	$this->db->query($sql);
	return $this->db->insert_id();
    }

    public function getAllIP($type_order = 'DESC')
    {
	$this->db->cache_off();
	$query = $this->db->query("SELECT `id_{$this->table_base_name}` AS `id`, `{$this->table_ip_field}` AS `name`, `hit_{$this->table_base_name}` AS `hit`
	FROM `{$this->table_name}`
	ORDER BY `hit` $type_order");
	$return = $query->result();
	$this->db->cache_on();
	if (sizeof($return) == 0)
	    return FALSE;
	else
	    return $return;
    }

}

