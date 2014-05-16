<?php
session_start();
require_once('../php/functions.php');
require_once('../php/forms.php');
require_once('../php/class_productos.php');
isset($_SESSION['admin'][0]) ? $idusuario = $_SESSION['admin'][7] : $idusuario = null;


if(isset($_GET['empty'])){
}
		else if(isset($_GET['alta_productos'])){
		$productos = new productos();
		$col_titulo = $_POST['titulo'];$col_descripcion = $_POST['descripcion'];$col_link = $_POST['link'];$col_video = $_POST['video'];$col_tags = $_POST['tags'];
		$result = $productos -> insert_productos_registro($col_titulo,$col_descripcion,$col_link,$col_video,$col_tags,$idusuario);
		}
		else if(isset($_GET['baja_productos'])){
		$productos = new productos();
		$id = $_POST['id'];
		$result = $productos -> baja_productos_registro($id,$idusuario);
		}
		else if(isset($_GET['mod_productos'])){
		$productos = new productos();
		$col_idappcycle = $_POST['idappcycle'];$col_titulo = $_POST['titulo'];$col_descripcion = $_POST['descripcion'];$col_link = $_POST['link'];$col_video = $_POST['video'];$col_tags = $_POST['tags'];
		$result = $productos -> mod_productos_registro($col_idappcycle,$col_titulo,$col_descripcion,$col_link,$col_video,$col_tags,$idusuario);
		}
header("Content-Type: application/json", true);
echo json_encode($result);
?>