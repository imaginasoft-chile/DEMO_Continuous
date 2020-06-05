<?php 
class negCaja
{	
	public static function getCajas()
	{
		return dtCaja::getCajas();
	}
	public static function getCajaVentaAcumulado($accionid)
	{
		return dtCaja::getCajaVentaAcumulado($accionid);
	}
	public static function getCajaDetail($cajaid)
	{
		return dtCaja::getCajaDetail($cajaid);
	}
	public static function getCajasUsuarioAll()
	{
		return dtCaja::getCajasUsuarioAll();
	}
	public static function getCajasUsuario($usuarioid)
	{
		return dtCaja::getCajasUsuario($usuarioid);
	}
	public static function getUsuariosByCajaid($cajaid)
	{
		return dtCaja::getUsuariosByCajaid($cajaid);
	}
	public static function cajaAbre($cajaid, $usuarioidAbre, $monto_inicio,$usuarioid_vendedor)
	{
		$val =  dtCaja::cajaAbre($cajaid, $usuarioidAbre, $monto_inicio,$usuarioid_vendedor);
		$salida =  "ERROR";
		if((float)$val[0]["valida"] > 0)
		{
			$salida =  "OK";
		}
		
		return $salida;
	}
	public static function cajaCierra($cajaid, $usuarioid, $monto_fin)
	{
		dtCaja::cajaCierra($cajaid, $usuarioid, $monto_fin);
	}
	
	
}

?>