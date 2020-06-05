function addAppsBloqDesb(appid,sistemaid,clienteid)
{

	
	if( $("#app_"+appid).is(":checked") ){
		
		var sal =  getDataJson("../c_srv/cliente.php","acc=ADDAPPSBLOQUEA&aplicacionid="+appid+"&sistemaid="+sistemaid+"&clienteid="+clienteid,"Error 001","NO");
		
		var titulo='<span style=" color:red"> Bloqueo<span>';
		var msg = ' La aplicación ha sido bloqueada de forma correcta!';
		mensaje(titulo,msg);
    } else
    {
    	var sal =  getDataJson("../c_srv/cliente.php","acc=DELAPPSBLOQUEA&aplicacionid="+appid+"&sistemaid="+sistemaid+"&clienteid="+clienteid,"Error 002","NO");
    	var titulo=' Desbloqueo';
		var msg = ' La aplicación ha sido desbloqueada de forma correcta!';
		mensaje(titulo,msg);
    }

	
	

}
function eliminaCliente(usuario,url_des)
{
	var htm = "Esta seguro que quiere eliminar al cliente <strong>"+usuario+"</strong><hr /><strong>Importante:</strong> Al eliminar al cliente del sistema, se eliminará todo lo asociado al cliente incluso el sitio asociado al cliente.";
	
	footer = ' <button type="button" class="btn btn-danger btn-sm waves-effect waves-light" onclick="doeliminaCliente(\''+url_des+'\',\''+usuario+'\');" >Si, eliminar</button> '+
	 		' <button type="button" class="btn btn-secondary btn-sm waves-effect waves-light" data-dismiss="modal">Cancelar</button> ';

	$("#modal_cp_bdy").html(htm);
	$("#modal_cp_fter").html(footer);
	
	
}
function doeliminaCliente(url_des,usuario)
{
	urlIn = "../c_srv/cliente.php";
	dataIn = url_des;
	srv="ELIMINACLIENTE";
	msjError = "No pudimos realizar lo solicitado";	
	obj = getDataJson(urlIn,dataIn,srv,msjError);
	
	footer = ' <button type="button" class="btn btn-primary btn-sm waves-effect waves-light" onclick="reloadLocal();">Entendido</button> ';
	
	$("#modal_cp_bdy").html("El cliente <strong>"+usuario+"</strong>  fue eliminado");
	$("#modal_cp_fter").html(footer);
}

function modifica_cliente()
{
	$("#btn_crea_usuario").fadeOut("fast");
	var contError 	= 0;
	nombre 			= $("#nombre").val();	
	mail 			= $("#mail").val();
	tipo 			= $("#tipo").val();
	organizacion 	= $("#organizacion").val();
	t_licencia	 	= $("#t_licencia").val();
	sistema			= $("#sistema").val();
	
	ususario_mae 	= $("#ususario_mae").val();
	clave 			= $("#clave").val();
	
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
	
	if(tipo != "PERSONAL")
	{
		if(organizacion == "")
		{
			contError ++;
			htm += contError+"- Debe ingresar el nombre de la organización<br />";
		}
	
	}
	
	if(t_licencia != "FREE")
	{
		if(sistema == "")
		{
			contError ++;
			htm += contError+"- Debe ingresar el nombre del sistema<br />";
		}
	
	}
	
	
	if(ususario_mae  == "")
	{
		contError ++;
		htm += contError+"- Debe ingresar el nombre de usuario<br />";
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
        $("#btn_crea_usuario").fadeIn("fast");
		
	}
	else
	{	
		var htm='<img alt="" src="../images/Loading.gif" style="    width: 30px;"> En este momento estamos creando al Cliente y configurando el sistema, por favor espere un momento.';
		$("#modal_cp_bdy").html(htm);
		
		setTimeout(function(){
			
					msjError = "No pudimos realizar lo solicitado";
					urlIn = "../c_srv/cliente.php";
					formalioID = "frm_crea_usuario";
					srv="MODIFICACLIENTE";
					var urlEnv = getDataJsonSbm(urlIn,formalioID,srv,msjError);
			        //location.href = urlEnv;
					var lista_usuario_url = $("#lista_usuario_url").val();
					htm='<img src="../images/ok.png" style="width: 45px;" /> El Cliente fue modificado';
					footer='<button type="button" class="btn btn-default" data-dismiss="modal" onclick="goto(\''+lista_usuario_url+'\');">Entendido</button>';
			        
			        $("#modal_cp_bdy").html(htm);
					$("#modal_cp_fter").html(footer);
			        		
					$("#btn_crea_perfil").fadeIn("fast");
			        
				}, 1200);
		
		
	}
}

function crea_cliente()
{
	$("#btn_crea_usuario").fadeOut("fast");
	var contError 	= 0;
	nombre 			= $("#nombre").val();	
	mail 			= $("#correo").val();
	tipo 			= $("#tipo").val();
	organizacion 	= $("#organizacion").val();
	t_licencia	 	= $("#t_licencia").val();
	sistema			= $("#sistema").val();
	
	ususario_mae 	= $("#usuario").val();
	clave 			= $("#clave").val();
	
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
	
	if(tipo != "PERSONAL")
	{
		if(organizacion == "")
		{
			contError ++;
			htm += contError+"- Debe ingresar el nombre de la organización<br />";
		}
	
	}
	
	if(t_licencia != "FREE")
	{
		if(sistema == "")
		{
			contError ++;
			htm += contError+"- Debe ingresar el nombre del sistema<br />";
		}
	
	}
	
	
	if(ususario_mae  == "")
	{
		contError ++;
		htm += contError+"- Debe ingresar el nombre de usuario<br />";
	}else
	{	
		urlIn = "../c_srv/usuario.php";
		dataIn = "acc=VALIDAUSUARIOCLIENTE&ususario_mae="+ususario_mae;
		srv="VALIDAUSUARIOCLIENTE";
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
		var htm='<img alt="" src="../images/Loading.gif" style="    width: 30px;"> En este momento estamos creando al Cliente y configurando el sistema, por favor espere un momento.';
		$("#modal_cp_bdy").html(htm);
		
		setTimeout(function(){
			
					msjError = "No pudimos realizar lo solicitado";
					urlIn = "../c_srv/cliente.php";
					if(t_licencia == 'FREE')
					{
						urlIn = "http://104.211.29.91/public_html/prod/cyclo/sites/public/c_srv/cuenta.php";
					}
					
					formalioID = "frm_crea_usuario";
					srv="CREACUENTA";
					var urlEnv = getDataJsonSbm(urlIn,formalioID,srv,msjError);
			        //location.href = urlEnv;
					var lista_usuario_url = $("#lista_usuario_url").val();
					htm='<img src="../images/ok.png" style="width: 45px;" /> El Cliente fue creado correctamente!';
					footer='<button type="button" class="btn btn-default" data-dismiss="modal" onclick="goto(\''+lista_usuario_url+'\');">Entendido</button>';
			        
			        $("#modal_cp_bdy").html(htm);
					$("#modal_cp_fter").html(footer);
			        		
					$("#btn_crea_perfil").fadeIn("fast");
			        
				}, 1200);
		
		
	}
}