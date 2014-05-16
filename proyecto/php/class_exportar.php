<?php
session_start();
require_once('functions.php');
$function = new functions();
require_once('forms.php');
$form = new forms();
isset($_SESSION['admin'][0]) ? $idusuario = $_SESSION['admin'][7] : $idusuario = null;
$form="<table border='1'>";
if($_GET['id'] == 'empty'){}
	else if($_GET['id'] == 'productos'){
	$params = "null,null";
	$result = $function -> exec_sp('appcycle_get_productos',$params);
	}

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=clientes_".date('d-m-Y').".xls");
header("Pragma: no-cache");
header("Expires: 0");
while($fetch_field = mysqli_fetch_field($result)){
	$form .= "<td align='center'><b>".$fetch_field->name."</b></td>";
}
$countcampos = mysqli_num_fields($result);
	while ($row = mysqli_fetch_array($result)) 
		{
		$form .="<tr>";
			for($i=0;$i < $countcampos; $i++)
				{	$form .="<td nowrap>".$row[$i]."</td>";	}
		$form .="</tr>";
		}
echo $form."</table>";
?>