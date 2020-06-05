<?php
include ('../c_sistema_util/mailin-smtp-api-master/Mailin.php');

class negSistema{
	
	public static function getAplicacionesSistema()
	{
		return dtSistema::getAplicacionesSistema();
	}
	public static function getAplicacionesBloqueadasSistema()
	{
		return dtSistema::getAplicacionesBloqueadasSistema();
		
	}
	public static function getAplicacionCode($codigo)
	{
		return dtSistema::getAplicacionCode($codigo);
	}
	public static function getAplicacionid($goModulo)
	{
		$ap =  dtSistema::getAplicacionid($goModulo);		
		return $ap[0]["aplicacionid"];
	}	
	public static function validaUsuario($correo,$clave)
	{
		//OLD
	}
	
	
	/**
	 * mailing::sendMail()
	 *
	 * @param mixed $cabeceraIn: puede ser '' o enviar formato [From: E-Learning <noreply@imaginasoft.cl>]
	 * @param mixed $to
	 * @param mixed $subjet
	 * @param mixed $body
	 * @return void
	 */
	public static function sendMail($cabeceraIn,$to,$subjet,$body)
	{
		$test = false;
		//$test = true;
		// Para enviar un correo HTML, debe establecerse la cabecera Content-type
		$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
		$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		
		$cabeceras .= "X-Priority: 3\n";
		$cabeceras .= "X-MSMail-Priority: Normal\n";
		$cabeceras .= "X-Mailer: php\n";
		
		if($cabeceraIn != '')
		{
			$cabeceras .= $cabeceraIn."\r\n";
		}else
		{
			$cabeceras .= 'From: Barometro <imagina@imaginasoft.cl' . "\r\n";
		}
		$mensaje = self::getHtmlMail($body);
		self::saveBitacoraByOpoeracion("mailing_bitacora","correo_to",$to,$_SESSION["IF-mail"],"Envia Correo ","to[".$to."] subjet [".$subjet."] mensaje[".$mensaje."] cabecera[".$cabeceras."]");
		if($test == false)
		{
			mail($to, utf8_decode($subjet), utf8_decode($mensaje), $cabeceras);
		}
	}
	/**
	 * Registra todas las actividades importantes del sistema
	 * @param String $pk_id: [opcional]- ID del registro que se esta creando, modificando sino aplica se puede enviar un NA o un 0
	 * @param String $tabla_registro: [opcional]- Tabla asociada al identificador del registro indicado en el campo pk_id, sino aplica se puede enviar un NA o un 0
	 * @param String $modulo: [mandatorio]- Identifica el modulo en donde se esta realizando la acción
	 * @param String $registro_tipo [mandatorio]- Identifica el tipo de registro realizado	 
	 */
	public static function creaSistemaRegistro($pk_id,$tabla_registro,$modulo,$registro_tipo)
	{
		$usuarioidADM = "1";
		if(isset($_SESSION["IGT-usuarioid"]))
		{
			$usuarioidADM = $_SESSION["IGT-usuarioid"];
		}
		
		dtSistema::creaSistemaRegistro($pk_id,$tabla_registro,$modulo,$registro_tipo,$usuarioidADM);
		
	}
	public static function sendMailAutonmo($subjet,$body,$usuarioid)
	{
		$mailsTo = dtSistema::getUsuarioAdminMail();
		
		foreach ($mailsTo as $m)
		{
			self::sendMailSMTPSB($m["mail"],$subjet,$body,$usuarioid);
			
		}
	}
	
	public static function getHtmlMail($mensaje)
	{
		$html_r = '<html>
                    <head>
                    <style>
                body
                {
                    font-family:  sans-serif;
                    margin: 0;
                    font-size: 13px;
                    color: #524a4a;
                }
				
				
                .td_vista_curso_evalua
                {

				
                }
                .title
                {
                    font-size: 18px;
                    font-weight: bold;
                }
				
                    </style>
                    </head>
                    <body>
                        <table width="100%" >
                            <tr>
                                <td class="td_vista_curso_evalua">
                                    MENSAJE_A_ENVIAR
                                </td>
                            </tr>
                        </table>
                    </body>
                </html>';
		
		$html_r = str_replace("MENSAJE_A_ENVIAR",$mensaje,$html_r);
		
		return $html_r;
		
	} 
	
	public static function saveNavegacion($nota="Navegacion normal",$tipo='navegacion',$aplicacionid=0)
	{
		self::saveBitacoraByOpoeracion("sistema_navegacion", "navegacionidWEB", session_id(), $_SESSION["IGT-usuarioid"], $tipo, $nota,$aplicacionid);
	}
	public static function saveBitacoraByOpoeracion($tbl,$id_name,$id,$usuario,$tipo,$detalle,$aplicacionid)
	{
		dtSistema::saveBitacoraByOpoeracion($tbl,$id_name,$id,$usuario,$tipo,$detalle,$aplicacionid);
	}
	
	public static function sendMailSMTPSB($to,$subjet,$body,$usuarioid)
    {
    	
    	//PARA AGERGAR CON COPIA OCULTA UTILIZAR addBcc('contacto@imaginasoft.cl','Imagina Soft')->
    	$mensaje = self::getHtmlMail($body);
    	
    	$mailin = new Mailin('dolivares@imaginasoft.cl', 'UBbI6xd3typGLv8V');
    	$mailin->
    	addTo($to,'')->
    	setFrom('noreply@cyclo.cl', 'Administración de Proyectos')->
    	setSubject($subjet)->
    	setHtml($mensaje);
    	$res = $mailin->send();
    	
    	$RESULTADO =  json_encode($res);
    	
    	self::saveBitacoraByOpoeracion("sistema_mailing_bitacora","correo_to",$to,$usuarioid,"Envia Correo SB","salida[".$RESULTADO."] to[".$to."] subjet [".$subjet."] mensaje[".$mensaje."]",0);    	
    	
    }
    
    public static function getSistemaDef()
    {
    
    	return dtSistema::getSistemaDef();
    	
    }
    public static function getProyectoscreadoshoy_notif()
    {
    	return dtSistema::getProyectoscreadoshoy_notif();
    }
    public static function getProyectoscreadoshoyByUser_notif($usuarioid)
    {
    	return dtSistema::getProyectoscreadoshoyByUser_notif($usuarioid);
    }
    public static function getActividadesPendientesByUser_notif($usuarioid)
    {
    	return dtSistema::getActividadesPendientesByUser_notif($usuarioid);
    }
    
}
?>