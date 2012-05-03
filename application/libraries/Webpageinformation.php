<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Web_page_information
{

    private $methodForGetContent = FALSE;
    private $yandexCatalogURL = 'http://yaca.yandex.ua/';
    private $yandexCatalogSearchURL = 'http://yaca.yandex.ua/yca/cat/?text=';

    public function __construct()
    {
        $this->methodForGetContent = $this->checkAvalibleMethods();
    }


    public function getInformation($url)
    {
        $tmp = array();
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
//      Extract site info from META tags
        $content = $this->getPageContent($url);
        $content = $this->convertToUTF8($content);
        $information['title'] = $this->getTitle($content);
        $information['author'] = $this->getAuthor($content);
        $information['baseURL'] = $this->getBaseURL($content);
        $information['description'] = $this->getDescription($content);
        $information['generator'] = $this->getGenerator($content);
        $information['keywords'] = $this->getKeywords($content);
        $information['robots'] = $this->getRobots($content);

//      Get site info from yandex catalog (RUS)
        $information['yaca'] = array();
        preg_match_all("#([a-zA-Z0-9]([a-zA-Z0-9\-]{0,61}[a-zA-Z0-9])?\.)+[a-zA-Z]{2,6}#", $url, $tmp);
        $siteUrl = $tmp[0][0];
        $content = $this->getPageContent($this->yandexCatalogSearchURL . $siteUrl);
        preg_match_all("#\<li.*?\"b-result__item\".*?\>(.*?)\<\/li\>#is", $content, $tmp);
        $firstItem = $tmp[1][0];
        $information['yaca']['location'] = $this->yacaLocation($firstItem);
        $information['yaca']['category'] = $this->yacaCategory($firstItem);
        $information['yaca']['description'] = $this->yacaDescription($firstItem);
        $information['yaca']['title'] = $this->yacaTitle($firstItem);
        return $information;
    }

    public function getPageContent($url)
    {
        if ($this->methodForGetContent === FALSE)
            return FALSE;
        elseif ($this->methodForGetContent === 'file_get_contents') {
            return file_get_contents($url);
        }
        elseif ($this->methodForGetContent === 'fopen') {
            //TODO проверить этот блок. Думаю он может не работать
            $proxy_cont = '';
            $stream = fopen($url, 'r');
            while (!feof($stream)) {
                $proxy_cont .= fread($stream, 4096);
            }
            return $proxy_cont;
        }
        elseif ($this->methodForGetContent === 'curl_init') {

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

    public function checkAvalibleMethods()
    {
        //Here we need to check which one of the methods  will we use to get web page content
        if (function_exists('file_get_contents'))
            return 'file_get_contents'; // use file_get_contents() function to get web content
        elseif (function_exists('curl_init'))
            return 'curl_init'; // use cURL() function to get web content
        else
            if (function_exists('fopen'))
                return 'fopen'; // use cURL() function to get web content
//TODO - получение контента при вызове консольной утилиты wget
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


    private function getTitle($content)
    {
        preg_match_all("#<title>(.*?)<\/title>#i", $content, $tmp);
        return trim($tmp[1][0]);
    }

    private function getDescription($content)
    {
        preg_match_all("#description.*?content=\"(.*?)\"[\s]*?\/\>#i", $content, $tmp);
        if (!empty($tmp[1][0]))
            return trim($tmp[1][0]);
        return FALSE;

    }

    private function getKeywords($content)
    {
        preg_match_all("#name=\"keywords\".*?content=\"(.*?)\"[\s]*?\/\>#i", $content, $tmp);
        if (!empty($tmp[1][0]))
            return trim($tmp[1][0]);
        return FALSE;
    }

    private function getBaseURL($content)
    {
        preg_match_all("#<base.*?href=\"(.*?)\"[\s]*?\/\>#i", $content, $tmp);
        if (!empty($tmp[1][0]))
            return trim($tmp[1][0]);
        return FALSE;
    }

    private function getAuthor($content)
    {
        preg_match_all("#name=\"author\".*?content=\"(.*?)\"[\s]*?\/\>#i", $content, $tmp);
        if (!empty($tmp[1][0]))
            return trim($tmp[1][0]);
        return FALSE;
    }

    private function getGenerator($content)
    {
        preg_match_all("#name=\"generator\".*?content=\"(.*?)\"[\s]*?\/\>#i", $content, $tmp);
        if (!empty($tmp[1][0]))
            return trim($tmp[1][0]);
        return FALSE;
    }

    private function getRobots($content)
    {
        preg_match_all("#name=\"robots\".*?content=\"(.*?)\"[\s]*?\/\>#i", $content, $tmp);
        if (!empty($tmp[1][0]))
            return trim($tmp[1][0]);
        return FALSE;
    }

    private function yacaDescription($content)
    {
        preg_match_all("#b-result__info.*?>(.*?)</p>#i", $content, $tmp);
        $tmp = preg_replace("#<(.*?)>#i", '', $tmp[1][0]);
        if (!empty($tmp))
            return trim($tmp);
        return FALSE;
    }

    private function yacaTitle($content)
    {
        preg_match_all("#b-result__head\"\><a.*?\>(.*?)\<\/a\>\<\/h3\>#i", $content, $tmp);
        $tmp = preg_replace("#<(.*?)>#i", '', $tmp[1][0]);
        if (!empty($tmp))
            return trim($tmp);
        return FALSE;
    }

    private function yacaLocation($content)
    {
        preg_match_all("#b-result__region\"\>(.*?)\<\/a\>.*?b-result__all#i", $content, $tmp);
        if (!empty($tmp[1][0]))
            return trim($tmp[1][0]);
        return FALSE;
    }

    private function yacaCategory($content)
    {
        preg_match_all("#b-result__all.*?b-result__region\"\>(.*?)\<\/a\>#i", $content, $tmp);
        if (!empty($tmp[1][0]))
            return trim($tmp[1][0]);
        return FALSE;
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