<?php 
/*
error_reporting(E_ALL);
ini_set('display_errors', 1);
*/

session_start();
include ('../c_negocio/negCaja.php');
include ('../c_datos/dtCaja.php');
include ('../c_datos/DBFactory.php');


include ('../c_sistema_util/util.php');


$acc = "";
if(isset($_REQUEST["acc"]))
{
	$acc = $_REQUEST["acc"];
}


if($acc == "ABRECAJA")
{
	$cajaid 	= $_REQUEST["cajaid"];
	$vendedor	= $_REQUEST["vendedor"];
	$monto_ini	= $_REQUEST["monto_ini"];
	$nota		= $_REQUEST["nota"];
	$salida 	= negCaja::cajaAbre($cajaid, $_SESSION["usuarioid"], $monto_ini,$vendedor);
	echo json_encode($salida);
}
if($acc == "CIERRACAJA")
{
	$cajaid 	= $_REQUEST["cjd"];
	$monto_fin	= $_REQUEST["monto_fin"];
	$salida 	= negCaja::cajaCierra($cajaid, $_SESSION["usuarioid"],$monto_fin);
	echo json_encode("OK");
}
if($acc == "GETUSERBYCAJA")
{
	$cajaid 	= $_REQUEST["cajaid"];
	
	echo json_encode(negCaja::getUsuariosByCajaid($cajaid));
}

?>

