<?php

class Users_model extends CI_Model
{
<<<<<<< HEAD

    public $table = '';
    public $idkey = '';

    function __construct()
    {

	parent::__construct();
	$this->table = $this->db->dbprefix('accounts');
	$this->idkey = 'id_account';
    }

    public function getUserByName($name)
    {
	$query = $this->db->query("
=======
		public $table = '';
	public $idkey = '';

	function __construct()
	{

		parent::__construct();
		$this->table = $this->db->dbprefix('accounts');
		$this->idkey = 'id_account';
	}

	public function getUserByName($name)
	{
		$query = $this->db->query("
>>>>>>> d7c19a200a2d68b9025e17ce4a23b1e0fa4c76ff
            SELECT `$this->idkey`
            FROM `$this->table`
            WHERE `login` = '{$this->db->escape_str($name)}'
			LIMIT 1
        ");
<<<<<<< HEAD
	$result = $query->row_array();
	if (sizeof($result) == 1)
	    return $result[$this->idkey];
	else
	    return FALSE;
    }
=======
		$result = $query->row_array();
		if(sizeof($result) == 1)
			return $result[$this->idkey];
		else 
			return FALSE;
	}
>>>>>>> d7c19a200a2d68b9025e17ce4a23b1e0fa4c76ff

}