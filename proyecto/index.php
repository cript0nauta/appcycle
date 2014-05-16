<?php
	session_start();

	require_once('php/forms.php');
	require_once('php/functions.php');
	$form = new forms();
	$content ="<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
	<html xmlns='http://www.w3.org/1999/xhtml'>
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
	<meta http-equiv='pragma' content='no-cache' />
    <link rel='stylesheet' href='/css/index.css' />
	<head>".$form -> contenido_head2()."</head>
    <body>".$form->content_cabecera('').'</body>

    <div class="jumbotron">
        <div class="container">
            <h1>AppCycle</h1>
            <p>Texto de prueba</p>
        </div>
    </div> 

    <div class="categoria"><img src="http://www.antoniomateo.com.ar/proyectos/appcycle/graficos/LogoSecundario.png" alt="" class="categoria" /></div>
    <div class="categoria"><img src="http://www.antoniomateo.com.ar/proyectos/appcycle/graficos/LogoSecundario.png" alt="" class="categoria" /></div>
    <div class="categoria"><img src="http://www.antoniomateo.com.ar/proyectos/appcycle/graficos/LogoSecundario.png" alt="" class="categoria" /></div>
    <div class="categoria"><img src="http://www.antoniomateo.com.ar/proyectos/appcycle/graficos/LogoSecundario.png" alt="" class="categoria" /></div>
    <div class="categoria"><img src="http://www.antoniomateo.com.ar/proyectos/appcycle/graficos/LogoSecundario.png" alt="" class="categoria" /></div>

	</html>';
	echo $content;
	?>
