<?php
class dtProveedor{
    
    public static function GetProveedores()
    {
        return DBFactory::ExecuteSQLFirst("call GetProveedores();");
    }
    public static function addProveedor($rut,$nombre)
    {
        $sql = "call addProveedor('".$rut."','".$nombre."');";
        DBFactory::ExecuteNonQuery($sql);
    }
    public static function validaNombreProveedor($nombre)
    {
        return DBFactory::ExecuteSQLFirst("call validaNombreProveedor('".$nombre."');");
    }
    public static function GetProveedorxid($proveedorid)
    {
        return DBFactory::ExecuteSQLFirst("call GetProveedorxid(".$proveedorid.");");
    }
    public static function modifProveedor($rut,$nombre_edita,$estado,$proveedorid)
    {
        $sql = "call modifProveedor('".$rut."','".$nombre_edita."','".$estado."',".$proveedorid.");";
        DBFactory::ExecuteNonQuery($sql);
    }
    
}


?>