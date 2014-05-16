
	function mensaje_respuesta(msg,titulo){
		mensaje_respuesta_completo(msg,titulo,null,1);
	}

	function mensaje_respuesta_completo(msg,titulo,query,modal){
	titulo != '' ? titulo = titulo : titulo = 'appcycle';
	switch(modal){
	case 1 : var div = 'modalresponse'; break;
	case 2 : var div = 'sub_modalresponse'; break;
	case 3 : var div = 'sub_sub_modalresponse'; break;
	case 4 : var div = 'sub_sub_sub_modalresponse'; break;
	case 5 : var div = 'sub_sub_sub_sub_modalresponse'; break;
	}
	if(query != null)	{ var botones = {
							'Aceptar'	: function(){query;},
							'Cerrar'	: function(){cerrarpopup(div);}
							}
						}
					else{var botones = {
							'Cerrar'	: function(){cerrarpopup(div);}
							};
						}
			$('#' + div).html('<div style=padding:10px;><font size=2 >' + msg + '</font></div>').dialog({
			width  		: 'auto',
			height 		: 'auto',
			modal 		: true,
			hide			: "scale",
			beforeClose : function(){ $("#" + div).empty(); },
			title 			: titulo,
			buttons	: botones
		});
	}

	function msg(nro){
	var title='appcycle';
		switch(nro){
		case '1' : var msg = "Debes completar los datos necesarios."; break;
		case '2' : var msg = "Esta funcion esta deshabilitada por el administrador."; break;
		}
	mensaje_respuesta(msg,title);
	}

	function get_notificacion(){
		if (Notification) {
			if (Notification.permission !== "granted") { Notification.requestPermission() }
			var title = "appcycle"
			var extra = {
				icon: "http://xitrus.es/imgs/logo_claro.png",
				body: "Notificación de prueba en Xitrus"
			}
			var noti = new Notification( title, extra)
			noti.onclick = {
				// Al hacer click
			}
			noti.onclose = {
				// Al cerrar
			}
			setTimeout( function() { noti.close() }, 10000)
		}
	}