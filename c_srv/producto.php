<?php 
/*
error_reporting(E_ALL);
ini_set('display_errors', 1);
*/

session_start();
include ('../c_negocio/negProducto.php');
include ('../c_datos/dtProducto.php');
include ('../c_datos/DBFactory.php');


include ('../c_sistema_util/util.php');


$acc = "";
if(isset($_REQUEST["acc"]))
{
	$acc = $_REQUEST["acc"];
}

if($acc == "CREAPROD")
{
	$tipo				= $_REQUEST["tipo"];
	$nombre				= $_REQUEST["nombre"];
	$codigo				= $_REQUEST["codigo"];
	$descripcion		= $_REQUEST["descripcion"];
	$precio_venta		= $_REQUEST["precio_venta"];
	$precio_oferta		= $_REQUEST["precio_oferta"];
	$precio_internet	= $_REQUEST["precio_internet"];
	$condicion_oferta	= $_REQUEST["condicion_oferta"];
	$tipo_unidad		= $_REQUEST["tipo_unidad"];
	
	
	$val = negProducto::validaNombreProducto($nombre);
	if($val == "ERROR")
	{
		echo json_encode("ERROR - El nombre del producto ya existe y no puedes crear 2 productos con el mismo nombre!");
	}else
	{
		$val = 'OK';
		if($codigo != "")
		{
			$val = negProducto::validaCodigoProducto($codigo);
		}
		
		if($val == "ERROR")
		{
			echo json_encode("ERROR - El codigo del producto ya existe y no puedes crear 2 productos con el mismo codigo!");
		}else
		{
			//CREA PROD
			$hoy= date("dmY[His]_");
			$nameFile = $_FILES["imagen"]['name'];
			$tmpFile = $_FILES["imagen"]['tmp_name'];
			$finalPath = '';
			if ($tmpFile != ""){
				
				$finalPath= '../archivos/productos/'.$hoy.$nameFile;
				move_uploaded_file($tmpFile,$finalPath);
			}else
			{
				$finalPath = "../images/producto_icon.png";
			}
			
			negProducto::addProducto($tipo,$nombre,$codigo,$descripcion,$precio_venta,$precio_oferta,$precio_internet,$finalPath,$_SESSION["usuarioid"],$condicion_oferta,$tipo_unidad);
			echo json_encode("OK");
		}
		
	}
	
}
if($acc == "MODIFICAPROD")
{
		$productoid_edita 	= $_REQUEST["productoid_edita"];
		$tipo				= $_REQUEST["tipo_edita"];
		$nombre				= $_REQUEST["nombre_edita"];
		$codigo				= $_REQUEST["codigo_edita"];
		$descripcion		= $_REQUEST["descripcion_edita"];
		$precio_venta		= $_REQUEST["precio_venta_edita"];
		$precio_oferta		= $_REQUEST["precio_oferta_edita"];
		$precio_internet	= $_REQUEST["precio_internet_edita"];
		$posicion			= $_REQUEST["posicion_edita"];
		$condicion_oferta	= $_REQUEST["condicion_oferta_edita"];
		$tipo_unidad		= $_REQUEST["tipo_unidad_edita"];
		
		$nombre_anterior 	= $_REQUEST["nombre_anterior"];
		$codigo_anterior	= $_REQUEST["codigo_anterior"];
		$imagen_anterior	= $_REQUEST["imagen_anterior"];
		
		$validaNom = 'SI';
		$validaCod= 'SI';
		if($nombre == $nombre_anterior)
		{
			$validaNom = 'NO';
		}
		if($codigo == $codigo_anterior)
		{
			$validaCod = 'NO';
		}
		
		$val = negProducto::validaNombreProducto($nombre);
		if($val == "ERROR" && $validaNom == 'SI')
		{
			echo json_encode("ERROR - El nombre del producto ya existe y no puedes crear 2 productos con el mismo nombre!");
		}else
		{
			$val = 'OK';
			if($codigo != "" && $validaCod == 'SI')
			{
				$val = negProducto::validaCodigoProducto($codigo);
			}
			
			if($val == "ERROR")
			{
				echo json_encode("ERROR - El codigo del producto ya existe y no puedes crear 2 productos con el mismo codigo!");
			}else
			{
				//MODIF PROD
				$hoy= date("dmY[His]_");
				$nameFile = $_FILES["imagen_edita"]['name'];
				$tmpFile = $_FILES["imagen_edita"]['tmp_name'];
				$finalPath = '';
				if ($tmpFile != ""){
					
					$finalPath= '../archivos/productos/'.$hoy.$nameFile;
					move_uploaded_file($tmpFile,$finalPath);
				}else
				{	
						$finalPath = $imagen_anterior;
				}
				
				negProducto::modifProducto($tipo,$nombre,$codigo,$descripcion,$precio_venta,$precio_oferta,$precio_internet,$finalPath,$_SESSION["usuarioid"],$productoid_edita,$posicion,$condicion_oferta,$tipo_unidad);
				echo json_encode("OK");
			}
			
		}
		
		
		
	}

if($acc == "PUBLICAPRODUCTO")
{
	$productoid					= $_REQUEST["productoid_publicar"];
	$precio_internet	= $_REQUEST["precio_internet_publicar"];
	
	negProducto::publicaProducto($productoid,$precio_internet,$_SESSION["usuarioid"]);
	echo json_encode("OK");
}

if($acc == "STOCKADMIN")
{
	$stock_action	= $_REQUEST["stock_action"];
	$productoid		= $_REQUEST["productoid_stock"];
	if($stock_action == "ADDSTOCK")
	{
		$proveedor			= $_REQUEST["stock_proveedor"];
		$stock_add			= $_REQUEST["stock_add"];
		$valor_unitario		= $_REQUEST["stock_valor_unitario"];
		$valor_total		= $_REQUEST["stock_valor_total"];
		negProducto::addStockProducto($productoid,$proveedor,$stock_add,$valor_unitario,$valor_total,$_SESSION["usuarioid"]);
		
	}
	if( $stock_action == "DELETESTOCK")
	{
		$motivo			= $_REQUEST["motivo_delete"];
		$stock_delete	= $_REQUEST["stock_delete"];
		negProducto::deleteStockProducto($productoid,$motivo,$stock_delete,$_SESSION["usuarioid"]);
	}
	
	
	
	echo json_encode("OK");
}
if($acc == "GETMOVIMIENTOS")
{
	$productoid	= $_REQUEST["productoid"];
	echo json_encode(negProducto::getStockProducto($productoid));
}
if($acc == "ELIMINAPUBLICACIONPRODUCTO")
{
	$productoid	= $_REQUEST["productoid_nopbl"];
	negProducto::eliminaPublicacion($productoid);
	echo json_encode("OK");
}
if($acc == "GETPRODUCTODETAIL")
{
	$productoid	= $_REQUEST["productoid"];
	echo json_encode(negProducto::getProductoDetail($productoid));
}
if($acc == "ELIMINAPRODUCTO")
{
	$productoid	= $_REQUEST["productoid_elimina"];
	negProducto::eliminaProducto($productoid);
	echo json_encode("OK");
}
if($acc=="CREATIPOPROD")
{
    $tipo = $_REQUEST["tipo"];
    $descripcion	= $_REQUEST["descripcion"];
    negProducto::addTipoProducto($tipo,$descripcion);
    echo json_encode("OK");
}
if($acc == "GETTIPOPRODUCTODETAIL")
{
    $tipo	= $_REQUEST["tipo"];
    echo json_encode(negProducto::getTipoProductoDetail($tipo));
}
if($acc == "MODIFICATIPOPROD")
{
    $tipo				= $_REQUEST["tipo_edita"];
    $tipo_ant			= $_REQUEST["tipo_ant"]; 
    $descripcion		= $_REQUEST["descripcion_edita"];
    $estado		= $_REQUEST["estado"];
    negProducto::modifTipoProducto($tipo,$descripcion,$tipo_ant,$estado);
    echo json_encode("OK");
   
}

?>

