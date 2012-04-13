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
	
	public function insertUserGroup($name, $samba_rel = 1)
	{
		//first we need to check
		//id_usergroup	id_sambagroup_usergroup	name_usergroup	note_usergroup
		$query = $this->db->query("
				SELECT `id{$this->db_structure['usergroups']['suffix']}` AS `id`
				FROM {$this->db->dbprefix($this->db_structure['usergroups']['name'])}
				WHERE `name{$this->db_structure['usergroups']['suffix']}` =  '$name'
				");
		$total = $query->result_array();
		if(sizeof($total) == 0)
		{
			//id_usergroup	id_sambagroup_usergroup	name_usergroup	note_usergroup
			$this->db->query("
				INSERT INTO {$this->db->dbprefix($this->db_structure['usergroups']['name'])}
				VALUES(NULL, $samba_rel, '{$name}','')
				");
				return $this->db->insert_id();
		}
		else
			return $total[0]['id'];
	}
	public function insertSambaGroup($name)
	{
		//first we need to check
		//id_sambagroup	name_sambagroup	note_sambagroup
		$query = $this->db->query("
				SELECT id{$this->db_structure['sambagroups']['suffix']} AS `id`
				FROM {$this->db->dbprefix($this->db_structure['sambagroups']['name'])}
				WHERE `name{$this->db_structure['sambagroups']['suffix']}` =  '$name'
				");
		$total = $query->result_array();
		if(sizeof($total) == 0)
		{
			$this->db->query("
				INSERT INTO {$this->db->dbprefix($this->db_structure['sambagroups']['name'])}
				VALUES(NULL, '{$name}','')
				");
				return $this->db->insert_id();
				
		}
		else
			return $total[0]['id'];
	}
	public function getUserGroupsId($name)
	{
		//id_sambagroup	name_sambagroup	note_sambagroup
		$query = $this->db->query("
				SELECT `id{$this->db_structure['usergroups']['suffix']}` AS `ugroup`,
				 `id_sambagroup{$this->db_structure['usergroups']['suffix']}` AS `sgroup`
				FROM {$this->db->dbprefix($this->db_structure['usergroups']['name'])}
				WHERE `name{$this->db_structure['usergroups']['suffix']}` =  '$name'
				");
		$res = $query->result_array();
		if(sizeof($res) == 1)
		{
			return array(
				'ugroup' => $res[0]['ugroup'],
				'sgroup' => $res[0]['sgroup']
			);		
		}
		else
			return FALSE;
	}
	
	public function insertToMain($pass_num,$f_name,$l_name,$m_name,$bdate,$login,$password,$image,$groups)
	{
		
		
		$query = $this->db->query("
				SELECT id{$this->db_structure['accounts']['suffix']} AS `id`
				FROM {$this->db->dbprefix($this->db_structure['accounts']['name'])}
				WHERE `login{$this->db_structure['accounts']['suffix']}` =  '$login'
				");
		$total = $query->result_array();
		if(sizeof($total) == 0)
		$this->db->query("
				INSERT INTO {$this->db->dbprefix($this->db_structure['accounts']['name'])}
				VALUES
				(
				NULL, '$pass_num', 	'1', '{$groups['sgroup']}', '{$groups['ugroup']}', 
				'0', '0', '0', '0','1', 
				'{$this->db->escape_str($l_name)}', '{$this->db->escape_str($f_name)}', '{$this->db->escape_str($m_name)}', '$login', '$password', 
				'$image','/sbin/nologin', '0', '', '$bdate',
				NOW(), NOW());
				");
	}

}