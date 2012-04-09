<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
/*
 * @copyright	Copyright 2011-2012, Vladimir Kopot, vovakm@mail.ua
 * @license 	Apache/BSD-style open source license
 */
?>

<!-- login form -->
<?php echo form_open('login', 'class="authorizaion" id="authorizaion"'); ?>
<!--<form action="login" class="authorizaion" id="authorizaion">-->
<label>Логин</label>
<input type="text" value="" name="login" title="login" id="inputLogin" autocomplete="off">
<label>Пароль</label>
<input type="password" value="" name="password" title="password" id="inputPassword" autocomplete="off">
<input type="submit" value="Войти" id ="loginBtn">
<label class="redText"><span></span></label><div id="myClock"></div>
</form>
<!-- end login form -->
