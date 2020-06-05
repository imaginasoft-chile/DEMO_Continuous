<?php 
/*
error_reporting(E_ALL);
ini_set('display_errors', 1);
*/

session_start();
include ('../c_negocio/negCuenta.php');
include ('../c_datos/dtCuenta.php');
include ('../c_datos/DBFactory.php');


include ('../c_negocio/negUsuario.php');
include ('../c_datos/dtUsuario.php');

include ('../c_sistema_util/util.php');


$acc = "";
if(isset($_REQUEST["acc"]))
{
	$acc = $_REQUEST["acc"];
}

if($acc == "VALIDAUSUARIO")
{
	$usuario		= $_REQUEST["usuario"];
	$clave			= $_REQUEST["clave"];
	
	$cuenta = negCuenta::validaUsuarioAdmin($usuario, $clave);
	
	if(count($cuenta)>0)
	{
		echo json_encode("OK");
	}else
	{
		echo json_encode("ERROR - El usuario y/o clave ingresados no son correctos!!!");
		
	}
	
}


?>

