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
include '../c_negocio/negCaja.php';
include '../c_datos/dtCaja.php';

include ('../c_sistema_util/util.php');


$acc = "";
if(isset($_REQUEST["acc"]))
{
	$acc = $_REQUEST["acc"];
}

if($acc == "BUSCAPRODPVENTA")
{
	$str = $_REQUEST["codigo"];
	echo json_encode(negVenta::buscaProducto($str));
	
}
if($acc == "ADDVTA")
{
	$dv  		= $_REQUEST["dv"];
	$cajaid 	= $_REQUEST["cjd"];
	$total		= $_REQUEST["total"];
	$cantidad	= $_REQUEST["cantidad"];
	$tipopago	= $_REQUEST["tipopago"];
	$voucher	= $_REQUEST["boucher"];
	echo json_encode(negVenta::ventaLocalCaja($dv,$cajaid,$total,$cantidad,$tipopago,$voucher));
	
}





?>

