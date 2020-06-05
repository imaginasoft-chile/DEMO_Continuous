<?php 
class dtSistema{

	
	public static function getAplicacionesSistema()
	{
		$SQLQuery= "call getAplicacionesSistemaMenu(); ";
		return DBFactory::ExecuteSQL($SQLQuery);
		
	}
	public static function getAplicacionesBloqueadasSistema()
	{
		$SQLQuery= "call getAplicacionesBloqueadasSistema(); ";
		return DBFactory::ExecuteSQL($SQLQuery);
		
	}
	
	public static function getAplicacionCode($codigo)
	{
		$SQLQuery= "call getAplicacionCode('".$codigo."'); ";
		return DBFactory::ExecuteSQL($SQLQuery);
		
	}
	
	public static function getAplicacionid($goModulo)
	{
		$sql = "call getAplicacionid('".$goModulo."'); ";
		return DBFactory::ExecuteSQLFirst($sql);
	}
	
	public static function validaUsuario($correo,$clave)
	{
		
		$sql="select mu.*
				from mae_usuario mu
				 where mu.mail='".$correo."'
				  and mu.clave_mae='".$clave."';";
		//echo $sql;
		return DBFactory::ExecuteSQLFirst($sql);
	}	
	public static function saveBitacoraByOpoeracion($tbl,$id_name,$id,$usuario,$tipo,$detalle,$aplicacionid)
    {
    	$SQLquery="insert into ".$tbl."(".$id_name.", tipo_actividad, usuario_modifica, fecha_modificacion, detalle,moduloid)
        values('".$id."','".$tipo."','".$usuario."',now(),'".$detalle."','".$aplicacionid."') ";
    	
    	DBFactory::ExecuteNonQuery($SQLquery);
    }
    
    /**
     * Registra todas las actividades importantes del sistema
     * @param String $pk_id: [opcional]- ID del registro que se esta creando, modificando sino aplica se puede enviar un NA o un 0 
     * @param String $tabla_registro: [opcional]- Tabla asociada al identificador del registro indicado en el campo pk_id, sino aplica se puede enviar un NA o un 0 
     * @param String $modulo: [mandatorio]- Identifica el modulo en donde se esta realizando la acción
     * @param String $registro_tipo [mandatorio]- Identifica el tipo de registro realizado
     * @param Integer $usuarioid [mandatorio]- se debe indicar el usuario que realiza el registro o la acción
     */
    public static function creaSistemaRegistro($pk_id,$tabla_registro,$modulo,$registro_tipo,$usuarioid)
    {
    	$SQLquery="call creaSistemaRegistro('".$pk_id."','".$tabla_registro."','".$modulo."','".$registro_tipo."','".$usuarioid."')";
    	//echo $SQLquery;
    	DBFactory::ExecuteNonQuery($SQLquery);
    }
    
    public static function getUsuarioAdminMail()
    {
    	$sql = "call getUsuarioAdminMail(); ";
    	return DBFactory::ExecuteSQL($sql);
    	
    }
    
    public static function getSistemaDef()
    {
    	$sql = "call getSistemaDef();";
    	return DBFactory::ExecuteSQLFirst($sql);
    	
    }
    public static function getTotDenuncias()
    {
    	$SQLquery="call getDenuncias()";
    	return DBFactory::ExecuteSQL($SQLquery);
    }
    public static function getTotDenunciasByUsuario($usuarioid)
    {
    	$SQLquery="call getDenunciasByUsuario(".$usuarioid.")";
    	return DBFactory::ExecuteSQL($SQLquery);
    }
    public static function getTotConsultas()
    {
    	$SQLquery="call getConsultas()";
    	return DBFactory::ExecuteSQL($SQLquery);
    }
    public static function getTotConsultasByUsuario($usuarioid)
    {
    	$SQLquery="call getConsltasByUsuario(".$usuarioid.")";
    	return DBFactory::ExecuteSQL($SQLquery);
    }
    public static function getProyectoscreadoshoy_notif()
    {
    	$SQLquery="call getProyectoscreadoshoy_notif()";
    	return DBFactory::ExecuteSQL($SQLquery);
    }
    public static function getProyectoscreadoshoyByUser_notif($usuarioid)
    {
    	$SQLquery="call getProyectoscreadoshoyByUser_notif(".$usuarioid.")";
    	return DBFactory::ExecuteSQL($SQLquery);
    }
    public static function getActividadesPendientesByUser_notif($usuarioid)
    {
    	$SQLquery="call getActividadesPendientesByUser_notif(".$usuarioid.")";
    	return DBFactory::ExecuteSQL($SQLquery);
    }
    
    
    
}


?>