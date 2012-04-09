<?php

/*
 * @copyright	Copyright 2011-2012, Vladimir Kopot, vovakm@mail.ua
 * @license 	Apache/BSD-style open source license
 */

class Crud extends CI_Model
{
	public $table = '';
	public $idkey = '';

	function __construct()
	{
		parent::__construct();
	}

	public function getObjectByID($id)
	{
		$this->db->where($this->idkey, $id);
		$query = $this->db->get($this->table);
		return $query->row();
	}

}

