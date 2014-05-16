<?php
require_once('functions.php');
class productos{
public function form_grid_productos($pagina,$filtro){
	$function = new functions();
	$sql = "appcycle_get_productos";
	$titulo = "Consulta de productos";
	$acciones = "bmc";
	$jquery = "onclick=abm_productos";
	$param = 0;
	$page = $pagina;
	$origen_grid = 'productos';
	$palabrafiltro = $filtro;
	$form="<p align='center'>".$titulo."</br></p>"; 
	$form.= $function -> oculta_columna_grid(array(0,6,7,8));
	$form.="
	<form id='reporte_productos' action='../exportar/productos' target='get'>
	<img width='32px' height='32px' onclick='alta_productos();' title='Nuevo Registro' src='../graficos/alta.ico'></img>
	<img width='32px' height='32px' onclick='form_grid_productos();' title='Refresh' src='../graficos/refresh.png'></img>
	<img width='32px' height='32px' onclick='exp_excel_productos();' title='Exportar a Excel' src='../graficos/excel.png'></img>
	<form>";
	$form.= $function -> datagrid($sql,$titulo,$acciones,$jquery,$param,$page,$origen_grid,$palabrafiltro);
	return $form;
}
	public function form_alta_productos($id,$val_titulo,$val_descripcion,$val_link,$val_video,$val_tags){
	$content = "
		<table>
			<input type='hidden' id='col_idappcycle' value = '".$id."'/>
				<tr><td>titulo</td><td><input class='width100' type='text' id='col_titulo' value='".$val_titulo."' /></td></tr>
				<tr><td>descripcion</td><td><textarea class='width100' id='col_descripcion'>".$val_descripcion."</textarea></td></tr>
				<tr><td>link</td><td><input class='width100' type='text' id='col_link' value='".$val_link."' /></td></tr>
				<tr><td>video</td><td><input class='width100' type='text' id='col_video' value='".$val_video."' /></td></tr>
				<tr><td>tags</td><td><input class='width100' type='text' id='col_tags' value='".$val_tags."' /></td></tr>
		</table>";
	return $content;
	}
	public function insert_productos_registro($col_titulo,$col_descripcion,$col_link,$col_video,$col_tags,$idusuario){
	$function = new functions();
	$params = "'".$col_titulo."','".$col_descripcion."','".$col_link."','".$col_video."','".$col_tags."','".$idusuario."'";
	$content = $function -> exec_sp_to_json('appcycle_insert_productos',$params);
	return $content;
	}
	public function baja_productos_registro($id,$idusuario){
	$function = new functions();
	$params = "'".$id."','".$idusuario."'";
	$content = $function -> exec_sp_to_json('appcycle_delete_productos',$params);
	return $content;
	}
	public function form_mod_productos($id){
	$function = new functions();
	$params = "'".$id."'";
	$result = $function -> exec_sp('appcycle_get_productos_by_id',$params);
	while($row = mysqli_fetch_array($result)){
		
					$val_idappcycle = $row['idappcycle'];
					$val_titulo = $row['titulo'];
					$val_descripcion = $row['descripcion'];
					$val_link = $row['link'];
					$val_video = $row['video'];
					$val_tags = $row['tags'];
	}
	
	$content = $this -> form_alta_productos($val_idappcycle,$val_titulo,$val_descripcion,$val_link,$val_video,$val_tags);
	return $content;
	}
	public function mod_productos_registro($col_idappcycle,$col_titulo,$col_descripcion,$col_link,$col_video,$col_tags,$idusuario){
	$function = new functions();
	$params = "'".$col_idappcycle."','".$col_titulo."','".$col_descripcion."','".$col_link."','".$col_video."','".$col_tags."','".$idusuario."'";
	$content = $function -> exec_sp_to_json('appcycle_update_productos',$params);
	return $content;
	}
	public function get_categorias(){
	$function = new functions();
	$content = $function -> exec_sp_to_json('appcycle_get_categorias',null);
	return $content;
	}
	}	?>