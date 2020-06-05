<?php
class negProveedor{
    
    public static function GetProveedores()
    {
        return dtProveedor::GetProveedores();
    }
    public static function addProveedor($rut,$nombre)
    {
        return dtProveedor::addProveedor($rut,$nombre);
    }
    public static function validaNombreProveedor($nombre)
    {
        $vn = dtProveedor::validaNombreProveedor($nombre);
        return $vn[0]["val"];
    }
    public static function GetProveedorxid($proveedorid)
    {
        return dtProveedor::GetProveedorxid($proveedorid);
    }
    public static function modifProveedor($rut,$nombre_edita,$estado,$proveedorid)
    {
        return dtProveedor::modifProveedor($rut,$nombre_edita,$estado,$proveedorid);
    }
}
?>