<?php 
class dtCliente{

	public static function validaCorreoCliente($correo)
	{
		return DBFactory::ExecuteSQLFirst("call validaCorreoCliente('".$correo."');");
	}
	public static function addCliente($correo,$nombre,$direccion,$telefono)
	{
		$sql = "call addCliente('".$nombre."','".$correo."','".$direccion."','".$telefono."');";
		DBFactory::ExecuteNonQuery($sql);
	}
    public static function GetClientes()
    {
        return DBFactory::ExecuteSQL("call GetClientes();");
    }
    
    
}


?>