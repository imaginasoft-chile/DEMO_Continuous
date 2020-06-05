<?php
class negProducto{
	
	public static function getTiposProducto()
	{
		return dtProducto::getTiposProducto();
	}
	public static function getProductoDetail($productoid)
	{
		return dtProducto::getProductoDetail($productoid);
	}
	public static function validaNombreProducto($nombre)
	{
		$vn = dtProducto::validaNombreProducto($nombre);
		return $vn[0]["val"];
	}
	public static function getProductos()
	{
		return dtProducto::getProductos();
	}
	public static function validaCodigoProducto($codigo)
	{
		$vn = dtProducto::validaCodigoProducto($codigo);
		return $vn[0]["val"];
	}
	public static function addProducto($tipo,$nombre,$codigo,$descripcion,$precio_venta,$precio_oferta,$precio_internet,$finalPath,$usuarioid,$condicion_oferta,$tipo_unidad)
	{
		if($precio_venta    == ''){$precio_venta='0';}
		if($precio_oferta   == ''){$precio_oferta='0';}
		if($precio_internet == ''){$precio_internet='0';}
		if($condicion_oferta== ''){$condicion_oferta='0';}
		
		dtProducto::addProducto($tipo,$nombre,$codigo,$descripcion,$precio_venta,$precio_oferta,$precio_internet,$finalPath,$usuarioid,$condicion_oferta,$tipo_unidad);
	}
	
	public static function modifProducto($tipo,$nombre,$codigo,$descripcion,$precio_venta,$precio_oferta,$precio_internet,$finalPath,$usuarioid,$productoid,$posicion,$condicion_oferta,$tipo_unidad)
	{
		if($precio_venta    == ''){$precio_venta='0';}
		if($precio_oferta   == ''){$precio_oferta='0';}
		if($precio_internet == ''){$precio_internet='0';}
		if($condicion_oferta== ''){$condicion_oferta='0';}
		
		
		dtProducto::modifProducto($tipo,$nombre,$codigo,$descripcion,$precio_venta,$precio_oferta,$precio_internet,$finalPath,$usuarioid,$productoid,$posicion,$condicion_oferta,$tipo_unidad);
	}
	public static function publicaProducto($productoid,$precio_internet,$usuarioid)
	{
		dtProducto::publicaProducto($productoid,str_replace(".", "", $precio_internet),$usuarioid);
		
	}
	public static function addStockProducto($productoid,$proveedor,$stock_add,$valor_unitario,$valor_total,$usuarioid)
	{
		if($valor_unitario== ''){$valor_unitario='0';}
		if($valor_total   == ''){$valor_total='0';}
		
		dtProducto::addStockProducto($productoid,$proveedor,str_replace(".", "", $stock_add),str_replace(".", "", $valor_unitario),str_replace(".", "", $valor_total),$usuarioid);
	}
	public static function deleteStockProducto($productoid,$motivo,$stock_delete,$usuarioid)
	{
		if($stock_delete== ''){$stock_delete='0';}
		
		dtProducto::deleteStockProducto($productoid,$motivo,str_replace(".", "", $stock_delete),$usuarioid);
	}
	public static function getStockProducto($productoid)
	{
		
		$obj = dtProducto::getStockProducto($productoid);
		return $obj;
	}
	public static function eliminaPublicacion($productoid)
	{
		dtProducto::eliminaPublicacion($productoid);
	}
	public static function eliminaProducto($productoid)
	{
		dtProducto::eliminaProducto($productoid);
	}
	public static function addTipoProducto($tipo,$descripcion)
	{
	    dtProducto::addTipoProducto($tipo,$descripcion);
	}
	public static function getTipoProductoDetail($tipo)
	{
	    return dtProducto::getTipoProductoDetail($tipo);
	}
	public static function modifTipoProducto($tipo,$descripcion,$tipo_ant,$estado)
	{
	    dtProducto::modifTipoProducto($tipo,$descripcion,$tipo_ant,$estado);	    
	}
	
}
?>