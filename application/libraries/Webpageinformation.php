<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Webpageinformation
{

	private $methodForGetContent = FALSE;

	public function __construct()
	{
		$this->methodForGetContent = $this->checkAvalibleMethods();
	}

	
	public function index($url)
	{
		
		if ($this->methodForGetContent === FALSE)
			return FALSE;
		/*TODO
		 * 1. получить мета чарсет
		 * 2. получить заголовок
		 * 3. получить дескрипшен
		 * 4. получить описание ---- что???
		 * 5. получить базовый урл
		 * 6. расспределить это все дело по переменным
		 * 
		 * 7. есть классификатор, ноплохой от яндекса
		 * 
		 */
		$information = array();
		$content = $this->getPageContent($url);
		$content = $this->convertToUTF8($content);
		echo '<pre>';
		$information['title'] = $this->getTitle($content);
		print_r($information);
			
	}

	public function getPageContent($url)
	{
		if ($this->methodForGetContent === FALSE)
			return FALSE;
		elseif ($this->methodForGetContent === 'file_get_contents')
		{
			return file_get_contents($url);
		}
		elseif ($this->methodForGetContent === 'fopen')
		{
			//TODO проверить этот блок. Думаю он может не работать
			$proxy_cont = '';
			$stream = fopen($url, 'r');
			while(!feof($stream)) {$proxy_cont .= fread($stream,4096);} 
			return $proxy_cont;
		}
		elseif ($this->methodForGetContent === 'curl_init')
		{
			
		}
//TODO - получение контента файла через консольную утилиту wget		
//		elseif ($this->methodForGetContent === 'exec')
//		{
//			$tmp_path = $_SERVER['DOCUMENT_ROOT'] . '/tmp/';
//			if (!is_dir($tmp_path))
//				try
//				{
//					mkdir($tmp_path);
//				} catch (Exception $exc)
//				{
//					return FALSE;
//					echo $exc->getTraceAsString();
//				}
//			exec("wget -O {$tmp_path}.tmp");
//		}
	}

	private function checkAvalibleMethods()
	{
		//Here we need to check which one of the methods  will we use to get web page content
		if (function_exists('file_get_contents'))
			return 'file_get_contents'; // use file_get_contents() function to get web content
		elseif (function_exists('curl_init'))
			return 'curl_init'; // use cURL() function to get web content
		else
			if (function_exists('fopen'))
			return 'fopen'; // use cURL() function to get web content
//TODO - получение контента при вызоче консольной утилиты wget
//		elseif (function_exists('exec'))
//			return 'exec'; // use cURL() function to get web content
		else
			return FALSE; // you need to configure your server and enable one of functions: file_get_contents(), exec(), or cURL extension
	}
	
	private function convertToUTF8($content)
	{
		if (preg_match('#(charset=windows-1251)#', $content))
				$content = iconv('CP1251', 'UTF-8', $content);
		
		return $content;
	}
	private function getCharset($content)
	{	
		$tmp = array();
		preg_match_all('#<title>(.*?)<\/title>#is', $content, $tmp);
		return $tmp;
	}
	private function getTitle($content)
	{	
		return $content;
	}
	private function getBaseURL($content)
	{	
		return $content;
	}
	private function getAuthor($content)
	{	
		return $content;
	}
	private function getGeneranor($content)
	{	
		return $content;
	}

}

/* End of file WebPageInformation.php */







/*
 * 
 * 
 * fopen вариант через прокси
<?php
function preadfile($_url, $_proxy_name = null, $_proxy_port = 4480){
  if(is_null($_proxy_name) || LOCAL_TEST){
    return readfile($_url);
  }else{
    $proxy_cont = '';

    $proxy_fp = pfopen($_url, $_proxy_name, $_proxy_port);
    while(!feof($proxy_fp)) {$proxy_cont .= fread($proxy_fp,4096);}
    fclose($proxy_fp);

    $proxy_cont = substr($proxy_cont, strpos($proxy_cont,"\r\n\r\n")+4);
    echo $proxy_cont;
    return count($proxy_cont);
  }
}
function pfopen($_url, $_proxy_name = null, $_proxy_port = 4480) {
  if(is_null($_proxy_name) || LOCAL_TEST){
    return fopen($_url);
  }else{
    $proxy_fp = fsockopen($_proxy_name, $_proxy_port);
    if (!$proxy_fp) return false;
    $host= substr($_url, 7);
    $host = substr($bucket, 0, strpos($host, "/"));

    $request = "GET $_url HTTP/1.0\r\nHost:$host\r\n\r\n";

    fputs($proxy_fp, $request);

    return $proxy_fp;
  }
}
?>
 */