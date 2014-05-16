
	function submit_form_login(){
		var correo		= $('#correo').val();
		var pass 		= $('#password').val();

		if(correo == '' || pass == ''){ msg('1'); }
		else{
			var data = 'correo=' + correo + '&password=' + pass;
			$.ajax({
				url			: 'login/',
				dataType: 'json',
				type			: 'post',
				data			: data,
				success	: function(html) {
				html[0].info==false ? query = null : query = recargar_site();
				mensaje_respuesta_completo(html[0].msg,'',query,1);
				}
			});
		}
	}

	function cerrarpopup(div){
		$('#' + div).empty().dialog('close');
	}

	function recargar_site(){
	location.reload();
	}

	function funcion_deshabilitada(){
		msg('2');
	}

	function validar_input(valor,count){
	//false	=invalido;
	//true 	=valido;
		if( valor == undefined || valor == '' || valor.length < count) { var result =  false; } 
		else { var result =  true; }
		return result;
	};

	function encode_utf8(s) { 
		return unescape(encodeURIComponent(s));
	}

	function decode_utf8(s) { 
		return escape(decodeURIComponent(s));
	 }
	 
	jQuery.fn.reset = function () {
	  $(this).each (function() { this.reset(); });
	}