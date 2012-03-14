<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
/*
 * @copyright	Copyright 2011-2012, Vladimir Kopot, vovakm@mail.ua
 * @license 	Apache/BSD-style open source license
 */
?>

<div class="userInfo">
	<span class="greenText">
		<?php echo $account_name; ?>
	</span>&nbsp;&nbsp;
	Логин:&nbsp;<?php echo $login; ?>&nbsp;&nbsp;
	Группа:&nbsp;<?php echo $name_user_group; ?>
</div>
<div id="myClock"></div><div class="exit"><a href="<?php echo base_url();?>logout/">Выход</a></div>
