<?php
session_start();
include ('../c_negocio/negProveedor.php');
include ('../c_datos/dtProveedor.php');
include ('../c_datos/DBFactory.php');
include ('../c_sistema_util/util.php');

$acc = "";
if(isset($_REQUEST["acc"]))
{
    $acc = $_REQUEST["acc"];
}

if($acc == "CREAPROVEEDOR")
{
    $rut= $_REQUEST["rut"];
    $nombre= $_REQUEST["nombre"];
    
    $val = negProveedor::validaNombreProveedor($nombre);
    if($val == "ERROR")
    {
        echo json_encode("ERROR - El proveedor ya existe!");
    }else
    {
        negProveedor::addProveedor($rut,$nombre);
        echo json_encode("OK");
    }

}
if($acc=="GETPROVEEDORXID")
{
    $proveedorid	= $_REQUEST["proveedorid"];
    echo json_encode(negProveedor::GetProveedorxid($proveedorid));
}
if($acc == "MODIFICAPROVEEDOR")
{
    $rut				= $_REQUEST["rut_edita"];
    $nombre_edita			= $_REQUEST["nombre_edita"];
    $estado		= $_REQUEST["estado"];
    $proveedorid	= $_REQUEST["proveedorid"];
    negProveedor::modifProveedor($rut,$nombre_edita,$estado,$proveedorid);
    echo json_encode("OK");
    
}


?>

