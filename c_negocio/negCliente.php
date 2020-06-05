<?php
class negCliente{
	
	public static function validaCorreoCliente($correo)
	{
		$vn = dtCliente::validaCorreoCliente($correo);
		return $vn[0]["val"];
	}
	public static function addCliente($correo,$nombre,$direccion,$telefono)
	{
		return dtCliente::addCliente($correo,$nombre,$direccion,$telefono);
	}
    public static function GetClientes()
    {
        return dtCliente::GetClientes();
    }
}
?>