<?php

/*
 * @copyright	Copyright 2011-2012, Vladimir Kopot, vovakm@mail.ua
 * @license 	Apache/BSD-style open source license
 */

class Host_model extends BB_Model
{
	public $table = '';
	public $idkey = '';
	public $suffix = '';

	function __construct()
	{
		parent::__construct();
		$this->table = $this->db->dbprefix($this->db_structure['hosts']['name']);
		$this->idkey = 'id'.$this->db_structure['hosts']['suffix'];
		$this->suffix = $this->db_structure['hosts']['suffix'];
	}


	public function getIdByIP($ip)
	{
		$this->db->cache_off();
		$this->db->select($this->idkey);
		$this->db->from($this->table);
		$this->db->where('ip_address'.$this->suffix, $ip);
		$query = $this->db->get();
		$return = $query->row_array();
		$this->db->cache_on();
		if (sizeof($return) == 0)
			return $this->addNewIP($ip);
		else
			return $return[$this->idkey];
	}

	public function addNewIP($ip)
	{

		$this->db->set('ip_address'.$this->suffix, $ip);
		$this->db->set('name'.$this->suffix, '');
		$this->db->set('hit'.$this->suffix, 1);
		$this->db->insert($this->table);
		return $this->db->insert_id();
	}

	public function getAllIP($type_order = 'DESC')
	{
		$this->db->cache_off();
		$this->db->select("
		$this->idkey AS id,
		ip_address{$this->suffix} AS name,
		hit{$this->suffix} AS hit
		");
		$this->db->from($this->table);
		$this->db->order_by('hit'.$this->suffix, $type_order);
		$query = $this->db->get();
		$return = $query->result();
		$this->db->cache_on();
		if (sizeof($return) == 0)
			return FALSE;
		else
			return $return;
	}

}

