<?php 
/*
error_reporting(E_ALL);
ini_set('display_errors', 1);
*/
session_start();
include ('./c_datos/DBFactory.php');
include ('./c_sistema_util/util.php');


$acc = "";
if(isset($_REQUEST["acc"]))
{
	$acc = $_REQUEST["acc"];
}

if($acc == "ADDCARR")
{
	$productoid	= $_REQUEST["productoid"];
	$cant		= $_REQUEST["cant"];
	$ant = '';
	
	if(isset($_SESSION["prd_ct"]))
	{
		$ant = $_SESSION["prd_ct"].'/';
	}
	
	$_SESSION["prd_ct"] = $ant.$productoid."|".$cant;
	
	echo "SALIDA:".$_SESSION["prd_ct"];
}

if($acc == "CHGCANT")
{
	$productoid	= $_REQUEST["productoid"];
	$cant		= $_REQUEST["cant"];
	
	$ns = '';
	
	$arrP = $_SESSION["prd_ct"];
	$arrP = explode('/', $arrP);
	
	//$_SESSION["prd_ct"] = '';
	$cont = 0;
	foreach($arrP as $a)
	{
		$cont++;
		if($cont > 1)
		{
			$ns= $ns.'/';
		}
		$sp = explode('|', $a);
		$cantidad = $sp[1];
		
		if($sp[0] == $productoid)
		{	
			$cantidad = $cant;
			
		}
		
		$ns= $ns.$sp[0].'|'.$cantidad;
	}
	
	$_SESSION["prd_ct"] = $ns;
}
if($acc=="DELPROD")
{
	$productoid	= $_REQUEST["productoid"];
	
	$ns = '';
	
	$arrP = $_SESSION["prd_ct"];
	$arrP = explode('/', $arrP);
	
	//$_SESSION["prd_ct"] = '';
	$cont = 0;
	foreach($arrP as $a)
	{
		$cont++;
		if($cont > 1)
		{
			$ns= $ns.'/';
		}
		$sp = explode('|', $a);
		
		if($sp[0] != $productoid)
		{
			
			$ns= $ns.$sp[0].'|'.$sp[1];
		}
	}
	
	$_SESSION["prd_ct"] = $ns;
}
if($acc == 'COMPRA')
{
	$nombre 	= $_REQUEST["nombre"];
	$direccion	= $_REQUEST["direccion"];
	$telefono	= $_REQUEST["telefono"];
	$correo		= $_REQUEST["correo"];
	$arrP 		= $_SESSION["prd_ct"];
	$arrP = explode('/', $arrP);
	$val_tot = 0;
	
	$SQLQuery = "call ventaCrea('".$nombre."','".$direccion."','".$telefono."','".$correo."',".$val_tot.",'INTERNET')";
	$vid = DBFactory::ExecuteSQLFirst($SQLQuery);
	$ventaid = $vid[0]["ventaid"];
	
	$SQLQuery = "call ventaSetEstado('".$ventaid."','PENDIENTE',0,0,'NA')";
	DBFactory::ExecuteNonQuery($SQLQuery);
	
	
	foreach($arrP as $a)
	{	
		$sp = explode('|', $a);
		$pid = $sp[0];
		$cant = $sp[1];
		
		$SQLQuery = "call getProductoDetail(".$pid.")";
		$pd = DBFactory::ExecuteSQLFirst($SQLQuery);
		$valor_unidad = $pd[0]["precio_internet"];
		$valor_total = (FLOAT)$cant * (FLOAT)$pd[0]["precio_internet"];
		
		$val_tot = $val_tot + $valor_total;
		
		$SQLQuery = "call ventaCreaProducto('".$ventaid."',".$pid.",".$cant.",".$valor_unidad.",".$valor_total.")";
		DBFactory::ExecuteNonQuery($SQLQuery);
		
		
	}
	
	
	$SQLQuery = "update venta  set valor_total=".$val_tot." where ventaid =".$ventaid.";";
	DBFactory::ExecuteNonQuery($SQLQuery);
	
	//Limpia datos de la session
	$_SESSION["prd_ct"] = '';
	
}

?>

