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
<<<<<<< HEAD
=======
		$this->load->library('WebPageInformation');
		echo $this->webpageinformation->getPageContent('http://ya.ru');

		/*
>>>>>>> d7c19a200a2d68b9025e17ce4a23b1e0fa4c76ff
		$this->load->view('default/head');
		$this->load->view('default/header');
		$this->load->view('default/content');
		$this->load->view('default/footer');
<<<<<<< HEAD
	}
	public function admin()
	{
		$this->load->view('admin/big_brother');
=======
		 */
>>>>>>> d7c19a200a2d68b9025e17ce4a23b1e0fa4c76ff
	}

	

}

/* End of file main.php */
/* Location: ./application/controllers/main.php */
