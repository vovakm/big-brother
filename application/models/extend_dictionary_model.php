<?php

/*
 * @copyright	Copyright 2011-2012, Vladimir Kopot, vovakm@mail.ua
 * @license 	Apache/BSD-style open source license
 */

class Extend_dictionary_model extends BB_Model
{
	public $table = '';
	public $idkey = '';
	public $suffix = '';
/*
	function __construct()
	{
		parent::__construct();
		$this->table_base_name = 'content_type';
		$this->table_name = $this->db->dbprefix($this->table_base_name);
		$this->table_id_field = 'id_'.$this->table_base_name;
	}									    
 */
}