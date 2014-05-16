<?php
	session_start();
	require_once('functions.php');
	require_once('forms.php');
	isset($_SESSION['admin'][0]) ? $idusuario = $_SESSION['admin'][7] : $idusuario = null;
	
	$functions = new functions();
	$forms = new forms();
	
	if(isset($_GET['alta'])){}
	else if(isset($_GET['update'])){}
	else if(isset($_GET['baja'])){}
	else if(isset($_GET['consulta'])){}
	else if(isset($_GET['login'])){
	$correo	= $_POST['correo'];
	$pass 		= $_POST['password'];
	$params = "'".$correo."','".md5($pass)."'";
	$result = $functions -> exec_sp_to_json('appcycle_login',$params);
	$_SESSION['admin'] = $functions -> calcular_session($correo,md5($pass),null);
	}
	header("Content-Type: application/json", true);
	echo json_encode($result);
	?>