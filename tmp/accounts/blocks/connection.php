<?php
	$db = mysql_connect ($addrMysql, $userMysql, $passMysql)or die("mysql_connect_fail");
	mysql_select_db($nameMysql,$db)or die ("mysql_select_db_fail");
	$setnameutf8 = mysql_query("SET NAMES utf8", $db);
?>