<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');
/* 
 *  @author		Vladimir Kopot
 *  @email		vovakop@gmail.com
 *  @copyright	2012
 *  @license	GNU/GPL
 *  @description
 */

class Combo_model extends BB_Model
{

	function __construct()
	{
		parent::__construct();

	}

	public function index()
	{

	}

	public function allUGroups($search, $start, $limit)
	{
		$this->db->select("
				id{$this->db_structure['usergroups']['suffix']} AS id,
				name{$this->db_structure['usergroups']['suffix']} AS name,
			");
		$this->db->from($this->db->dbprefix($this->db_structure['usergroups']['name']));
		$this->db->like("name{$this->db_structure['usergroups']['suffix']}", $search);
		$this->db->limit($limit, $start);
		$query = $this->db->get();

		return $query->result_array();
	}

	public function allUStatuses($search, $start, $limit)
	{
		$this->db->select("
				id{$this->db_structure['statuses']['suffix']} AS id,
				name{$this->db_structure['statuses']['suffix']} AS name,
			");
		$this->db->from($this->db->dbprefix($this->db_structure['statuses']['name']));
		$this->db->like("name{$this->db_structure['statuses']['suffix']}", $search);
		$this->db->limit($limit, $start);
		$query = $this->db->get();

		return $query->result_array();
	}

	public function allSamba($search, $start, $limit)
	{
		$this->db->select("
				id{$this->db_structure['sambagroups']['suffix']} AS id,
				name{$this->db_structure['sambagroups']['suffix']} AS name,
			");
		$this->db->from($this->db->dbprefix($this->db_structure['sambagroups']['name']));
		$this->db->like("name{$this->db_structure['sambagroups']['suffix']}", $search);
		$this->db->limit($limit, $start);
		$query = $this->db->get();

		return $query->result_array();
	}

	public function allShell()
	{
		$query = $this->db->query("SHOW COLUMNS
		FROM {$this->db->dbprefix($this->db_structure['accounts']['name'])}
		WHERE  `Field` =  'shell{$this->db_structure['accounts']['suffix']}'");
		return $query->row_array();
	}

}
