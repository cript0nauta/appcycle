<?php
	class forms{
		public function form_menu_principal(){
		$form = "<nav role='navigation'>
			<ul class='access-menu'>
				<li>
					<a href='.'>Inicio</a>
				</li>
				<li>
					<a href='#'>IDEAS!.</a>
					<ul class='access-submenu'>
						<li><a onclick='form_grid_productos();' href='#'>IDEAS</a></li>
					</ul>
				</li>
				<li>
					<a href='../salida/'>Salida</a>
				</li>
			</ul>
		</nav>";
		return $form;
		}
		public function contenido_head_index(){
			$form ="
			<title>.:appcycle:. | Desarrollado por www.antoniomateo.com.ar</title>
			<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
			<meta name='keywords' content='appcycle' />
			<meta name='description' content='appcycle' />
			<link rel='stylesheet' type='text/css' href='css/general.css' media='screen' />
			<link rel='stylesheet' type='text/css' href='css/jquery-ui.css' media='screen' />
			<link rel='stylesheet' type='text/css' href='css/jquery-ui.min.css' media='screen' />
			<link rel='stylesheet' type='text/css' href='css/jquery.ui.theme.css' media='screen' />
			<script type='text/javascript' src='js/jquery.min.js'></script>
			<script type='text/javascript' src='js/jquery.ui.js'></script>
			
			<script type='text/javascript' src='js/general.js'></script>
			<script type='text/javascript' src='js/class_msg.js'></script>";
		return $form;
		}
		public function contenido_head2(){
		require_once('functions.php');
		$functions = new functions();
		
		$css = $functions -> lista_archivos(getcwd().'/css');
		$css_ = "";
		$js = $functions -> lista_archivos(getcwd().'/js');
		$js_ = "";
		
		for($i = 0; $i < count($css); $i++){
			$css_ .= "
			<link rel='stylesheet' type='text/css' href='css/".$css[$i]."' media='screen' />";
		}
		for($a = 0; $a < count($js); $a++){
			if( $js[$a] != 'jquery.min.js' & $js[$a] != 'jquery.ui.js' & $js[$a] != 'class_msg.js' & $js[$a] != 'general.js'){
			$js_ .= "
			<script type='text/javascript' src='js/".$js[$a]."'></script>"; }
		}
			$form ="
			<title>.:appcycle:. | Desarrollado por www.antoniomateo.com.ar</title>
			<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
			<meta name='keywords' content='appcycle' />
			<meta name='description' content='appcycle' />
			<link rel='stylesheet' type='text/css' href='css/bt/bootstrap.min.css' media='screen' />
			<link rel='stylesheet' type='text/css' href='css/bt/bootstrap-theme.min.css' media='screen' />".$css_."
			<script type='text/javascript' src='js/jquery.min.js'></script>
			<script type='text/javascript' src='js/jquery.ui.js'></script>
			<script type='text/javascript' src='js/bootstrap.min.js'></script>			
			<script type='text/javascript' src='js/class_msg.js'></script>
			<script type='text/javascript' src='js/general.js'></script>".$js_;
		return $form;
		}
		public function contenido_head(){
		require_once('functions.php');
		$functions = new functions();
		
		$css = $functions -> lista_archivos(getcwd().'/css');
		$css_ = "";
		$js = $functions -> lista_archivos(getcwd().'/js');
		$js_ = "";
		
		for($i = 0; $i < count($css); $i++){
			$css_ .= "
			<link rel='stylesheet' type='text/css' href='../css/".$css[$i]."' media='screen' />";
		}
		for($a = 0; $a < count($js); $a++){
			if( $js[$a] != 'jquery.min.js' & $js[$a] != 'jquery.ui.js' & $js[$a] != 'class_msg.js' & $js[$a] != 'general.js'){
			$js_ .= "
			<script type='text/javascript' src='../js/".$js[$a]."'></script>"; }
		}
		
			$form ="
			<title>.:appcycle:. | Desarrollado por www.antoniomateo.com.ar</title>
			<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
			<meta name='keywords' content='appcycle' />
			<meta name='description' content='appcycle' />
			<link rel='stylesheet' type='text/css' href='../css/bt/bootstrap.min.css' media='screen' />
			<link rel='stylesheet' type='text/css' href='../css/bt/bootstrap-theme.min.css' media='screen' />".$css_."
			<script type='text/javascript' src='../js/jquery.min.js'></script>
			<script type='text/javascript' src='../js/jquery.ui.js'></script>
			<script type='text/javascript' src='../js/bootstrap.min.js'></script>			
			<script type='text/javascript' src='../js/class_msg.js'></script>
			<script type='text/javascript' src='../js/general.js'></script>".$js_;
		return $form;
		}
		public function form_login(){
		require_once('functions.php');
		$functions = new functions();
		$form = "
		<div id='formlogin' class='borderidge color_central_blanco'>
			<form id='form_login_usuario'>
				<table border='0' width='100%'>
					<tr>
						<td rowspan='5'><p align='center'><img src='graficos/candado.png' width='80' height='80'></td>
					</tr>
					<tr>
						<td align='right'><div id='divusername'>Correo:</div></td>
						<td><input type='text' id='correo' name='correo' size='40'></td>
					</tr>
					<tr>
						<td align='right'><div id='divpass'>Password:</div></td>
						<td><input type='password' id='password' name='password' size='40'></td>
					</tr>
					<tr>
						<td align='right'></td>
						<td rowspan='2' style='height: 25px;'>
						".$functions -> boton_control('onclick=submit_form_login();','tamanoboton','Ingresar')."
					</td>
					</tr>	
				</table>
			</form>
			<div id='response'></div>
		</div>";
		return $form;
		}
		public function form_div_msg(){
		$form ="
		<div id='modalresponse'></div>
		<div id='sub_modalresponse'></div>
		<div id='sub_sub_modalresponse'></div>
		<div id='sub_sub_sub_modalresponse'></div>
		<div id='sub_sub_sub_sub_modalresponse'></div>";
		return $form;
		}
		public function contendedor_idea_by_id($id){
		require_once('functions.php');
		$form = "";
		$functions = new functions();
		$params = "'".$id."'";
		$result = $functions ->  exec_sp('appcycle_get_productos_by_id',$params);
		if(mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_array($result)){
				$titulo = $row[1];
				$descripcion = $row[2];
				$link = $row[3];
				$video = $row[4];
				$tags = $row[5];
				$fecha_alta = $row[6];
			}
			$form.="
				<div><h1>".$titulo."<h1><p>".$descripcion."</p></div>
					<div class='input-group'><span width='30px' class='input-group-addon'>@</span><input type='text' class='form-control' placeholder='Username' value = '".$link."'></div>
					<div class='input-group'><span width='30px' class='input-group-addon'>#</span><input type='text' class='form-control' placeholder='Username' value = '".$link."'></div>
				<div><h1 class='rigth'>".$video."</h1></div>
				<div><h1 class='rigth'>".$tags."</h1></div>
				<div><h1 class='rigth'>".$fecha_alta."</h1></div>";
		}
		else{
			$form.="<div><h1>No hay registros para mostrar.<h1></div>";
		}
		return $form;
		}
		public function content_cabecera($tipo){
		$form = "<div class='cabecera_new'></div><div class='cabecera_new'><img class='logocabecera' src='".$tipo."graficos/LogoSecundario.png' /></div>";
		return $form;
		}
	}
	?>