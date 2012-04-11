<?php
class Database
{
	static function connect()
	{
		include_once 'blocks/config.php';
		$db = mysql_connect ($addrMysql, $userMysql, $passMysql)or die("mysql_connect_fail");
		mysql_select_db($nameMysql,$db)or die ("mysql_select_db_fail");
		$setnameutf8 = mysql_query("SET NAMES utf8", $db);
		return $db;
	}
	
	static function loginUser($login, $password)
	{
		$l = $login;
		$p = $password;;
		$query = "SELECT `id_account`, `account_name`, `login`, `name_user_group`, `access_to_database`  FROM `accounts` INNER JOIN `user_groups` ON `user_groups`.`id_user_group` = `accounts`.`id_user_group` WHERE `login` LIKE '$l' AND `password` LIKE '$p' LIMIT 1;";
		$result = mysql_query($query);
		if (mysql_num_rows($result) == 1)
		{
			$userArr = mysql_fetch_array($result);
			$query = "INSERT INTO `last_events` (`id_last_event`, `id_account`, `event_name`, `event_time`) VALUES (NULL, '".$userArr['id_account']."', 'Login', '".@date('Y-m-d H:i:s')."');";
			mysql_query($query);
			return $userArr;
		}
		else
			return '0';
	}
	static function addToSambaGroup($name, $note)
	{
		$query = "INSERT INTO `samba_groups` (`samba_group_name`, `samba_group_note`) VALUES ('".trim(mb_strtolower($name,'utf-8'))."','".trim(mb_strtolower($note,'utf-8'))."');";
		mysql_query($query);
	}
	static function getAllSambaGroups()
	{
		$query = "SELECT `id_samba_group`, `samba_group_name` FROM `samba_groups`;";
		$result = mysql_query($query);
		$sambaGroupsOnServer = array();
		while ($row = mysql_fetch_array($result))
			$sambaGroupsOnServer[$row['id_samba_group']] = $row['samba_group_name'];
		return $sambaGroupsOnServer;
	}
	static function addToStatuses($name, $note)
	{
		$query = "INSERT INTO `statuses` (`status_name`, `status_note`) VALUES ('".trim(mb_strtolower($name,'utf-8'))."','".trim(mb_strtolower($note,'utf-8'))."');";
		return mysql_query($query);
	}
	static function getAllStatuses()
	{
		$query = "SELECT `id_status`,`status_name` FROM `statuses`;";
		$result = mysql_query($query);
		$statusesOnServer = array();
		while ($row = mysql_fetch_array($result))
			$statusesOnServer[$row['id_status']] = $row['status_name'];
		return $statusesOnServer;
	}
	static function addToUserGroups($name, $note)
	{
		$query = "INSERT INTO `user_groups` (`name_user_group`, `note_user_group`) VALUES ('".trim(mb_strtolower($name,'utf-8'))."','".trim(mb_strtolower($note,'utf-8'))."');";
		mysql_query($query);
	}
	static function getAllUserGroups()
	{
		$query = "SELECT `id_user_group`,`name_user_group` FROM `user_groups`;";
		$result = mysql_query($query);
		$groupsOnServer = array();
		while ($row = mysql_fetch_array($result))
			$groupsOnServer[$row['id_user_group']] = $row['name_user_group'];
		return $groupsOnServer;
	}
	
	static function addToAccounts($int_num_pass, $int_stat, $int_samba, $int_groupe, $int_del, $int_insamba, $int_block, $int_inet, $vch_access_to_db, $vch_name, $vch_login, $vch_passwd, $vch_pic, $int_shell, $vch_quote, $vch_note, $d_bd, $d_create, $d_upd)
	{
		$query = "INSERT INTO `accounts` 
		(`number_pass`,`id_status`,`id_samba_group`,`id_user_group`,`deleted`, `in_samba`, `blocked`,`internet_lock`,`access_to_database`,`account_name`,`login`,`password`,`picture`,`shell`,`quota`,`account_note`,`birthday_date`,`create_date`,`update_date`)
		 VALUES 
		 ('".preg_replace('/^0+/', '', $int_num_pass)."', '$int_stat', '$int_samba', '$int_groupe', '$int_del', $int_insamba, '$int_block',
		 '$int_inet','$vch_access_to_db', '".trim(preg_replace('/  +/', ' ', $vch_name))."', '$vch_login', 
		 '".md5('miss'.$vch_passwd.'you')."', '$vch_pic', '$int_shell', '$vch_quote', '$vch_note','$d_bd', '$d_create', '$d_upd');";
		return mysql_query($query);
	}
	static function countSearchRows($table, $field, $value)
	{
		$query = "SELECT 1 FROM `$table` WHERE `$field` = '$value'";
		return mysql_num_rows(mysql_query($query));
	}
	
}
class UserInterface
{
	static function authorization($msg)
	{
		echo 
		'<form action="" name="authorization" method="post" class="authorizaion">
		<label>Логин</label>
		<input type="text" value="" name="login" title="login">
		<label>Пароль</label>
		<input type="password" value="" name="password" title="password">
		<input type="submit" value="log in">
		<label class="redText">'.$msg.'</label>
		</form>
		<div id="myClock"></div>';
	}
	static function userHeader($userArr)
	{
		echo '<div class="userInfo"><span class="greenText">'.$userArr['account_name'].'</span>&nbsp;&nbsp;Логин:&nbsp;'.$userArr['login'].'&nbsp;&nbsp;Группа:&nbsp;'.$userArr['name_user_group'].'</div>';
		echo '<div id="myClock"></div><div class="exit"><a href="blocks/destr.php">Выход</a></div>';
	}
	static function userMenu()
	{
		echo '<div class="codropsmenu1" id="menu">
                <ul>';
		if ($_SESSION['user']['access_to_database'] == '2222222222222222')   
             	echo '<li><a href="?e=create" class="first"><span><span class="blueText">Создать</span></span></a></li>
             	<li><a href="?e=find" class="first"><span><span class="blueText">Найти</span></span></a></li>
             	<li><a href="?e=advanced" class="first"><span><span class="blueText">Дополнительно</span></span></a></li>';
             else $first = 'class="first"';
		
		echo '
		<li><a href="?e=bday" '.$first.'><span><span>Дни рождения</span></span></a></li>
		<li><a href="?e=mylogin"><span><span>Вспомнить логин</span></span></a></li>
                    <li><a href="?e=fullinfo"><span><span>Полная информация</span></span></a></li>
                    <li><a href="?e=editpass" class="last"><span><span>Сменить пароль</span></span></a></li>
                </ul>
            </div>';
	}
	static function warningTitle($text)
	{
		echo '<div class="titleMsg redText">'.$text.'</div>';
	}
	static function normalTitle($text)
	{
		echo '<div class="titleMsg">'.$text.'</div>';
	}
}
class Control
{
	function start()
	{
		Database::connect();
	}
	
	function showAuthorization()
	{
	if ($_SESSION['user']['login'] == '')
		if ($_POST['login'] != '' && $_POST['password'] != '')
		{
			$userArr = Database::loginUser($_POST['login'], $_POST['password']);
			if ($userArr == '0')
				UserInterface::authorization('Ошибка: нет такого пользователя');
			else 
			{
				$_SESSION['user']['id_account'] = $userArr['id_account'];
				$_SESSION['user']['login'] = $userArr['login'];
				$_SESSION['user']['account_name'] = $userArr['account_name'];
				$_SESSION['user']['name_user_group'] = $userArr['name_user_group'];
				$_SESSION['user']['access_to_database'] = $userArr['access_to_database'];
				UserInterface::userHeader($_SESSION['user']);
				echo '<meta http-equiv=Refresh content="0; url=index.php">';
			}
				
		}
		else
			UserInterface::authorization('');
		else 
			UserInterface::userHeader($_SESSION['user']);
		
	}

	function showUserMenu()
	{
		UserInterface::userMenu();
	}
	function ie6Goodbye()
	{
		if (!stristr($_SERVER['HTTP_USER_AGENT'], 'MSIE 7.0'))
		if (stristr($_SERVER['HTTP_USER_AGENT'], 'MSIE 6.0') || stristr($_SERVER['HTTP_USER_AGENT'], 'MSIE 5.01'))
		{
			echo '<meta http-equiv=Refresh content="0; url=ie6/">';
			exit();
		}
	}
	static function parserCheckSecondaryTables($file_arr, $separator, $part, $get)
	{
			$tmpArr = array();
			$tt = array(' '=>'', '  '=>'', '   '=>'');
			foreach ($file_arr AS &$row)
			{
				$expRow = explode($separator, iconv("windows-1251","utf-8", $row));
				if (!in_array(mb_strtolower(strtr($expRow[$part], $tt),'utf-8'), $tmpArr))
				array_push($tmpArr, mb_strtolower(strtr($expRow[$part], $tt),'utf-8'));
			}
			if ($get == 'status')
				$tmpArrOnServer = (Database::getAllStatuses());
			elseif ($get == 'samba')
				$tmpArrOnServer = (Database::getAllSambaGroups());
			elseif ($get == 'group')
				$tmpArrOnServer = (Database::getAllUserGroups());
			foreach ($tmpArr as $key => $value)
				if (trim($value) != '')
					if (!in_array((trim($value)), $tmpArrOnServer))
					{
						if ($get == 'status')
							Database::addToStatuses($value, $value);
						elseif ($get == 'samba')
							Database::addToSambaGroup($value, $value);
						elseif ($get == 'group')
							Database::addToUserGroups($value, $value);
					}
					
	}
	function useBlock()
	{
					switch ($_GET['e'])
					{
						case 'create':	
									if (is_file('blocks/inc_createUser.php')) include_once('blocks/inc_createUser.php');
									else UserInterface::warningTitle('Операция не может быть выполнена. Данного блока не существует');
									break;
						case 'find':
									if (is_file('blocks/inc_findUser.php')) include_once('blocks/inc_findUser.php');
									else UserInterface::warningTitle('Операция не может быть выполнена. Данного блока не существует');
									break;
						case 'advanced':
									if (is_file('blocks/inc_advancedFunctions.php')) include_once('blocks/inc_advancedFunctions.php');
									else UserInterface::warningTitle('Операция не может быть выполнена. Данного блока не существует');
									break;
						case 'bday':
									if (is_file('blocks/inc_bDayToday.php')) include_once('blocks/inc_bDayToday.php');
									else UserInterface::warningTitle('Операция не может быть выполнена. Данного блока не существует');
									break;
						case 'mylogin':
									if (is_file('blocks/inc_remindMyLogin.php')) include_once('blocks/inc_remindMyLogin.php');
									else UserInterface::warningTitle('Операция не может быть выполнена. Данного блока не существует');
									break;
						case 'fullinfo':
									if (is_file('blocks/inc_myFullInformation.php')) include_once('blocks/inc_myFullInformation.php');
									else UserInterface::warningTitle('Операция не может быть выполнена. Данного блока не существует');
									break;

						case 'editpass':
									if (is_file('blocks/inc_changeMyPassword.php')) include_once('blocks/inc_changeMyPassword.php');
									else UserInterface::warningTitle('Операция не может быть выполнена. Данного блока не существует');
									break;
						default: 
									if (is_file('blocks/inc_bDayToday.php')) include_once('blocks/inc_bDayToday.php');
									else UserInterface::warningTitle('Операция не может быть выполнена. Данного блока не существует');
					}
	}
	static function translateLine($text)
	{
		 $vocabular = array("а"=>"a","б"=>"b", "в"=>"v", "г"=>"g", "д"=>"d", "е"=>"e", "ё"=>"e","ж"=>"j", "з"=>"z", "и"=>"i","й"=>"iy",
							"к"=>"k","л"=>"l", "м"=>"m", "н"=>"n", "о"=>"o", "п"=>"p", "р"=>"r","с"=>"s", "т"=>"t", "у"=>"u","ф"=>"f",
							"х"=>"h","ц"=>"c", "ч"=>"ch","ш"=>"sh","щ"=>"sh","ы"=>"i", "э"=>"e","ю"=>"yu","я"=>"ya",
							"і"=>"i","ї"=>"i", "є"=>"e", "ъ"=>"",  "ь"=>"",  "ґ"=>"g", "'"=>"");
		 return preg_replace ("/[^a-z \_-]/", "", trim(strtr(mb_strtolower($text,'utf-8'),$vocabular)));
	}
	
}