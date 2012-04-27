<?php

/*
 *  @author		Vladimir Kopot
 *  @email		vovakop@gmail.com
 *  @copyright	2012
 *  @license	GNU/GPL
 *  @description
 */


class BB_Model extends CI_Model
{
	/* list of tables */
	public $db_structure = array(
		'accounts' => array(
			'name' => 'accounts',
			'suffix' => '_account'
		),
		'content_types' => array(
			'name' => 'content_types',
			'suffix' => '_content_type'
		),
		'hosts' => array(
			'name' => 'hosts',
			'suffix' => '_host'
		),
		'http_codes' => array(
			'name' => 'http_codes',
			'suffix' => '_http_code'
		),
		'http_methods' => array(
			'name' => 'http_methods',
			'suffix' => '_http_method'
		),
		'internet_logs' => array(
			'name' => 'internet_logs',
			'suffix' => '_internet_log'
		),
		'sambagroups' => array(
			'name' => 'sambagroups',
			'suffix' => '_sambagroup'
		),
		'settings' => array(
			'name' => 'settings',
			'suffix' => '_settings'
		),
		'squid_codes' => array(
			'name' => 'squid_codes',
			'suffix' => '_squid_code'
		),
		'squid_hierarchy' => array(
			'name' => 'squid_hierarchy',
			'suffix' => '_squid_hierarchy'
		),
		'statuses' => array(
			'name' => 'statuses',
			'suffix' => '_status'
		),
		'usergroups' => array(
			'name' => 'usergroups',
			'suffix' => '_usergroup'
		)
	);


	/* end tables */

	public $table = '';
	public $idkey = '';
	public $suffix = '';

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function getIdByName($name)
	{

		$this->db->cache_off();
		$this->db->select($this->idkey);
		$this->db->from($this->table);
		$this->db->like("name$this->suffix", $name);
		$this->db->limit(1);
		$query = $this->db->get();
		$return = $query->row_array();

		$this->db->cache_on();
		if (sizeof($return) == 0)
		{
			$er = $this->addNewItem($name);
			return $er;
		}
		else
			return $return[$this->idkey];
	}

	public function addNewItem($name)
	{
		$this->db->set('name'.$this->suffix, $name);
		$this->db->set('hit'.$this->suffix, 1);
		$this->db->insert($this->table);
		return $this->db->insert_id();
	}

	public function getAll($type_order = 'DESC')
	{
		$this->db->cache_off();
		$this->db->select("
			$this->idkey AS id,
			name{$this->suffix} AS name,
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

	public function updateHits($dictionary)
	{
		if (sizeof($dictionary) > 1)
			foreach ($dictionary as $row)
			{
				$this->db->where($this->idkey, $row->id);
				$this->db->update($this->table, array("hit{$this->suffix}" => $row->hit));
			}
	}
}