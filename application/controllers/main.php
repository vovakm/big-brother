<?php

/*
 * @copyright	Copyright 2011-2012, Vladimir Kopot, vovakm@mail.ua
 * @license 	Apache/BSD-style open source license
 */

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Main extends CI_Controller
{

	public function index()
	{
		$this->load->library('WebPageInformation');
		echo $this->webpageinformation->getPageContent('http://ya.ru');

		/*
		$this->load->view('default/head');
		$this->load->view('default/header');
		$this->load->view('default/content');
		$this->load->view('default/footer');
		 */
	}

	

}

/* End of file main.php */
/* Location: ./application/controllers/main.php */
