<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class WebPageInformation
{

	private $methodForGetContent = FALSE;

	public function __construct()
	{
		//parent::__construct();
		$this->methodForGetContent = $this->checkAvalibleMethods();
	}

	public function index()
	{
		echo 55;
	}

	public function getPageContent($url)
	{
		if ($this->methodForGetContent === FALSE)
			return FALSE;
		/* elseif ($this->methodForGetContent === 'file_get_contents')
		  {
		  return file_get_contents($url);
		  }
		  elseif ($this->methodForGetContent === 'curl_init')
		  {

		  } */
		else//if ($this->methodForGetContent === 'exec')
		{
			$tmp_path = $_SERVER['DOCUMENT_ROOT'] . '/tmp/';
			if (!is_dir($tmp_path))
				try
				{
					mkdir($tmp_path);
				} catch (Exception $exc)
				{
					return FALSE;
					echo $exc->getTraceAsString();
				}
			exec("wget -O {$tmp_path}.tmp");
		}
	}

	private function checkAvalibleMethods()
	{
		if (function_exists('file_get_contents'))
			return 'file_get_contents'; // use file_get_contents() function to get web content
		elseif (function_exists('curl_init'))
			return 'curl_init'; // use cURL() function to get web content
		elseif (function_exists('exec'))
			return 'exec'; // use cURL() function to get web content
		else
			return FALSE; // you need to configure your server and enable one of functions: file_get_contents(), exec(), or cURL extension
	}

}

/* End of file WebPageInformation.php */
