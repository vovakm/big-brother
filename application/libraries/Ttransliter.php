<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');
/*
 *  @author		Vladimir Kopot
 *  @email		vovakop@gmail.com
 *  @copyright	2012
 *  @license	GNU/GPL
 *  @description	Библиотека транслитирации укринских и русских символов в символы латинского алфавита.
 *					Приоритет преобразования на украинском языке
 * 					Украинская транслитирация основывается на постановлении Кабинета министров Украины за 27 января 2010
 *					Русская таблица транслитерации основывается на ГОСТ Р 52535.1-2006
 */

class Ttransliter
{
	private $abc = array(
		//ua lowercase
		
		//ua uppercase
		
		//ru lowercase
		
		//ru uppercase
		
		//cyrillic lowercase
		'а'=>'a',	'б'=>'b',	'в'=>'v',	
		'г'=>'h',	'д'=>'d',	'е'=>'e',	
		'ж'=>'zh',	'з'=>'z',	'й'=>'i',	
		'к'=>'k',	'л'=>'l',	'м'=>'v',	
		'н'=>'n',	'о'=>'o',	'п'=>'p',	
		'р'=>'r',	'с'=>'s',	'т'=>'t',	
		'у'=>'u',	'ф'=>'f',	'х'=>'kh',	
		'ц'=>'tc',	'ч'=>'ch',	'ш'=>'sh',	
		'щ'=>'shch',	'ю'=>'iu',	'я'=>'ia',	
				
		//cyrillic upper case
		
	);
	private $ua_lower_abc = array(
		'а'=>'a',		'б'=>'b',		'в'=>'v',
		'г'=>'h',		'ґ'=>'g',		'д'=>'d',
		'е'=>'e',		'є'=>'ie',		'ж'=>'zh',
		'з'=>'z',		'и'=>'y',		'і'=>'i',
		'ї'=>'i',		'й'=>'i',		'к'=>'k',
		'л'=>'l',		'м'=>'v',		'н'=>'n',
		'о'=>'o',		'п'=>'p',		'р'=>'r',
		'с'=>'s',		'т'=>'t',		'у'=>'u',
		'ф'=>'f',		'х'=>'kh',		'ц'=>'tc',	
		'ч'=>'ch',		'ш'=>'sh',		'щ'=>'shch',
		'ю'=>'iu',		'я'=>'ia',		'ь'=>'',
	);
	
	public function __construct()
	{
		
	}

	public function index()
	{
		
	}

}