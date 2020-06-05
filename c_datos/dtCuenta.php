<?php 
class dtCuenta
{	
	public static function validaUsuarioAdmin($usuario, $clave)
	{
		$SQLQuery= "call validaUsuarioAdmin('".$usuario."', '".$clave."'); ";
		return DBFactory::ExecuteSQLFirst($SQLQuery);		
	}
	public static function getUsuario($usuarioid)
	{
		$SQLQuery= "call getUsuario(".$usuarioid."); ";
		return DBFactory::ExecuteSQLFirst($SQLQuery);	
	}
	

}
?>
