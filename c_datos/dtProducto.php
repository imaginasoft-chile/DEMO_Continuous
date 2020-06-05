<?php 
class dtProducto{

	public static function getTiposProducto()
	{
		return DBFactory::ExecuteSQL("call getTiposProducto();");
	}
	public static function getProductoDetail($productoid)
	{
		return DBFactory::ExecuteSQLFirst("call getProductoDetail(".$productoid.");");
	}
	public static function getProductos()
	{
		return DBFactory::ExecuteSQL("call getProductos();");
	}
	public static function validaNombreProducto($nombre)
	{
		return DBFactory::ExecuteSQLFirst("call validaNombreProducto('".$nombre."');");
	}
	public static function validaCodigoProducto($codigo)
	{
		return DBFactory::ExecuteSQLFirst("call validaCodigoProducto('".$codigo."');");
	}
	public static function addProducto($tipo,$nombre,$codigo,$descripcion,$precio_venta,$precio_oferta,$precio_internet,$finalPath,$usuarioid,$condicion_oferta,$tipo_unidad)
	{
		$sql = "call addProducto('".$tipo."','".$nombre."','".$codigo."','".$descripcion."',".$precio_venta.",".$precio_oferta.",".$precio_internet.",'".$finalPath."',".$usuarioid.",".$condicion_oferta.",'".$tipo_unidad."');";
		DBFactory::ExecuteNonQuery($sql);
	}
	
	public static function modifProducto($tipo,$nombre,$codigo,$descripcion,$precio_venta,$precio_oferta,$precio_internet,$finalPath,$usuarioid,$productoid,$posicion,$condicion_oferta,$tipo_unidad)
	{
		$sql = "call modifProducto('".$tipo."','".$nombre."','".$codigo."','".$descripcion."',".$precio_venta.",".$precio_oferta.",".$precio_internet.",'".$finalPath."',".$usuarioid.",".$productoid.",".$posicion.",".$condicion_oferta.",'".$tipo_unidad."');";
		DBFactory::ExecuteNonQuery($sql);
	}
	public static function publicaProducto($productoid,$precio_internet,$usuarioid)
	{
		$sql = "call publicaProducto(".$productoid.",".$precio_internet.",".$usuarioid.");";
		return DBFactory::ExecuteNonQuery($sql);
		
	}
	public static function addStockProducto($productoid,$proveedor,$stock_add,$valor_unitario,$valor_total,$usuarioid)
	{
		$sql = "call addStockProducto(".$productoid.",'".$proveedor."',".$stock_add.",".$valor_unitario.",".$valor_total.",".$usuarioid.");";
		return DBFactory::ExecuteNonQuery($sql);
		
	}
	public static function deleteStockProducto($productoid,$motivo,$stock_delete,$usuarioid)
	{
		$sql = "call deleteStockProducto(".$productoid.",'".$motivo."',".$stock_delete.",".$usuarioid.");";
		return DBFactory::ExecuteNonQuery($sql);
	}
	public static function getStockProducto($productoid)
	{
		return DBFactory::ExecuteSQL("call getStockProducto(".$productoid.");");
	}
	public static function eliminaPublicacion($productoid)
	{
		$sql = "call eliminaPublicacion(".$productoid.");";
		return DBFactory::ExecuteNonQuery($sql);
	}
	public static function eliminaProducto($productoid)
	{
		$sql = "call eliminaProducto(".$productoid.");";
		return DBFactory::ExecuteNonQuery($sql);
	}
	public static function addTipoProducto($tipo,$descripcion)
	{
	    $sql = "call addTipoProducto('".$tipo."','".$descripcion."');";
	    DBFactory::ExecuteNonQuery($sql);
	}
	public static function getTipoProductoDetail($tipo)
	{
	    return DBFactory::ExecuteSQLFirst("call getTipoProductoDetail('".$tipo."');");
	}
	public static function modifTipoProducto($tipo,$descripcion,$tipo_ant,$estado)
	{
	    $sql = "call modifTipoProducto('".$tipo."','".$descripcion."','".$tipo_ant."','".$estado."');";
	    DBFactory::ExecuteNonQuery($sql);
	}
}


?>