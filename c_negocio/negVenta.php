<?php 
class negVenta
{
	public static function getVentasPendientes($tipo_venta)
	{
		return dtVenta::getVentasPendientes($tipo_venta);
	}
	public static function getVentasPendientesInternet()
	{
		return self::getVentasPendientes('INTERNET');
	}
	public static function getVentasProductos($ventaid)
	{
		return dtVenta::getVentasProductos($ventaid);
	}
	public static function ventaSetEstado($ventaid,$estadoabre,$usuarioini,$usuariofin,$estadocierra)
	{	
		if($estadoabre == "ENTREGADA")
		{	
			dtVenta::ventaSetStock($ventaid);			
		}
	
		return dtVenta::ventaSetEstado($ventaid,$estadoabre,$usuarioini,$usuariofin,$estadocierra);		
	}
	public static function buscaProducto($str)
	{
		return dtVenta::buscaProducto($str);
	}
	public static function ventaLocalCaja($dv,$cajaid,$total,$cantidad,$tipopago,$voucher)
	{
		//ESTRUCTURA ->  = 0:productoid"|-|"1:precio_venta"|-|"2:cantidad"|-|"3:precio_oferta"|-|"4:total|-|"5:condicion_oferta"{}";
		$dvArr = explode("{}", $dv);
		$cont = 0;
		$resultado = "ERROR";
		
		$cj = negCaja::getCajaDetail($cajaid); 
		$accionid 		= $cj[0]["accionid"];
		$cantidad_prod = $cantidad;

		/***
		 * 1- Agrega la venta a la Base de Datos
		 */
		$fc = dtVenta::venta_caja($cajaid, $accionid, $cantidad_prod, $total, $tipopago, json_encode($dvArr),$voucher);
		$cajaventaid = dtVenta::venta_caja_valida($fc[0]["fechaventaI"]);
		if(count($cajaventaid)==0)
		{
			$resultado .=" - 001: No hemos podido agregar la venta por favor comuniquese con el administrador del sistema Urgentemente.";
			
		}else
		{
			/***
			 * 2- La venta fue agregada correctamente, por lo que se debe intentar agregar los prodcutos de la venta
			 */
			$cajaventaid = $cajaventaid[0]["cajaventaid"];
			foreach ($dvArr as $dd)
			{
				
				if($dd != "")
				{
					$cont++;
					$ddArr 				= explode("|-|", $dd);
					$productoid 		= $ddArr[0];
					$precio_venta 		= $ddArr[1];
					$cantidad 			= $ddArr[2];
					$precio_oferta		= $ddArr[3];
					$total				= $ddArr[4];
					$condicion_oferta	= $ddArr[5];
					$nombre			= "";
					//echo "FLAG [".$cont."]:".$productoid."|".$precio_venta."|".$cantidad."|".$precio_oferta."|".$total."|";
					/***
					 * 3- Se agregan los productos a la Venta
					 */
					dtVenta::venta_caja_producto($productoid, $nombre, $precio_venta, $precio_oferta, $cantidad, $total, $cajaventaid,$condicion_oferta);
				}
			}
			
			/***
			 * 4- Se valida el ingreso de los productos a la Venta
			 */
			$val = dtVenta::venta_caja_producto_get($cajaventaid);
			
			if(count($val) == $cont)
			{
				$resultado = "OK";
				
			}else
			{
				foreach ($dvArr as $dd)
				{
					if($dd != "")
					{
						$ddArr 			= explode("|-|", $dd);
						$productoid 	= $ddArr[0];
						$precio_venta 	= $ddArr[1];
						$cantidad 		= $ddArr[2];
						$precio_oferta	= $ddArr[3];
						$total			= $ddArr[4];
						$nombre			= "";
						$vv = 0;
						
						foreach ($val as $v)
						{
							
							if($v["productoid"] == $productoid)
							{
								$vv = 1;
							}
						}
						
						echo "vv:".$vv;
						
						if($vv == 0)
						{
							/***
							 * 3- Se agregan los productos a la Venta que no se ingresaron
							 */
							dtVenta::venta_caja_producto($productoid, $nombre, $precio_venta, $precio_oferta, $cantidad, $total, $cajaventaid);
						}
					}
				}
				
				
				/***
				 * 4- Se valida el ingreso de los productos a la Venta
				 */
				$val = dtVenta::venta_caja_producto_get($cajaventaid);
				if(count($val) == $cont)
				{
					$resultado = "OK";
					
				}else
				{
					$resultado .=" - 002: No hemos podido agregar todos los productos a la venta por favor comuniquese con el administrador del sistema Urgentemente.";
				}
			}
			
			
			
		}
		return $resultado;
	}
	
	public static function getVentasLocalByAccionid($accionid)
	{
		return dtVenta::getVentasLocalByAccionid($accionid);
	}
	public static function getCajaVentaAccionid($accionid)
	{
		return dtVenta::getCajaVentaAccionid($accionid);
	}
	public static function getcajaVentaProductoByCajaventaid($cajaventaid)
	{
		return dtVenta::getcajaVentaProductoByCajaventaid($cajaventaid);
	}
    public static function AnularVenta($ventaid)
    {
	    $prodVenta = negVenta::getcajaVentaProductoByCajaventaid($ventaid); 
        dtVenta::AnularVenta($ventaid);
        //$fc = dtVenta::venta_caja($cajaid, $accionid, $cantidad_prod, $total, $tipopago, json_encode($dvArr),$voucher);	
    } 
	
}

?>