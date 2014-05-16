<?php
	session_start();

	require_once('php/forms.php');
	require_once('php/functions.php');
	$form = new forms();
	$content ="<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
	<html xmlns='http://www.w3.org/1999/xhtml'>
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
	<meta http-equiv='pragma' content='no-cache' />
    <link rel='stylesheet' href='css/index.css' />
    <script src='js/index.js' type='text/javascript'></script>
	<head>".$form -> contenido_head2()."</head>
    <body>".$form->content_cabecera('').'</body>

    <div class="jumbotron">
        <div class="container">
            <h1>AppCycle</h1>
            <p>Texto de prueba</p>
        </div>
    </div> 

<div id="modalcategoria" role="dialog" class="modal fade" tabindex="-1" area-hidden="true">
    <div class="model-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Prueba de modal</h4>
            </div>
            <div class="modal-body">
                <p></p>
            </div>
            <div class="modal-footer"><button class="btn btn-default" data-dismiss="modal" type="button">Cerrar</button></div>
        </div>
    </div>
</div>


<div class="container" id="categorias">
</div>


	</html>';
	echo $content;
	?>
