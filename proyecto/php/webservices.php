<?php 
require_once('class_productos.php');
$productos = new productos();

require_once('functions.php');
$functions = new functions();

if(isset($_GET['pag']))	{$pagina = $_GET['pag'];} else { $pagina = 1;}
if(isset($_GET['fil']))		{$filtro = $_GET['fil'];} else { $filtro = '';}
if(isset($_GET['id2']))	{$id2 = $_GET['id2'];} else { $id2 = '';}
$id=$_GET['id'];

if($id=="1")				{ $form = $functions -> form_empty(); }


	else if($id=='alta_productos')				{ $form = $productos->form_alta_productos(null,null,null,null,null,null); } 
	else if($id=='mod_productos')				{ $form = $productos->form_mod_productos($id2); } 
	else if($id=='grid_productos')				{ $form = $productos->form_grid_productos($pagina,$filtro); }  
echo $form; ?>