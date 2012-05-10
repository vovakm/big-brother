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

class Combo extends BB_Controller
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

		if ($this->input->post('query'))
		{
			$q = $this->input->post('query');
			$start = $this->input->post('start');
			$limit = $this->input->post('limit');
		}
		else
		{
			$q = '';
			$start = 0;
			$limit = 1000;
		}
		echo json_encode(array(
			'success' => TRUE,
			'groups' => $this->Combo_model->allUGroups($q, $start, $limit)
		));
	}

	public function allUStatuses()
	{

		if ($this->input->post('query'))
		{
			$q = $this->input->post('query');
			$start = $this->input->post('start');
			$limit = $this->input->post('limit');
		}
		else
		{
			$q = '';
			$start = 0;
			$limit = 1000;
		}
		echo json_encode(array(
			'success' => TRUE,
			'statuses' => $this->Combo_model->allUStatuses($q, $start, $limit)
		));
	}
	public function allSamba()
	{

		if ($this->input->post('query'))
		{
			$q = $this->input->post('query');
			$start = $this->input->post('start');
			$limit = $this->input->post('limit');
		}
		else
		{
			$q = '';
			$start = 0;
			$limit = 1000;
		}
		echo json_encode(array(
			'success' => TRUE,
			'samba' => $this->Combo_model->allSamba($q, $start, $limit)
		));
	}

	public function allShell()
	{
		$row = $this->Combo_model->allShell();
		preg_match_all('/\'(.*?)\'/', $row['Type'], $enum_array);
		if (!empty($enum_array[1]))
			foreach ($enum_array[1] as  $mval) $enum_fields[] = array('name'=>htmlentities($mval));

		echo json_encode(array(
			'success' => TRUE,
			'shell' => $enum_fields
		));
	}


}