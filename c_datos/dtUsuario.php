<?php 
class dtUsuario{

	public static function getUsuario($usuarioid)
	{
		$SQLQuery= "call getUsuario(".$usuarioid."); ";
		return DBFactory::ExecuteSQLFirst($SQLQuery);
	}
	public static function getUsuariosSistema()
	{
		$SQLQuery= "call getUsuariosSistema(); ";
		return DBFactory::ExecuteSQL($SQLQuery);
	}
	public static function validaDisponibilidadUsarioMae($ususario_mae)
	{
		$SQLQuery= "call validaDisponibilidadUsarioMae('".$ususario_mae."'); ";
		return DBFactory::ExecuteSQLFirst($SQLQuery);
	}
	public static function creaUsuario($nombre,$apellidos,$mail,$telefono,$ususario_mae,$clave,$usuarioid,$perfil,$avataridPath)
	{
		$SQLQuery= "call creaUsuario('".$nombre."','".$apellidos."','".$mail."','".$telefono."','".$ususario_mae."','".$clave."','".$usuarioid."','".$perfil."','".$avataridPath."'); ";
		return DBFactory::ExecuteSQLFirst($SQLQuery);
	}
	public static function modificaaUsuario($nombre,$apellidos,$mail,$telefono,$ususario_mae,$clave,$perfil,$usuarioid,$estado)
	{
		$SQLQuery= "call modificaUsuario('".$nombre."','".$apellidos."','".$mail."','".$telefono."','".$ususario_mae."','".$clave."','".$usuarioid."','".$perfil."','".$estado."'); ";
		DBFactory::ExecuteNonQuery($SQLQuery);
	}
	public static function modificaImagen($usuarioid,$avataridPath)
	{
		$SQLQuery= "call modificaImagen('".$avataridPath."','".$usuarioid."'); ";
		DBFactory::ExecuteNonQuery($SQLQuery);
	}
	public static function desHabilitaUsuario($usuarioid)
	{
		$SQLQuery= "call desHabilitaUsuario('".$usuarioid."'); ";
		DBFactory::ExecuteNonQuery($SQLQuery);
	}
	public static function eliminarUsuario($usuarioid)
	{
		$SQLQuery= "call eliminarUsuario('".$usuarioid."'); ";
		DBFactory::ExecuteNonQuery($SQLQuery);
	}
	
    
}


?>