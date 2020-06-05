<?php 
/*
error_reporting(E_ALL);
ini_set('display_errors', 1);
*/

session_start();
include ('../c_negocio/negGasto.php');
include ('../c_datos/dtGasto.php');
include ('../c_datos/DBFactory.php');


include ('../c_sistema_util/util.php');


$acc = "";
if(isset($_REQUEST["acc"]))
{
	$acc = $_REQUEST["acc"];
}

if($acc == "ADDGASTO")
{
	$tipo			= $_REQUEST["tipo"];
	$beneficiario	= $_REQUEST["beneficiario"];
	$nota			= $_REQUEST["nota"];
	$monto_gasto	= $_REQUEST["monto_gasto"];
	
	$monto_gasto = str_replace(".","", $monto_gasto);
	
	negGasto::addGasto($tipo,$beneficiario,$nota,$monto_gasto,$_SESSION["usuarioid"]);
	
	echo json_encode("OK");
	
}


?>

