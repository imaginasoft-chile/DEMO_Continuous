<?php 
/*
error_reporting(E_ALL);
ini_set('display_errors', 1);
*/

session_start();

include ('../c_datos/DBFactory.php');
include '../c_negocio/negProducto.php';
include '../c_datos/dtProducto.php';
include '../c_negocio/negVenta.php';
include '../c_datos/dtVenta.php';

include ('../c_sistema_util/util.php');


$acc = "";
if(isset($_REQUEST["acc"]))
{
	$acc = $_REQUEST["acc"];
}

if($acc == "DESPACHAVENTA")
{
	$ventaid = $_REQUEST["ventaid"];
	negVenta::ventaSetEstado($ventaid,"DESPACHADA",$_SESSION["usuarioid"],$_SESSION["usuarioid"],"PENDIENTE");
	
}
if($acc == "CANCELARVENTAPENDIETE")
{
	$ventaid = $_REQUEST["ventaidcancela"];
	negVenta::ventaSetEstado($ventaid,"CANCELADA",$_SESSION["usuarioid"],$_SESSION["usuarioid"],"PENDIENTE");
	
}
if($acc == "ENTREGAVENTA")
{
	$ventaid = $_REQUEST["ventaid"];
	negVenta::ventaSetEstado($ventaid,"ENTREGADA",$_SESSION["usuarioid"],$_SESSION["usuarioid"],"DESPACHADA");
	
}
if($acc == "CANCELARVENTADESPACHO")
{
	$ventaid = $_REQUEST["ventaidcancela"];
	negVenta::ventaSetEstado($ventaid,"CANCELADA",$_SESSION["usuarioid"],$_SESSION["usuarioid"],"DESPACHADA");
	
}
if($acc=="ANULARVENTA")
{
    $ventaid = $_REQUEST["ventacajaid"];
    negVenta::AnularVenta($ventaid);
}




?>

