<?php
	session_start();
	$server = $_SERVER['SERVER_NAME'];
	$path = '../'; 
	@session_destroy();
	@Header('Location:'.$path);
?>