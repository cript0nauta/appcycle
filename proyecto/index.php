<?php
	session_start();
	if(!isset($_SESSION['admin']) || !$_SESSION['admin'][0]){
	require_once('php/forms.php');
	require_once('php/functions.php');
	$forms = new forms();
	$form ="<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
	<html xmlns='http://www.w3.org/1999/xhtml'>
	<head>".$forms -> contenido_head_index()."</head>
		<body class='color_central'>
			<div id='logocentral' align='center'></div>
			".$forms -> form_login().$forms -> form_div_msg()."
		</body>
	</html>";
	}
	else{
	$form ="<script>self.location.href='principal/';</script>";
	}
	echo $form;
	?>