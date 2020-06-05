<?php 
class negCuenta
{
	public static function validaUsuarioAdmin($usuario, $clave)
	{
		 		 
		$cuenta =  dtCuenta::validaUsuarioAdmin($usuario, $clave);
		 if(count($cuenta) > 0)
		 {
		 	self::setSession($cuenta[0]["usuarioid"]);		 	
		 }else
		 {
		 	session_unset();
		 	session_destroy();		 	
		 	
		 }
		 
		 return $cuenta;
	}
	
	public static function setSession($usuarioid)
	{
		$usr = self::getUsuario($usuarioid);

		$_SESSION["usuarioid"] = $usr[0]["usuarioid"];
		$_SESSION["usuario_obj"] = $usr;
		$_SESSION["IGT-usuarioid"] = $usr[0]["usuarioid"];
		$_SESSION["IGT-correo"] = $usr[0]["correo"];
		$_SESSION["IGT-estado"] = $usr[0]["estado"];
		$_SESSION["IGT-nombre"] = $usr[0]["nombre"];
		$_SESSION["IGT-usuario"] = $usr[0]["usuario"];
		$_SESSION["IGT-perfil"] = $usr[0]["perfil"];
		
	}
	
	public static function getUsuario($usuarioid)
	{
		return dtCuenta::getUsuario($usuarioid);		
	}
	
	
}

?>