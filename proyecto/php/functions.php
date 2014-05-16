<?php
	class functions{
		public function exec_sp($sp,$params){
		include("dac.php");
		$execsp=mysqli_query($conexion,"CALL $sp($params);");
		mysqli_close($conexion);
		return $execsp;
		}
		public function exec_sp_to_json($sp,$params){
		include("dac.php");
		$result =array();
			try{
				$execsp= $this -> exec_sp($sp,$params);
				if(!$execsp)
					{ 	
						throw new Exception("Ups... hay un problema con el Sp '".$sp."'");
					}
				else 
					{  
						while ($fila = mysqli_fetch_assoc($execsp)) { $result[] = $fila; }
					}
			}
			catch(Exception $e){
					$this -> report_dblog($sp,$params);
					$result = array('0' => array('info' => false ,'msg' => $e->getMessage()));
			} 
		return $result;
		}
		public function report_dblog($sp,$params){
		$param = '"call '.$sp.'('.$params.');"';
		$this -> exec_sp('appcycle_insert_dblog',$param);
		}
		public function datagrid($sql,$titulo,$acciones,$jquery,$param,$page,$origen_grid, $palabrafiltro){
		//$sql = sp para armar el grid;
		//$titulo = nombre que se le da al grid;
		//$acciones = indicador si se muestra o no la columna de acciones, en ella estan los iconos de ABMC; Si viene en false no se muestra si no se verifica el valor abmc a=alta, b=baja, m= modificacion, c=consulta;
		//$jquery = nombre del jquery que se quiere usar en el onclick;
		//$param = parametros del jquery;
		//$page = pagina actual;
		//$origen_grid = origen desde donde se esta llamando el grid, sirve para poder indicar al jquery de paginacion que formulario tiene que recargar;
		//$palabrafiltro = palabra a filtrar;

		$cant_registros = 10;
		$params = "'".$page."','".$palabrafiltro."'";
		$sql_result = $this -> exec_sp($sql,$params);
		$params_count = "null,'".$palabrafiltro."'";
		$sql_count = $this -> exec_sp($sql,$params_count);
		$countfilas = mysqli_num_rows($sql_count);
		$countcampos = mysqli_num_fields($sql_result);
		$menu = "";					
		$result = "<div id='divdatagrid'><table align='center'>";
			if($countfilas == 0){ $result .= "<tr><td>No se encuentran datos!</td></tr>"; }
			else{
		//CABECERA
				$result .="<tr>";
                                $a = 0;
				while($fetch_field = mysqli_fetch_field($sql_result)){
						$result .= "<td align='center' class='grid_col_".$a."'><b>".$fetch_field->name."</b></td>";
                                                $a++;
					}
				$result .="</tr>";
		//GRID		
				while ($row = mysqli_fetch_array($sql_result)) 
					{
					$result .="<tr id='menuderecho_".$row[$param]."' >";
						for($i=0;$i < $countcampos; $i++)
							{	
                                                              $result .="<td nowrap class='grid_col_".$i."'>".$row[$i]."</td>";	
                                                        }
					if($acciones != "false"){
						$a	=" { label:'Alta', icon:'../graficos/alta.ico', action:function() { ".$jquery."('".$row[$param]."','a'); } }";
						$b	=" { label:'Baja', icon:'../graficos/baja.ico', action:function() { ".$jquery."('".$row[$param]."','b'); } }";
						$m	=" { label:'Modificacion', icon:'../graficos/modificacion.ico', action:function() { ".$jquery."('".$row[$param]."','m'); } }";
						$c	=" { label:'Consulta', icon:'../graficos/consulta.ico', action:function() { ".$jquery."('".$row[$param]."','c'); } }";
						$d	=" { label:'Detalle', icon:'../graficos/detalle.png', action:function() { ".$jquery."('".$row[$param]."','d'); } }";
						$h	=" { label:'Historial', icon:'../graficos/historial.png', action:function() { ".$jquery."('".$row[$param]."','h'); } }";
						$i		=" { label:'Imprimir', icon:'../graficos/ico_print.png', action:function() { ".$jquery."('".$row[$param]."','i'); } }";
						$cc	=" { label:'Facturar', icon:'../graficos/money_ico.gif', action:function() { ".$jquery."('".$row[$param]."','cc'); } }";
						$ci	=" { label:'Imprimir Factura', icon:'../graficos/ico_print.png', action:function() { ".$jquery."('".$row[$param]."','ci'); } }";
						$cl	=" { label:'Clonar Presupuesto', icon:'../graficos/clon.png', action:function() { ".$jquery."('".$row[$param]."','cl'); } }";
						$cco="{ label:'Cuenta Corriente', icon:'../graficos/balance.jpg', action:function() { ".$jquery."('".$row[$param]."','cco'); } }";
						$hs	="{ label:'Historial Facturacion', icon:'../graficos/ico_history.png', action:function() { ".$jquery."('".$row[$param]."','hs'); } }";

						$i_menu="<script>$('#menuderecho_".$row[$param]."').contextPopup({ title: 'Menu', items: [ ";
						$f_menu="]});</script>";
						$td_img ="<td><img title='Click Derecho' width='28' height='28' src='../graficos/tools.jpg' />";
						$f_td_img = "</td>";
						
						switch ($acciones){
								case "b" 			:	$menu = $td_img.$i_menu.$b.$f_menu.$f_td_img; break;
								case "m" 			:	$menu = $td_img.$i_menu.$m.$f_menu.$f_td_img; break;
								case "c" 			:	$menu = $td_img.$i_menu.$c.$f_menu.$f_td_img; break;
								case "i" 				:	$menu = $td_img."<form name='print_".$origen_grid."_".$row[$param]."' target='_black' id='print_".$origen_grid."_".$row[$param]."' action='../preview/' method='post' enctype='multipart/form-data' >
																					<input type='hidden' name='tipoprint' id='tipoprint' value='".$origen_grid."'></input>
																					<input type='hidden' name='id".$origen_grid."print' id='id".$origen_grid."print' value='".$row[$param]."'></input>
																				</form>".$i_menu.$i.$f_menu.$f_td_img; break;
								case "ci"				:	$menu = $td_img."<form name='print_".$origen_grid."_".$row[$param]."' target='_black' id='print_".$origen_grid."_".$row[$param]."' action='../preview/' method='post' enctype='multipart/form-data' >
																					<input type='hidden' name='tipoprint' id='tipoprint' value='".$origen_grid."'></input>
																					<input type='hidden' name='id".$origen_grid."print' id='id".$origen_grid."print' value='".$row[$param]."'></input>
																				</form>".$i_menu.$c.",".$i.$f_menu.$f_td_img; break;
								case "bm" 			:	$menu = $td_img.$i_menu.$b.",".$m.$f_menu.$f_td_img; break;
								case "bmi" 		:	$menu = $td_img."<form name='print_".$origen_grid."_".$row[$param]."' target='_black' id='print_".$origen_grid."_".$row[$param]."' action='../preview/' method='post' enctype='multipart/form-data' >
																					<input type='hidden' name='tipoprint' id='tipoprint' value='".$origen_grid."'></input>
																					<input type='hidden' name='id".$origen_grid."print' id='id".$origen_grid."print' value='".$row[$param]."'></input>
																				</form>".$i_menu.$b.",".$m.",".$i.$f_menu.$f_td_img; break;
								case "bmicl" 		:	$menu = $td_img."<form name='print_".$origen_grid."_".$row[$param]."' target='_black' id='print_".$origen_grid."_".$row[$param]."' action='../preview/' method='post' enctype='multipart/form-data' >
																					<input type='hidden' name='tipoprint' id='tipoprint' value='".$origen_grid."'></input>
																					<input type='hidden' name='id".$origen_grid."print' id='id".$origen_grid."print' value='".$row[$param]."'></input>
																				</form>".$i_menu.$b.",".$m.",".$i.",".$cl.$f_menu.$f_td_img; break;																		
								case "bmci" 			:	$menu = $td_img."<form name='print_".$origen_grid."_".$row[$param]."' target='_black' id='print_".$origen_grid."_".$row[$param]."' action='../preview/' method='post' enctype='multipart/form-data' >
																					<input type='hidden' name='tipoprint' id='tipoprint' value='".$origen_grid."'/>
																					<input type='hidden' name='id".$origen_grid."print' id='id".$origen_grid."print' value='".$row[$param]."'/>
																					<input type='hidden' name='idnotaprint' id='idnotaprint' value='".$row[$param]."' />																			
																					<input type='hidden' name='remito_".$row[$param]."' id='remito_".$row[$param]."' value='0'/>
																				</form>".$i_menu.$b.",".$m.",".$c.",".$i.$f_menu.$f_td_img; break;
								case "bmc" 		:	$menu = $td_img.$i_menu.$b.",".$m.",".$c.$f_menu.$f_td_img; break;
								case "bcmiccci" :	$menu = $td_img."<form name='print_".$origen_grid."_".$row[$param]."' target='_black' id='print_".$origen_grid."_".$row[$param]."' action='../preview/' method='post' enctype='multipart/form-data' >
																					<input type='hidden' name='tipoprint' id='tipoprint' value='".$origen_grid."'/>
																					<input type='hidden' name='id".$origen_grid."print' id='id".$origen_grid."print' value='".$row[$param]."'/>
																				</form>
																				<form name='print_facturacion_".$row[$param]."' target='_black' id='print_facturacion_".$row[$param]."' action='../preview/' method='post' enctype='multipart/form-data' >
																					<input type='hidden' name='tipoprint' id='tipoprint' value='facturacion'/>
																					<input type='hidden' name='idfacturacionprint' id='idfacturacionprint' value='".$row[7]."'/>
																					<input type='hidden' name='idnotaprint' id='idnotaprint' value='".$row[$param]."' />
																					<input type='hidden' name='remito_".$row[$param]."' id='remito_".$row[$param]."' value='0' />
																				</form>".$i_menu.$b.",".$c.",".$m.",".$i.",".$cc.",".$ci.$f_menu.$f_td_img; break;
								case "bmcdh" 	:	$menu = $td_img.$i_menu.$b.",".$m.",".$c.",".$d.",".$h.$f_menu.$f_td_img; break;
								case "bmccohs"	:	$menu = $td_img.$i_menu.$b.",".$m.",".$cco.",".$hs.",".$f_menu.$f_td_img; break;
								}
							};
					$result .= $menu."</tr>";
					}
			}
				$result .="</table>";	
		//Paginador	
		$cant_paginas = ceil($countfilas / $cant_registros);
		($page != 1) ? $anterior = ($page - 1) : $anterior = 1;
		$siguiente = $page + 1;
		$result .= $this -> getLinks('10', $page, $cant_paginas,$anterior,$siguiente,'Anterior', 'Siguiente',$origen_grid);
		//Fin Paginador	
				$result .="<input type='hidden' id='countgrid' value='".$countfilas."'/></div>";
		return $result;
		}
		public function getLinks($cant_mostrar, $pagina_actual, $cant_paginas, $pagina_anterior, $pagina_siguiente, $str_anterior, $str_siguiente, $origen_grid){
		   $str_links = '<table width="100%"><tr><td align="center"><div class="pagination">';
		   $cont = 0;
		   $ini = (($pagina_actual - 5) <= 1)?2:$pagina_actual - 5;
		   $fin = (($pagina_actual + 5) >= ($cant_paginas - 1))?$cant_paginas - 1:$pagina_actual + 5; 
		   if($pagina_actual != 1){
					$links[$cont] = $str_anterior;
					$str_links .= "<a href='#' onClick=paginador('".$origen_grid."','".$pagina_anterior."'); >".$links[$cont]."</a>";
					$cont++;
		   }
		   if ($pagina_actual == 1) $str_links .= "<span class='current'>1</span>";
		   else $str_links .= "<a href='#' onClick=paginador('".$origen_grid."','1'); >1</a>";
		   if ($ini > 2) $str_links .= '<font color="black" size="4"> ... </font>';
		   for ($np = $ini ; $np <= $fin ; $np++) {
			if($pagina_actual != $np){
					$links[$cont]=$np;
						$str_links .= "<a href='#' onClick=paginador('".$origen_grid."','$np'); >".$links[$cont]."</a>";
				}
				else {
					$links[$cont] = "<span class='current'>".$np."</span>";
						$str_links .= $links[$cont];
			  } 
			  $cont++;
		   }
		   if ($fin < $cant_paginas - 1) $str_links .= '<font color="black" size="4"> ... </font>';
		   if ($pagina_actual == $cant_paginas) $str_links .= "<span class='current'>".$cant_paginas."</span>";
		   else $str_links .= "<a href='#' onClick=paginador('".$origen_grid."','".$cant_paginas."'); >".$cant_paginas."</a>";
		   if(($cont!=0) && ($pagina_actual != $cant_paginas)){
					$links[$cont]=$str_siguiente;
					$str_links .= "<a href='#' onClick=paginador('".$origen_grid."','".$pagina_siguiente."'); >".$links[$cont]."</a>";
					$cont++;
		   }
		   $str_links .= '</div></tr></td></table>';
		   return $str_links;
		}
		public function calcular_session($correo,$pass,$idusuario){
			if($idusuario == null){
				$params = "'".$correo."','".$pass."'";
				$result = $this -> exec_sp('appcycle_login',$params);
				while($row=mysqli_fetch_array($result)){
					$idusuario_ = $row['idusuario'];
					$info_ = $row['info'];
				}
				$info_ == false ? $array_result = array(false,null,null,null,null,null,null,null) : $array_result = $this -> calcular_session(null,null,$idusuario_);
			}
			else{
				$params = "'".$idusuario."'";
				$result = $this -> exec_sp('appcycle_get_usuario_by_id',$params);
				while($row=mysqli_fetch_array($result)){
					$nombre 	= $row[1];
					$apellido 	= $row[2];
					$username = $row[3];
					$email 		= $row[4];
					$sexo 			= $row[6];
					$fechanac 	= $row[7];
				}
				$array_result = array(true,$nombre,$apellido,$username,$email,$sexo,$fechanac,$idusuario);
			}
		return $array_result;
		}
		
		public function lista_archivos($path){
			$lista = array();
			$directorio = opendir($path);
			while ($archivo = readdir($directorio))
			{
				if(is_dir($archivo)) {} else{ array_push($lista,$archivo); }
			}
			return $lista;
		}
		
		public function oculta_columna_grid($col){
			$query = "";
			for($i=0; $i<count($col); $i++){
				$query.= " $('.grid_col_".$col[$i]."').hide();";
			}
			$form="<script>$(document).ready(function() { ".$query." })</script>";
		return $form;
		}
		public function boton_control($query,$class,$nombre){
			$form = "<button ".$query." align='right' type='button' class='".$class." ui-button boton_configuracion ui-widget ui-state-default ui-corner-all ui-button-text-only' role='button' aria-disabled='false'>
							<span class='ui-button-text centradobutton'>".$nombre."</span>
						</button>";
			return $form;
		}
	}
	?>