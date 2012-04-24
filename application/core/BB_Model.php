<?php

/*
 *  @author		Vladimir Kopot
 *  @email		vovakop@gmail.com
 *  @copyright	2012
 *  @license	GNU/GPL
 *  @description
 */


class BB_Model extends CI_Model
{
	/* list of tables */
	public $db_structure = array(
			'accounts' => array(
				'name'		=> 'accounts',
				'suffix'	=> '_account'
				),
			'content_types' => array(
				'name'		=> 'content_types',
				'suffix'	=> '_content_type'
				),
			'hosts' => array(
				'name'		=> 'hosts',
				'suffix'	=> '_host'
				),
			'http_codes' => array(
				'name'		=> 'http_codes',
				'suffix'	=> '_http_code'
				),
			'http_methods' => array(
				'name'		=> 'http_methods',
				'suffix'	=> '_http_method'
				),
			'internet_logs' => array(
				'name'		=> 'internet_logs',
				'suffix'	=> '_internet_log'
				),
			'sambagroups' => array(
				'name'		=> 'sambagroups',
				'suffix'	=> '_sambagroup'
				),
			'settings' => array(
				'name'		=> 'settings',
				'suffix'	=> '_settings'
				),
			'squid_codes' => array(
				'name'		=> 'squid_codes',
				'suffix'	=> '_squid_code'
				),
			'squid_hierarchy' => array(
				'name'		=> 'squid_hierarchy',
				'suffix'	=> '_squid_hierarchy'
				),
			'statuses' => array(
				'name'		=> 'statuses',
				'suffix'	=> '_status'
				),
			'usergroups' => array(
				'name'		=> 'usergroups',
				'suffix'	=> '_usergroup'
				)
		);
	

	/* end tables */


	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function index()
	{
		
	}
	

}