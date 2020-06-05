<?php 
class dtVenta
{	
	
	public static function getVentasPendientes($tipo_venta)
	{
		return DBFactory::ExecuteSQL("call getVentasPendientes('".$tipo_venta."');");
	}
	public static function getVentasProductos($ventaid)
	{
		return DBFactory::ExecuteSQL("call getVentasProductos('".$ventaid."');");
	}
	/**
	 * Configura los estados de las ventas
	 * @param unknown $ventaid
	 * @param unknown $estadoabre
	 * @param unknown $usuarioini
	 * @param unknown $usuariofin
	 * @param string $estadocierra
	 */
	public static function ventaSetEstado($ventaid,$estadoabre,$usuarioini,$usuariofin,$estadocierra='NA')
	{
		$SQLQuery = "call ventaSetEstado('".$ventaid."','".$estadoabre."',".$usuarioini.",".$usuariofin.",'".$estadocierra."')";
		DBFactory::ExecuteNonQuery($SQLQuery);
		
	}
	public static function ventaSetStock($ventaid)
	{
		$SQLQuery = "call ventaSetStock(".$ventaid.")";
		DBFactory::ExecuteNonQuery($SQLQuery);
		
	}
	/***
	 * Busca el o los productos ACTIVOS por nombre o por codigo
	 * @param unknown $str
	 * @return PDOStatement[]
	 */
	public static function buscaProducto($str)
	{
		return DBFactory::ExecuteSQL("call buscaProducto('".$str."');");
	}
	/***
	 * Crea la venta por caja y retorna la fecha de la venta como datetime para validar la venta en la Base de Datos
	 * @param unknown $cajaid
	 * @param unknown $accionid
	 * @param unknown $cantidad_prod
	 * @param unknown $total
	 * @param unknown $tipo_pago
	 * @param unknown $detalle_venta_producto
	 * @return PDOStatement[]
	 */
	public static function venta_caja($cajaid ,$accionid ,$cantidad_prod ,$total ,$tipo_pago ,$detalle_venta_producto,$voucher)
	{
		return DBFactory::ExecuteSQLFirst("call venta_caja(".$cajaid.",".$accionid.",".$cantidad_prod.",".$total.",'".$tipo_pago."','".$detalle_venta_producto."','".$voucher."');");
	}
	/***
	 * Retorna el id de la venta
	 * @param unknown $fechaVenta
	 * @return PDOStatement[]
	 */
	public static function venta_caja_valida($fechaVenta)
	{
		return DBFactory::ExecuteSQLFirst("call venta_caja_valida('".$fechaVenta."');");
	}
	/***
	 * Agrega el detalle de los productos a la Venta
	 * @param unknown $productoid
	 * @param unknown $nombre
	 * @param unknown $precio_venta
	 * @param unknown $precio_oferta
	 * @param unknown $cantidad
	 * @param unknown $total
	 * @param unknown $cajaventaid
	 * @param unknown $condicion_oferta
	 */
	public static function venta_caja_producto($productoid,$nombre,$precio_venta,$precio_oferta,$cantidad,$total,$cajaventaid,$condicion_oferta)
	{
		DBFactory::ExecuteNonQuery("call venta_caja_producto(".$productoid.",'".$nombre."',".$precio_venta.",".$precio_oferta.",".$cantidad.",".$total.",".$cajaventaid.",".$condicion_oferta."); ");
	}
	/***
	 * RETORNA TODOS LOS PRODUCTOS DE UNA VENTA
	 * @param Integer $cajaventaid
	 * @return PDOStatement[]
	 */
	public static function venta_caja_producto_get($cajaventaid)
	{
	
		return DBFactory::ExecuteSQL("call venta_caja_producto_get(".$cajaventaid.");");
	}
	/***
	 * Permite la eliminacion del detalle de los productos de una Venta
	 * @param unknown $cajaventaid
	 * @return PDOStatement[]
	 */
	public static function venta_caja_producto_elimina($cajaventaid)
	{
		
		return DBFactory::ExecuteSQL("call venta_caja_producto_elimina(".$cajaventaid.");");
	}
	public static function getVentasLocalByAccionid($accionid)
	{
		return DBFactory::ExecuteSQL("call getVentasLocalByAccionid('".$accionid."');");
	}
	public static function getCajaVentaAccionid($accionid)
	{
		return DBFactory::ExecuteSQL("call getCajaVentaAccionid('".$accionid."');");
	}
	public static function getcajaVentaProductoByCajaventaid($cajaventaid)
	{
		return DBFactory::ExecuteSQL("call getcajaVentaProductoByCajaventaid('".$cajaventaid."');");
	}
    public static function AnularVenta($ventaid)
    {
        return DBFactory::ExecuteSQL("call anularVenta('".$ventaid."');");
    }
	
}
?>
