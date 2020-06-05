<?php 
class dtCaja
{	
	public static function getCajas()
	{
		$SQLQuery= "call getCajas(); ";
		return DBFactory::ExecuteSQL($SQLQuery);		
		
	}
	public static function getCajaVentaAcumulado($accionid)
	{
		$SQLQuery=" call getCajaVentaAcumulado(".$accionid."); ";
		return DBFactory::ExecuteSQLFirst($SQLQuery);
	}
	public static function getCajaDetail($cajaid)
	{
		$SQLQuery=" call getCajaDetail(".$cajaid."); ";
		return DBFactory::ExecuteSQLFirst($SQLQuery);
	}
	public static function getCajasUsuarioAll()
	{
		$SQLQuery= "call getCajasUsuarioAll(); ";
		return DBFactory::ExecuteSQL($SQLQuery);
	}
	public static function getCajasUsuario($usuarioid)
	{
		$SQLQuery= "call getCajasUsuario(".$usuarioid."); ";
		return DBFactory::ExecuteSQL($SQLQuery);
	}
	public static function getUsuariosByCajaid($cajaid)
	{
		$SQLQuery= "call getUsuariosByCajaid(".$cajaid."); ";
		return DBFactory::ExecuteSQL($SQLQuery);
	}
	public static function cajaAbre($cajaid, $usuarioidAbre, $monto_inicio, $usuarioid_vendedor)
	{
		$SQLQuery=" call cajaAbre(".$cajaid.",".$usuarioidAbre.",".$monto_inicio.",".$usuarioid_vendedor."); ";
		return DBFactory::ExecuteSQLFirst($SQLQuery);
	}
	public static function cajaCierra($cajaid, $usuarioid, $monto_fin)
	{
		$SQLQuery=" call cajaCierra(".$cajaid.",".$usuarioid.",".$monto_fin."); ";
		return DBFactory::ExecuteNonQuery($SQLQuery);
	}
}
?>
