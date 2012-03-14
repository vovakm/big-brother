<?php
/*
 * @copyright	Copyright 2011-2012, Vladimir Kopot, vovakm@mail.ua
 * @license 	Apache/BSD-style open source license
 */
?>

<!DOCTYPE html>
<html>
    <head>
		<!-- meta tags -->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!--end mata tags -->

        <!-- title -->
		<title>Учетные записи</title>
		<!-- end title-->

		<!-- styles -->
        <link href="<?php echo base_url(); ?>styles/main.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>styles/menu.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>styles/global.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>styles/smoothness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
		<link href="<?php echo base_url(); ?>styles/jquery-dropdown-menu.css" rel="stylesheet" media="screen"  />
		<!-- end styles -->

		<!--javascript -->
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.6.4.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-ui-1.8.16.custom.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-jclock.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/userScripts.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-dropdown-menu.js"></script>
		
		<script type="text/javascript">
			
			$(document).ready(function() {
				$("#myClock").jclock();
				$("#loginBtn").button();
				
			});
		</script>
		<!-- end javascript -->
   
    <link rel="stylesheet" type="text/css" href="js/ext-4.0.7-gpl/resources/css/ext-all-gray.css" />
    <script type="text/javascript" src="js/ext-4.0.7-gpl/bootstrap.js"></script>

    

    <link rel="stylesheet" type="text/css" href="js/ext-4.0.7-gpl/examples/shared/example.css" />

    
    <script type="text/javascript" src="js/extjs-parts/exttest.js"></script> 
    <!--<script type="text/javascript" src="js/extjs-parts/myform.js"></script> -->
    </head>

	<body>
        <div id="container">
            <div id="content">