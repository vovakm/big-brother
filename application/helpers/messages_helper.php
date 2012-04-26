<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');
/*
 * @copyright	Copyright 2011-2012, Vladimir Kopot, vovakm@mail.ua
 * @license 	Apache/BSD-style open source license
 */

if (!function_exists('printMessage'))
{

	function printMessage($event)
	{
		$messages = array(
			'errorLoginValidation' => 'Не заполнено одно из полей',
			'accessToDatabaseDeny' => 'Не найдено пользователя с таким логином и паролем',
			'menu-item-short-manage-user' => 'Пользователи',
			'menu-item-full-manage-user' => 'Управление пользователями',
			'menu-item-short-statistic' => 'Статистика',
			'menu-item-full-statistic' => '',
			'menu-item-short-advanced' => 'Дополнительно',
			'menu-item-full-advanced' => 'Дополнительные функции',
			'menu-item-short-bday' => 'Статистика',
			'menu-item-full-bday' => '',
			'menu-item-short-userinfo' => 'Информация',
			'menu-item-full-userinfo' => 'Информация о пользователе',
			'menu-item-short-editpass' => 'Сменить пароль',
			'menu-item-full-editpass' => '',
			'menu-item-short-about' => 'О системе',
			'menu-item-full-about' => 'Общая информация о системе',

			/* коды ошибок */
			'e0' => '',
			'e1' => 'Ошибка обращения к серверу баз данных',
			'e2' => '',
			'e3' => '',
			'e4' => '',
			'e5' => '',
			'e6' => '',
			'e7' => '',
		);

		return $messages[$event];
	}

}


