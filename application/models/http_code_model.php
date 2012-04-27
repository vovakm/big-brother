<?php

/*
 * @copyright	Copyright 2011-2012, Vladimir Kopot, vovakm@mail.ua
 * @license 	Apache/BSD-style open source license
 */

class Http_code_model extends BB_Model
{
	public $table = '';
	public $idkey = '';
	public $suffix = '';

	function __construct()
	{
		parent::__construct();
		$this->table = $this->db->dbprefix($this->db_structure['http_codes']['name']);
		$this->idkey = 'id'.$this->db_structure['http_codes']['suffix'];
		$this->suffix = $this->db_structure['http_codes']['suffix'];
	}
}

