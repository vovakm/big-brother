<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');
/*
 * @copyright	Copyright 2011-2012, Vladimir Kopot, vovakm@mail.ua
 * @license 	Apache/BSD-style open source license
 */

if (!function_exists('translit'))
{

	function translit($str)
	{
		
    $tr = array(
		//ua
        'а'=>'a',		'б'=>'b',		'в'=>'v',
		'г'=>'h',		'ґ'=>'g',		'д'=>'d',
		'е'=>'e',		'є'=>'ie',		'ж'=>'zh',
		'з'=>'z',		'и'=>'y',		'і'=>'i',
		'ї'=>'i',		'й'=>'i',		'к'=>'k',
		'л'=>'l',		'м'=>'m',		'н'=>'n',
		'о'=>'o',		'п'=>'p',		'р'=>'r',
		'с'=>'s',		'т'=>'t',		'у'=>'u',
		'ф'=>'f',		'х'=>'kh',		'ц'=>'tc',	
		'ч'=>'ch',		'ш'=>'sh',		'щ'=>'shch',
		'ю'=>'iu',		'я'=>'ia',		'ь'=>'',
		
		//ru
		'ы'=>'y',		'ъ'=>'',
		
		//smbols
		'\''=>'',		'"'=>'',
    );
    return strtr($str,$tr);
	}

}


