<?php
/*
 * @copyright	Copyright 2011-2012, Vladimir Kopot, vovakm@mail.ua
 * @license 	Apache/BSD-style open source license
 */
?>
<!-- header -->
<div id="header">

	<!-- user menu -->
	<?php
	if (!$this->session->userdata('userData'))
		$this->load->view('default/blocks/headerMenu');
	else
		$this->load->view('default/blocks/headerMenu', $this->session->userdata('userData'));
	?>
	<!-- end user menu -->
	<?php
	if (!$this->session->userdata('userData'))
		$this->load->view('default/blocks/loginForm');
	else
		$this->load->view('default/blocks/loggedUserHeader', $this->session->userdata('userData'));
	?>

</div>
<!-- end header -->