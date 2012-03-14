<?php

/*
 * @copyright	Copyright 2011-2012, Vladimir Kopot, vovakm@mail.ua
 * @license 	Apache/BSD-style open source license
 */

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Create_account extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('translit_helper');
		
	}

	public function index()
	{
		echo '42';
	}
	
	public function userInDataBase()
	{
		$name = $this->input->post('name');
		$login = translit($name);
		echo json_encode(array('status' => 'ok', 'login' => $login));
	}


}

/* End of file create_account.php */
/* Location: ./application/controllers/create_account.php */
