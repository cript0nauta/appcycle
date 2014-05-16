
		function form_grid_productos(){
		$("#modalresponse").load("../form/grid_productos/").dialog({
		width  : 'auto',
        height : 'auto',
        modal : true,
		title : "Grid productos",
		hide: "scale",
		beforeClose : function(){ $("#modalresponse").empty(); },
	    buttons: { 'Cerrar': function(){ cerrarpopup('modalresponse'); } }
		});
	}
	function alta_productos(){
		$("#sub_modalresponse").load("../form/alta_productos").dialog({
		width  : 'auto',
        height : 'auto',
        modal : true,
		title : "Alta productos",
		hide: "scale",
		beforeClose : function(){ $("#sub_modalresponse").empty(); },
	    buttons: {
			'Aceptar': function(){
				submit_alta_productos();
				},
			'Cancel': function(){
				cerrarpopup('sub_modalresponse');
				}
			}
		});
	}	
	function submit_alta_productos(){
			var titulo = $('#col_titulo').val();
			var descripcion = $('#col_descripcion').val();
			var link = $('#col_link').val();
			var video = $('#col_video').val();
			var tags = $('#col_tags').val();var data = 'titulo=' + titulo + '&descripcion=' + descripcion + '&link=' + link + '&video=' + video + '&tags=' + tags ;
	$.ajax({
		url			: '../alta_productos/',
		dataType: 'json',
		type			: 'post',
		data			: data,
		success	: function(html) {
		mensaje_respuesta_completo(html[0]['msg'],'',null,2);
		form_grid_productos();
		}
	});
	}
		function abm_productos(id,valor){
		switch(valor){
			case 'b' 	: confirma_productos(id); break;
			case 'm' : form_modifica_productos(id); break;
			case 'c'  : form_consulta_productos(id); break;
		}
	}
	function confirma_productos(id){
	var msg = "Esta seguro de eliminar este registro?";
	$("#sub_modalresponse").html(msg).dialog({
			width  : 'auto',
            height : 'auto',
            modal : true,
			hide: "scale",
			beforeClose : function(){ $("#sub_modalresponse").empty(); },
			title : "Confirmar Eliminar productos",
		    buttons: {
				'Aceptar': function(){
					submit_baja_productos(id);
				},
				'Cancel': function(){
					cerrarpopup('sub_modalresponse');
				}
			}
		});
	}
	function submit_baja_productos(id){
		var data = 'id=' + id;
		$.ajax({
			url				: '../baja_productos/',
			dataType	: 'json',
			type				: 'post',
			data				: data,
			success		: function(html) {
				mensaje_respuesta_completo(html[0]['msg'],'',null,2);
				form_grid_productos();
			}
		});
	}
	function form_modifica_productos(id){
		$("#sub_modalresponse").load("../form/mod_productos/" + id).dialog({
		width  : 'auto',
        height : 'auto',
        modal : true,
		title : "Modifica productos",
		hide: "scale",
		beforeClose : function(){ $("#sub_modalresponse").empty(); },
	    buttons: {
			'Aceptar': function(){
				submit_mod_productos(id);
				},
			'Cancel': function(){
				cerrarpopup('sub_modalresponse');
				}
			}
		});
	}	
	function submit_mod_productos(id){
			var idappcycle = $('#col_idappcycle').val();
			var titulo = $('#col_titulo').val();
			var descripcion = $('#col_descripcion').val();
			var link = $('#col_link').val();
			var video = $('#col_video').val();
			var tags = $('#col_tags').val();var data = 'idappcycle=' + idappcycle + '&titulo=' + titulo + '&descripcion=' + descripcion + '&link=' + link + '&video=' + video + '&tags=' + tags ;
	$.ajax({
		url			: '../mod_productos/',
		dataType: 'json',
		type			: 'post',
		data			: data,
		success	: function(html) {
		mensaje_respuesta_completo(html[0]['msg'],'',null,2);
		form_grid_productos();
		}
	});
	}
		function form_consulta_productos(id){
		$("#sub_modalresponse").load("../form/mod_productos/" + id, function() { $('#sub_modalresponse').find('input, textarea, button, select').attr('disabled','disabled'); } ).dialog({
		width  : 'auto',
        height : 'auto',
        modal : true,
		title : "Consulta productos",
		hide: "scale",
		beforeClose : function(){ $("#sub_modalresponse").empty(); },
	    buttons: {
			'Cerrar': function(){
				cerrarpopup('sub_modalresponse');
				}
			}
		});
	}
	function exp_excel_productos(){
		$('#reporte_productos').submit();
	}