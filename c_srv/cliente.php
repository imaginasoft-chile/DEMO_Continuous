<?php 
/*
error_reporting(E_ALL);
ini_set('display_errors', 1);
*/

session_start();
include ('../c_negocio/negCliente.php');
include ('../c_datos/dtCliente.php');
include ('../c_datos/DBFactory.php');


include ('../c_sistema_util/util.php');


$acc = "";
if(isset($_REQUEST["acc"]))
{
	$acc = $_REQUEST["acc"];
}

if($acc == "CREACLIENTE")
{
	$correo= $_REQUEST["correo"];
	$nombre= $_REQUEST["nombre"];
	$direccion= $_REQUEST["direccion"];
	$telefono= $_REQUEST["telefono"];
	
	$val = negCliente::validaCorreoCliente($correo);
	if($val == "ERROR")
	{
		echo json_encode("ERROR - El correo del cliente ya existe!");
	}else
	{
	    negCliente::addCliente($correo,$nombre,$direccion,$telefono);
	    echo json_encode("OK");		
	}
	
	
	
}


?>

