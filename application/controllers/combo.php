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

class Combo extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Combo_model');
	}

	public function index()
	{
		
	}
	public function allUGroups()
	{
		echo json_encode(array(
				'success' => TRUE,
	
				'groups' =>  $this->Combo_model->allUGroups()
			));
	}
	

}