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

class Import_account_from_file_model extends BB_Model
{

	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		hash('sha512', 'test');
	}
	
	public function insertUserGroup($name)
	{
		//first we need to check
		$query = $this->db->query("
				SELECT COUNT(*) AS `num`
				FROM {$this->db->dbprefix($this->db_structure['usergroups']['name'])}
				WHERE `name{$this->db_structure['usergroups']['suffix']}` =  '$name'
				");

		
		$total = $query->result_array();
		if($total[0]['num'] == 0)
		{
			//id_usergroup	id_sambagroup_usergroup	name_usergroup	note_usergroup
			$this->db->query("
				INSERT INTO {$this->db->dbprefix($this->db_structure['usergroups']['name'])}
				VALUES(NULL, '1', '{$name}','')
				");
		}
		else
			return FALSE;
	}

}