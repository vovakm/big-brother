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
	public function allUgroups()
	{
		$this->db->select("
				id{$this->db_structure['usergroups']['suffix']} AS id,
				name{$this->db_structure['usergroups']['suffix']} AS name,
			");
		$query = $this->db->from($this->db->dbprefix($this->db_structure['usergroups']['name']));
		$query = $this->db->get();
		
		return $query->result_array();
	}
	
	}
