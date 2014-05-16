<?php 
			$conexion=mysqli_connect("Localhost","root","") or die("Problemas en la conexion");
			mysqli_select_db($conexion,"appcycle") or die("Problemas en la seleccion de la base de datos");
	?>