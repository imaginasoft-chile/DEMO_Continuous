function eliminaUsuario(usuario,url_des)
{
	var htm = "Esta seguro que quiere eliminar al usuario <strong>"+usuario+"</strong><hr /><strong>Importante:</strong> Al eliminar al usuario del sistema, se eliminarán todos los registros asociados a este usuario.";
	
	footer = ' <button type="button" class="btn btn-danger btn-sm waves-effect waves-light" onclick="doEliminaUsuario(\''+url_des+'\',\''+usuario+'\');" >Si, eliminar</button> '+
	 		' <button type="button" class="btn btn-secondary btn-sm waves-effect waves-light" data-dismiss="modal">Cancelar</button> ';

	$("#modal_cp_bdy").html(htm);
	$("#modal_cp_fter").html(footer);
	
	
}
function doEliminaUsuario(url_des,usuario)
{
	urlIn = "../c_srv/usuario.php";
	dataIn = url_des;
	srv="ELIMINAUSUARIO";
	msjError = "No pudimos realizar lo solicitado";	
	obj = getDataJson(urlIn,dataIn,srv,msjError);
	
	footer = ' <button type="button" class="btn btn-primary btn-sm waves-effect waves-light" onclick="reloadLocal();">Entendido</button> ';
	
	$("#modal_cp_bdy").html("El usuario <strong>"+usuario+"</strong>  fue eliminado");
	$("#modal_cp_fter").html(footer);
}




function deshabilitaUsuario(usuario,url_des)
{
	var htm = "Esta seguro que quiere Deshabilitar al usuario <strong>"+usuario+"</strong>";
	
	footer = ' <button type="button" class="btn btn-danger btn-sm waves-effect waves-light" onclick="doDeshabilitaUsuario(\''+url_des+'\',\''+usuario+'\');" >Si, Deshabilitar</button> '+
	 		' <button type="button" class="btn btn-secondary btn-sm waves-effect waves-light" data-dismiss="modal">Cancelar</button> ';

	$("#modal_cp_bdy").html(htm);
	$("#modal_cp_fter").html(footer);
	
	
}
function doDeshabilitaUsuario(url_des,usuario)
{
	urlIn = "../c_srv/usuario.php";
	dataIn = url_des;
	srv="DESHABILITAUSUARIO";
	msjError = "No pudimos realizar lo solicitado";	
	obj = getDataJson(urlIn,dataIn,srv,msjError);
	
	footer = ' <button type="button" class="btn btn-primary btn-sm waves-effect waves-light" onclick="reloadLocal();">Entendido</button> ';
	
	$("#modal_cp_bdy").html("El usuario <strong>"+usuario+"</strong>  fue Deshabilitado");
	$("#modal_cp_fter").html(footer);
}
function abre_frm_imagen()
{
	
	$("#cambiar_imagen_btn").fadeIn("fast");
	$("#imagen").val("");	
	cierraDiv('msg_error_carg_ci');

}
function cambia_imagen()
{
	cierraDiv('cambia_imagen_realizado');
	cierraDiv('msg_error_carg_ci');
	cierraDiv('btn_termina_ok');
	
	$("#cargando_imagen").html("");
	$("#cambiar_imagen_btn").fadeOut("fast");
	var contError 	= 0;
	imagen 			= $("#imagen").val();	
	var htm 		= '	<strong> ERROR </strong>';
	
	
	if(imagen  == "")
	{
		contError++;
		
		htm += "- Debe seleccionar una nueva Imagen.<br />";
	}
	else
	{
		console.log("imagen:"+imagen);
		validaImg = esImagen(imagen);
		if( validaImg != "ok")
		{
			contError++;
			htm += "- "+validaImg+"<br />";
		}
		
	}
	
	htm += '</div>';
	
	if(contError > 0)
	{
		abreDiv('msg_error_carg_ci');
		$("#cambiar_imagen_btn").fadeIn("fast");
		$("#err_ci_bdy").html(htm);
		contError =0;
        $("#btn_crea_usuario").fadeIn("fast");
		
	}
	else
	{	
		
		var htm='<img alt="" src="../images/Loading.gif" style="    width: 30px;"> En este momento estamos cambiando la imagen del perfil del usuario, por favor espere un momento.';
		$("#cargando_imagen").html(htm);
		
		setTimeout(function(){
			
					msjError = "No pudimos realizar lo solicitado";
					urlIn = "../c_srv/usuario.php";
					formalioID = "frm_modifica_imagen";
					srv="CAMBIAIMAGEN";
					var urlEnv = getDataJsonSbm(urlIn,formalioID,srv,msjError);
			        //location.href = urlEnv;
					abreDiv('cambia_imagen_realizado');
					abreDiv('btn_termina_ok');
					$("#cargando_imagen").html("");
				
			        		
					
			        
				}, 1200);
		
		
		
		
	}
}
function modifica_usuario()
{

	$("#btn_modifica_usuario").fadeOut("fast");
	var contError 	= 0;
	nombre 			= $("#nombre").val();	
	mail 			= $("#mail").val();
	ususario_mae 	= $("#ususario_mae").val();
	clave 			= $("#clave").val();
	perfil 			= $("#perfil").val();
	ususario_mae_valida = $("#ususario_mae_valida").val();
	var htm 		= '	<div style=\"width:100%; text-align: left\"> <strong> ERROR - No podemos modificar los datos del Usuario, favor revisa lo siguiente.</strong><br /><br />';
	
	
	if(nombre  == "")
	{
		contError ++;
		htm += contError+"- Debe ingresar el Nombre del usuario<br />";
	}
	
	if(mail  == "")
	{
		contError ++;
		htm += contError+"- Debe ingresar el mail del usuario<br />";
	}else
	{
		
		if(validarEmail(mail)== false)
		{
			htm += contError+"- Debe ingresar un mail valido<br />";
		}
		
	}
	if(ususario_mae  == "")
	{
		contError ++;
		htm += contError+"- Debe ingresar el nombre de usuario<br />";
	}else
	{	
		
		
		if(ususario_mae_valida != ususario_mae)
		{
			
			urlIn = "../c_srv/usuario.php";
			dataIn = "acc=VALIDAUSUARIO&ususario_mae="+ususario_mae;
			srv="VALIDAUSUARIO";
			msjError = "No pudimos realizar lo solicitado";
			
			obj = getDataJson(urlIn,dataIn,srv,msjError);
			if(obj == "NO DISPONIBLE")
			{
				contError ++;
				htm += contError+"- El nombre de usuario <strong>\""+ususario_mae+"\"</strong> para el acceso al sistema <strong> No esta disponible</strong>, por favor intente con otro nombre de usuario<br />";
			}
		}
		
		
		
		
	}
	if(clave  == "")
	{
		contError ++;
		htm += contError+"- Debe ingresar una clave de acceso <br />";
	}else
	{
		largo = clave.length;	
		if ( largo < 6 )	
		{		
			contError ++;
			htm += contError+"- El largo de la clave de acceso debe tener al menos 6 caracteres <br />";
		}
	}
	htm += '</div>';
	
	if(contError > 0)
	{
		
		footer='<button type="button" class="btn btn-primary waves-effect waves-light" data-dismiss="modal">Entendido</button>';
		$("#modal_cp_bdy").html(htm);
		$("#modal_cp_fter").html(footer);
        contError =0;
        $("#btn_modifica_usuario").fadeIn("fast");
		
	}
	else
	{	
		var htm='<img alt="" src="../images/Loading.gif" style="    width: 30px;"> En este momento estamos creando al usuario, por favor espere un momento.';
		$("#modal_cp_bdy").html(htm);
		
		setTimeout(function(){
			
					msjError = "No pudimos realizar lo solicitado";
					urlIn = "../c_srv/usuario.php";
					formalioID = "frm_modifica_usuario";
					srv="MODIFICAUSUARIO";
					var urlEnv = getDataJsonSbm(urlIn,formalioID,srv,msjError);
			        //location.href = urlEnv;
					var lista_usuario_url = $("#lista_usuario_url").val();
					htm='<img src="../images/ok.png" style="width: 45px;" /> El Usuario fue modificado correctamente!';
					footer='<button type="button" class="btn btn-default" data-dismiss="modal" onclick="reloadLocal();" >Entendido</button>';
			        
			        $("#modal_cp_bdy").html(htm);
					$("#modal_cp_fter").html(footer);
			        		
					$("#btn_crea_perfil").fadeIn("fast");
			        
				}, 1200);
		
		
	}
	
}
function crea_usuario()
{
	$("#btn_crea_usuario").fadeOut("fast");
	var contError 	= 0;
	nombre 			= $("#nombre").val();	
	mail 			= $("#mail").val();
	ususario_mae 	= $("#ususario_mae").val();
	clave 			= $("#clave").val();
	clave_valida 	= $("#clave_valida").val();
	var htm 		= '	<div style=\"width:100%; text-align: left\"> <strong> ERROR - No podemos crear el nuevo Usuario, favor revisa lo siguiente.</strong><br /><br />';
	
	
	if(nombre  == "")
	{
		contError ++;
		htm += contError+"- Debe ingresar el Nombre del usuario<br />";
	}
	if(mail  == "")
	{
		contError ++;
		htm += contError+"- Debe ingresar el mail del usuario<br />";
	}else
	{
		
		if(validarEmail(mail)== false)
		{
			htm += contError+"- Debe ingresar un mail valido<br />";
		}
		
	}
	if(ususario_mae  == "")
	{
		contError ++;
		htm += contError+"- Debe ingresar el nombre de usuario<br />";
	}else
	{	
		urlIn = "../c_srv/usuario.php";
		dataIn = "acc=VALIDAUSUARIO&ususario_mae="+ususario_mae;
		srv="VALIDAUSUARIO";
		msjError = "No pudimos realizar lo solicitado";
		
		obj = getDataJson(urlIn,dataIn,srv,msjError);
		if(obj == "NO DISPONIBLE")
		{
			contError ++;
			htm += contError+"- El nombre de usuario <strong>\""+ususario_mae+"\"</strong> para el acceso al sistema <strong> No esta disponible</strong>, por favor intente con otro nombre de usuario<br />";
		}
		
	}
	if(clave  == "")
	{
		contError ++;
		htm += contError+"- Debe ingresar una clave de acceso <br />";
	}else
	{
		largo = clave.length;	
		if ( largo < 6 )	
		{		
			contError ++;
			htm += contError+"- El largo de la clave de acceso debe tener al menos 6 caracteres <br />";
		}else
		{
			if(clave  != clave_valida)
			{
				contError ++;
				htm += contError+"- La clave de validación no es igual a la clave ingresada, por favor ingrese nuevamente estos valores<br />";
			}
			
		}
	}
	htm += '</div>';
	
	if(contError > 0)
	{
		
		footer='<button type="button" class="btn btn-primary waves-effect waves-light" data-dismiss="modal">Entendido</button>';
		$("#modal_cp_bdy").html(htm);
		$("#modal_cp_fter").html(footer);
        contError =0;
        $("#btn_crea_usuario").fadeIn("fast");
		
	}
	else
	{	
		var htm='<img alt="" src="../images/Loading.gif" style="    width: 30px;"> En este momento estamos creando al usuario, por favor espere un momento.';
		$("#modal_cp_bdy").html(htm);
		
		setTimeout(function(){
			
					msjError = "No pudimos realizar lo solicitado";
					urlIn = "../c_srv/usuario.php";
					formalioID = "frm_crea_usuario";
					srv="CREAUSUARIO";
					var urlEnv = getDataJsonSbm(urlIn,formalioID,srv,msjError);
			        //location.href = urlEnv;
					var lista_usuario_url = $("#lista_usuario_url").val();
					htm='<img src="../images/ok.png" style="width: 45px;" /> El Usuario fue creado correctamente!';
					footer='<button type="button" class="btn btn-default" data-dismiss="modal" onclick="goto(\''+lista_usuario_url+'\');">Entendido</button>';
			        
			        $("#modal_cp_bdy").html(htm);
					$("#modal_cp_fter").html(footer);
			        		
					$("#btn_crea_perfil").fadeIn("fast");
			        
				}, 1200);
		
		
	}
}