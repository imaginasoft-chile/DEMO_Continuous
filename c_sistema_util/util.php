<?php


class util
{
	public static function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	public static function encodeKeyWord($palabra)
	{
		
		$ct="S";
		if(!strpos($palabra, "0") === false){$ct="N";}
		if(!strpos($palabra, "1") === false){$ct="N";}
		if(!strpos($palabra, "2") === false){$ct="N";}
		if(!strpos($palabra, "3") === false){$ct="N";}
		if(!strpos($palabra, "4") === false){$ct="N";}
		if(!strpos($palabra, "5") === false){$ct="N";}
		if(!strpos($palabra, "6") === false){$ct="N";}
		if(!strpos($palabra, "7") === false){$ct="N";}
		if(!strpos($palabra, "8") === false){$ct="N";}
		if(!strpos($palabra, "9") === false){$ct="N";}
		
		if($ct == "S")  
		{
			$palabra = str_replace("a", "0", $palabra);
			$palabra = str_replace("e", "9", $palabra);
			$palabra = str_replace("i", "8", $palabra);
			$palabra = str_replace("o", "7", $palabra);
			$palabra = str_replace("u", "6", $palabra);
			
			$palabra = str_replace("A", "5", $palabra);
			$palabra = str_replace("E", "4", $palabra);
			$palabra = str_replace("I", "3", $palabra);
			$palabra = str_replace("O", "2", $palabra);
			$palabra = str_replace("U", "1", $palabra);
		} 
		
		return ($palabra);
	}
	public static function decodeKeyWord($palabra)
	{
		$ct="S";
		if(!strpos($palabra, "a") === false){$ct="N";}
		if(!strpos($palabra, "e") === false){$ct="N";}
		if(!strpos($palabra, "i") === false){$ct="N";}
		if(!strpos($palabra, "o") === false){$ct="N";}
		if(!strpos($palabra, "u") === false){$ct="N";}
		
		if(!strpos($palabra, "A") === false){$ct="N";}
		if(!strpos($palabra, "E") === false){$ct="N";}
		if(!strpos($palabra, "I") === false){$ct="N";}
		if(!strpos($palabra, "O") === false){$ct="N";}
		if(!strpos($palabra, "U") === false){$ct="N";}
		
		if($ct == "S")
		{
			$palabra = str_replace("0", "a", $palabra);
			$palabra = str_replace("9", "e", $palabra);
			$palabra = str_replace("8", "i", $palabra);
			$palabra = str_replace("7", "o", $palabra);
			$palabra = str_replace("6", "u", $palabra);
			
			$palabra = str_replace("5", "A", $palabra);
			$palabra = str_replace("4", "E", $palabra);
			$palabra = str_replace("3", "I", $palabra);
			$palabra = str_replace("2", "O", $palabra);
			$palabra = str_replace("1", "U", $palabra);
		}
		
		return ($palabra);
	}
	/**
     * util::decodeParamURL($string)
     * [13-01-2016]-DOO: Decodifica los parametros de la URL
     * Version: 1.0
     * Estado: En Operacion
     * @param mixed $string: Parametros de la URL encriptado
     * @1q	return retorna la URL decodificada
     */
    public static function decodeParamURL($string)
    {
        $string = base64_decode($string);
        $string= self::decodeKeyWord($string);
        
        $cad_get = explode("&",$string); //separo la url por &
        foreach($cad_get as $value)
        {
            $val_get = explode("=",$value); //asigno los valosres al GET
            $_REQUEST[$val_get[0]]=utf8_decode($val_get[1]);
        }
    }
    public static function validaSession($vuelve) 
    {
    	if(!isset($_SESSION["IGT-usuarioid"]))
    	{	
    		$url = $vuelve.'./login.php';
    		header('Location: ' . $url, true, 301);
    		
    		
    		
    		exit();
    	}
    }
    
    public static function getPageApp($level,$codigo)
    {
    	$vuelve=self::getLevel($level);
    	$apps_sist = negSistema::getAplicacionCode($codigo);
    	foreach ($apps_sist as $as)
    	{
    		if($as["codigo"] == $codigo)
    		{
    			$GO_URL = $as["page"];
    		}
    	}
    	$salida = $vuelve.$GO_URL;
    	return $salida;
    	
    }
    
    
    
    public static function validaAppsByAppId($aplicacionid)
    {
    	$appsPerfil = $_SESSION["IGT-perfil_obj"];
    	$validacion = "NOK";
    	foreach ($appsPerfil as $ap)
    	{
    		if($ap["aplicacionid"] == $aplicacionid)
    		{
    			$validacion = "OK";
    		}
    		
    	}
    	
    	return $validacion;
    	
    	
    }
    
    /***
     * Entrega la URL codificada de una app del sistema.
     * @param INT $level -> Indica el nivel de donde fue llamado
     * @param STRING $codigo -> Se debe indicar el codigo interno de apps
     * @param string $param -> Parametros opcionales si es que se quiere enviar mas de un dato por la url todos deben llevar & ejemplo &id=34&cadigo=123
     * @return string
     */
    public static function creaURLApp($level,$codigo,$param="")
    {
    	$salida = '';
    	$vuelve=self::getLevel($level);
    	$GO_URL = util::encodeParamURL('pth=0|'.$codigo.$param);
    	$salida = $vuelve.'./index.php?'.$GO_URL;
    	
    	return $salida;
    	
    }
    public static function encodeParamURL($urlParam)
    {
    	
    	$urlParam = self::encodeKeyWord($urlParam);
    	return  "qwerty=".base64_encode($urlParam);
    }
    public static function validaFuncionApps($aplicacionid)
    {
    	$apps = $_SESSION["IGT-perfil_obj"];
    	$salida = "NO";
    	foreach ($apps as $a)
    	{
    		if($aplicacionid == $a["aplicacionid"])
    		{
    			$salida = "SI";
    		}
    		
    	}
    	
    	return $salida;
    }
    public static function getNombreMenu($obj)
    {
    	$salida = $obj["aplicacionidtxt"];
    	$det = negSistema::getSistemaDef();
    	if($obj["nombre_param"] != "")
    	{
    		$nom = $obj["nombre_param"];
    		$valor = $det[0][$nom];
    		
    		$salida = str_replace("[var]", $valor, $salida);
    	}
    	
    	return $salida;
    }
    
   
    
    public static function getheader($level){
    	
    	$vuelve=self::getLevel($level);
    	
    	/*
    	$urlenv="usuarioid=".$_SESSION["IGT-usuarioid"]."&user=true";
    	$urlenv="edita_usuario.php?".util::encodeParamURL($urlenv);
    	*/
    	
    	
    	$html= '<header class="navbar navbar-expand-lg navbar-light container d-block d-lg-flex" id="header-navbar">    
		    <a class="navbar-brand float-left float-lg-none" href="index.html" id="logo">
		        <img alt="" class="normal-logo" src="'.$vuelve.'img/logo.png" /> 
		         <span style="display: inline;" >Proyectos<span>
		    </a>
		    <button aria-controls="navbar-ex1-collapse" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler float-right float-lg-none" data-target=".navbar-ex1-collapse" data-toggle="collapse" type="button">
		        <span class="fa fa-bars"></span>
		    </button>
		    <ul class="nav navbar-nav mr-auto d-none d-lg-block mrg-l-none">
		        <li>
		            <a class="btn" id="make-small-nav">
		                <i class="fa fa-bars">
		                </i>
		            </a>
		        </li>
		        <li class="dropdown d-none d-md-block">
		            <a class="btn dropdown-toggle dropdown-nocaret" data-toggle="dropdown">
		                <i class="fa fa-bell">
		                </i>
		                <span class="count">
		                    3
		                </span>
		            </a>
		            <ul class="dropdown-menu notifications-list">
		                <li class="pointer">
		                    <div class="pointer-inner">
		                        <div class="arrow">
		                        </div>
		                    </div>
		                </li>
		                <li class="item-header">
		                    You have 3 new notifications
		                </li>
		                <li class="item">
		                     <a href="javascript:alert(\'En construccion\');">
		                        <i class="fa fa-comment">
		                        </i>
		                        <span class="content">
		                           Nuevo comentario 
		                        </span>
		                        <span class="time">
		                            <i class="fa fa-clock-o">
		                            </i>
		                            10 min.
		                        </span>
		                    </a>
		                </li>
		                <li class="item">
		                     <a href="javascript:alert(\'En construccion\');">
		                        <i class="fa fa-plus">
		                        </i>
		                        <span class="content">
		                            Alerta
		                        </span>
		                        <span class="time">
		                            <i class="fa fa-clock-o">
		                            </i>
		                            15 min.
		                        </span>
		                    </a>
		                </li>
		                <li class="item">
		                    <a href="javascript:alert(\'En construccion\');">
		                        <i class="fa fa-envelope">
		                        </i>
		                        <span class="content">
		                            Nuevo mensaje 
		                        </span>
								
		                        <span class="time">
		                            <i class="fa fa-clock-o">
		                            </i>
		                            25 min.
		                        </span>
		                    </a>
		                </li>
		               
		                <li class="item-footer">
		                    <a href="javascript:alert(\'En construccion\');">
		                        Ver Todas las Notificaciones
		                    </a>
		                </li>
		            </ul>
		        </li>
		        <li class="dropdown d-none d-md-block">
		            <a class="btn dropdown-toggle dropdown-nocaret" data-toggle="dropdown">
		                <i class="fa fa-tasks">
		                </i>
		                <span class="count">
		                    1
		                </span>
		            </a>
		            <ul class="dropdown-menu notifications-list messages-list">
		                <li class="pointer">
		                    <div class="pointer-inner">
		                        <div class="arrow">
		                        </div>
		                    </div>
		                </li>
		                <li class="item first-item">
		                   <a href="javascript:alert(\'En construccion\');">
		                       <span class="content-headline">
		                       		Cargar horas de trabajo

									 <span class="time">
										<br />
			                            <i class="fa fa-clock-o">
			                            </i>
			                            13 min.
			                        </span>
		                       </span>
		                       
		                    </a>
		                </li>
		                
		                <li class="item-footer">
		                    <a href="javascript:alert(\'En construccion\');">
		                        Revisar todas las tareas
		                    </a>
		                </li>
		            </ul>
		        </li>
		        		        
		    </ul>
		    <ul class="nav navbar-nav ml-auto float-right float-lg-none" id="header-nav">
		        <li class="dropdown d-md-block">
		            <a class="btn dropdown-toggle" data-toggle="dropdown">
		                <i class="fa fa-plus">
		                        </i> Agregar
		            </a>
		            <ul class="dropdown-menu">
						<li class="item">
		                   <a href="javascript:alert(\'En construccion\');">
		                        <i class="fa fa-calendar">
		                        </i>
		                        Registro de Horas
		                    </a>
		                </li>
						<li class="item">
		                    <a href="javascript:alert(\'En construccion\');">
		                        <i class="fa fa-file-text">
		                        </i>
		                        Nueva Tarea
		                    </a>
		                </li>
		                <li class="item">
							<a  class="md-trigger" data-toggle="modal"  href="#modal-form_cproy" >
							
		                         <i class="fa fa-sitemap">
		                        </i>
		                        Crear Proyecto
		                    </a>
		                </li>
						
		                
		                
		            </ul>
		        </li>
		        <li class="dropdown profile-dropdown">
		            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
		                <img alt="" src="'.$vuelve.'img/usuarios/no_user.png"/>
		                <span class="d-none d-md-block">
		                    '.$_SESSION["IGT-nombre_completo"].'
		                </span>
		                <b class="caret">
		                </b>
		            </a>
		            <ul class="dropdown-menu dropdown-menu-right">
		                <li>
		                    <a href="user-profile.html">
		                        <i class="fa fa-user">
		                        </i>
		                        Profile
		                    </a>
		                </li>
		                <li>
		                    <a href="#">
		                        <i class="fa fa-cog">
		                        </i>
		                        Settings
		                    </a>
		                </li>
		                <li>
		                    <a href="#">
		                        <i class="fa fa-envelope-o">
		                        </i>
		                        Messages
		                    </a>
		                </li>
		                <li>
		                    <a href="'.$vuelve.'cw_home/login.php">
		                        <i class="fa fa-power-off">
		                        </i>
		                        Logout
		                    </a>
		                </li>
		            </ul>
		        </li>
		        <li class="d-none d-sm-block">
		            <a class="btn" href="'.$vuelve.'cw_home/login.php" >
		                <i class="fa fa-power-off">
		                </i>
		            </a>
		        </li>
		    </ul>
		</header>
		';
    	
    	return $html;
    	
    }
    
    
    
    public static function getJavaFunctions($level){
    
    	$vuelve=self::getLevel($level);
    
    	$html= '
				<script src="'.$vuelve.'assets/js/jquery-3.3.1.min.js"></script>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
				<script src="'.$vuelve.'assets/js/bootstrap.min.js"></script>
				<script src="'.$vuelve.'assets/js/owl.carousel.js"></script>
				<script src="'.$vuelve.'assets/js/bootstrap-datetimepicker.min.js"></script>
				
				
		';
    	
    	
    	
    	
    	return $html;
    }
    public static function geHeaderSistem($level)
    {
    	$vuelve=self::getLevel($level);
    	
    	
    	$GO_URL = util::creaURLApp(0, "conf_usuario_mis_datos");
    	$href_mis_datos	=' href="'.$GO_URL.'" ';
    	
    	
    	$html = '<nav class="navbar navbar-expand-lg header_navigation bg_282828 w-100 oswald_font">
	        <div class="container">
	            <a class="logo navbar-brand" href="index.html"><img src="../images/logo.png" alt="Emporio Maruri" style="width:120px;"></a>
	            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	                <span class="navbar-toggler-icon"></span>
	            </button>
	            <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
	                <ul class="navbar-nav menubar margin_0_auto">
	                    <li class="nav-item active">
	                        <a class="nav-link" href="'.util::creaURLApp(0, "home").'">Inicio <span class="sr-only">(current)</span></a>
	                    </li>
	                    <li class="nav-item">
	                        <a class="nav-link" href="'.util::creaURLApp(0, "ventas").'">Ventas</a>
	
	                    </li>';
		    	if($_SESSION["IGT-perfil"] == 'admin' || $_SESSION["IGT-perfil"] == 'vendedor_admin')
		    	{
		    		$html.='
			                    <li class="nav-item">
			                        <a class="nav-link" href="'.util::creaURLApp(0, "gastos").'">Gastos</a>
			                    </li>';
		    	}
    			if($_SESSION["IGT-perfil"] == 'admin' || $_SESSION["IGT-perfil"] == 'vendedor_admin')
    			{
	         	 $html.='  
	                    <li class="nav-item">
	                        <a class="nav-link" href="'.util::creaURLApp(0, "productos").'">Productos</a>
	                    </li>';
	         	 $html.='
	                    <li class="nav-item">
	                        <a class="nav-link" href="'.util::creaURLApp(0, "tipo_producto").'">Tipo Productos</a>
	                    </li>';
    			}
    			
    			if($_SESSION["IGT-perfil"] == 'admin' || $_SESSION["IGT-perfil"] == 'vendedor_internet')
    			{
    			$html.='
 						<li class="nav-item">
	                        <a class="nav-link" href="'.util::creaURLApp(0, "entregas").'">Entregas</a>
	                        		
	                    </li>';
    			}
    			if($_SESSION["IGT-perfil"] == 'admin')
    			{
	          		$html.='  
	                    <li class="nav-item">
	                        <a class="nav-link" href="'.util::creaURLApp(0, "informes").'">Informes</a>
	                    </li>';
    			}
	          $html.='  
	                    <li class="nav-item">
	                        <a class="nav-link" href="'.$vuelve.'login.php">Salir</a>
	                    </li>
	                </ul>
	                
	            </div>
	        </div>
	    </nav>';
    	
    	return $html;
    	
    	
    }
    public static function geHeaderCaja($level)
    {
    	$vuelve=self::getLevel($level);
    	
    	
    	$GO_URL = util::creaURLApp(0, "conf_usuario_mis_datos");
    	$href_mis_datos	=' href="'.$GO_URL.'" ';
    	
    	
    	$html = '<nav class="navbar navbar-expand-lg header_navigation bg_282828 w-100 oswald_font">
	        <div class="container">
	            
	            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	                <span class="navbar-toggler-icon"></span>
	            </button>
	            <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
	                <ul class="navbar-nav menubar margin_0_auto">
	                    <li class="nav-item active">
	                        <a class="nav-link" href="'.util::creaURLApp(0, "home").'">Inicio <span class="sr-only">(current)</span></a>
	                    </li>
	                    
 						
	                </ul>
	                        		
	            </div>
	        </div>
	    </nav>';
    	
    	return $html;
    	
    	
    }
    public static function getHeadHtml($level,$descripcion,$validaSession='si'){

    	$vuelve=self::getLevel($level);      
    	if($validaSession == 'si')
    	{
    		//Valida session
    		self::validaSession($vuelve);
    		
    	}else
    	{
    	
    		$_SESSION["IGT-usuarioid"] = "1";
    	}
       
        
        $html= '
					<title>Emporio Maruri- Administración</title>
					    <meta charset="utf-8">
					    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
					    <!--description-->
					    <meta name="description" content="Sistema de Ventas en linea">
					    <!--Key Words-->
					    <meta name="keywords" content="">
					    <!--bootstrap-->
						
					    <link rel="stylesheet" href="'.$vuelve.'assets/css/bootstrap.min.css">
					    <!--fontawesome style-->
					    <link rel="stylesheet" href="'.$vuelve.'assets/css/fonts-awesome.min.css">
					    <!--style-->
					    <link rel="stylesheet" href="'.$vuelve.'assets/css/owl.carousel.min.css">
					    <link rel="stylesheet" href="'.$vuelve.'assets/css/owl.theme.default.min.css">
					    <link rel="stylesheet" href="'.$vuelve.'assets/css/style.css">
					    <link rel="stylesheet" href="'.$vuelve.'assets/css/responsive.css">
						
						<link rel="stylesheet" href="'.$vuelve.'assets/css/bootstrap-datetimepicker.css">
						
						


		
					    <link rel="shortcut icon" href="../images/logo.png">
					
					';
      
        return $html;       
    }
    public static function getLevel($level)    
    {
        $vuelve="";
        if($level==0){
        	$vuelve="./";
        }
        if($level==1 || $level==1000){
            $vuelve="../";
        }
        if($level==2){
            $vuelve="../../";
        }
        if($level==3){
            $vuelve="../../../";
        }
        return $vuelve;
    }
   	
	public static function pintaConsoleJquery($datoInConsole)
    {
        echo '<script language="javascript" type="text/javascript">
                    $( document ).ready(function() {
                        console.log("'.$datoInConsole.'")
                    });
                    
             </script>
            ';
    }
    public static function getSelected($d1,$d2)
    {
    	$salida='  ';
    	if($d1==$d2)
    	{
    		$salida=' selected="selected" ';
    	}
    	
    	return($salida);
    }
    
    public static function getModal($id,$cierre="SI")
    {
    	
    	$htm= '
						<div class="modal fade" id="'.$id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title" id="md_title_'.$id.'">Modal title</h4>';
    									if($cierre == 'SI')
    									{
    										$htm .='<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
    									}
		$htm.='
									</div>
									<div class="modal-body" id="md_body_'.$id.'">
										
										
									</div>
									<div class="modal-footer" id="md_footer_'.$id.'">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
										<button type="button" class="btn btn-primary">Aceptar</button>
									</div>
								</div><!-- /.modal-content -->
							</div><!-- /.modal-dialog -->
						</div><!-- /.modal -->					
				';
    	
    	return $htm;
    }
    
    public static function getFooter($level)
    {
    	
    	$vuelve=self::getLevel($level);
    	
    	$htm='	<div class="row mb-4">
			    	<div class="col-md-12">
				    	<footer>
				    	Powered by - <a href="http://cyclosustainability.com/" target="_blank" style="font-weight:300;color:#ffffff;background:#1d1d1d;padding:0 3px;">Cyclo<span style="color:#ffa733;font-weight:bold"> Sustainability</span> </a>
				    	</footer>
			    	</div>
			    </div>';
    	
    	return $htm;
    }
}
?>