<?php

/*
 * @copyright	Copyright 2011-2012, Vladimir Kopot, vovakm@mail.ua
 * @license 	Apache/BSD-style open source license
 */

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Main extends BB_Controller
{

	public function index()
	{
		$this->load->view('default/head');
		$this->load->view('default/header');
		$this->load->view('default/content');
		$this->load->view('default/footer');
	}
	public function admin()
	{
		$this->load->view('admin/big_brother');
	}
	public function page()
	{
		$this->load->library('Web_page_information');
        echo '<pre>';
        print_r($this->web_page_information->getInformation('http://www.meebo.com/mcmd/send'));
	}


	

}

/* End of file main.php */
/* Location: ./application/controllers/main.php */
