<?php 
session_start();
include_once 'blocks/class.php';
$ctrl = new Control();
$ctrl->ie6Goodbye();
$ctrl->start();


?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Учетные записи</title>
<link href="styles/main.css" rel="stylesheet" />
<link href="styles/menu.css" rel="stylesheet" />
<link href="styles/global.css" rel="stylesheet" />
<script type="text/javascript" src="js/DD_roundies_0.0.2a-min.js"></script>
<script type="text/javascript" src="js/jquery-1.5.1.min.js"></script>
<script type="text/javascript" src="js/userScripts.js"></script>
</head>
<body onload="showTime()">
<script type="text/javascript">DD_roundies.addRule('#header', '0px 0px 10px 10px');</script>
	
<div id="container">
	<div id="content">
	<div id="header"><?php 
	$ctrl->showUserMenu(); 
	$ctrl->showAuthorization();?></div>
	 <div class="innerBlock">
	 <?php 
		$ctrl->useBlock();
	 ?>
	 
	 
	 
	 
	 
	 
<?php 

echo '<pre>';


echo '</pre>';

  			
  			
?>
	 
	 
	<a href="javscript://" class="splLink"><strong>Спойлер:</strong> пример</a>
 <div class="splCont"> 
<form action="">Это примерный текст!
<label>213</label>
<input type="text" title="234">
</form>
 </div>
	 
	 
	 
	 
	 
	 
	</div>
	</div>
</div>
</body>
</html>