<?php 
class dtInforme
{	
	public static function ventasPorProductoProCaja($cajaid, $fini, $ffin)
	{
		$SQLQuery= "call informe_ventasPorProductoProCaja(".$cajaid.",'".$fini."','".$ffin."'); ";
		return DBFactory::ExecuteSQL($SQLQuery);		
		
	}
	public static function informe_ventasPorDiaPorCaja($cajaid, $fini, $ffin)
	{
		$SQLQuery= "call informe_ventasPorDiaPorCaja(".$cajaid.",'".$fini."','".$ffin."'); ";
		return DBFactory::ExecuteSQL($SQLQuery);
		
	}
	public static function informe_ventasPorAperturaPorCaja($cajaid, $fini, $ffin)
	{
		$SQLQuery= "call informe_ventasPorAperturaPorCaja(".$cajaid.",'".$fini."','".$ffin."'); ";
		return DBFactory::ExecuteSQL($SQLQuery);
		
	}
	public static function informe_compraVenta($fini, $ffin)
	{
		$SQLQuery= "call informe_compraVenta('".$fini."','".$ffin."'); ";
		return DBFactory::ExecuteSQL($SQLQuery);
		
	}
	public static function informe_gastos($fini,$ffin)
	{
		$SQLQuery= "call informe_gastos('".$fini."','".$ffin."');";
		
		return DBFactory::ExecuteSQL($SQLQuery);
	}
	public static function informe_CajaVentaXDia($cajaid, $fecha)
	{
		$SQLQuery= "call informe_CajaVentaXDia('".$fecha."',".$cajaid."); ";		
		return DBFactory::ExecuteSQL($SQLQuery);		
	}
	public static function informe_ventasPorProductoTop10()
	{
		$SQLQuery= "call informe_ventasPorProductoTop10(); ";		
		return DBFactory::ExecuteSQL($SQLQuery);		
	}
	public static function informe_ventasPorProductoHoy()
	{
		$SQLQuery= "call informe_ventasPorProductoHoy(); ";
		return DBFactory::ExecuteSQL($SQLQuery);
	}
	public static function informe_prodPocoStock($valida)
	{
		$SQLQuery= "call informe_prodPocoStock(".$valida."); ";
		return DBFactory::ExecuteSQL($SQLQuery);
	}
	public static function ventasPorFamilia($fini, $ffin)
	{
	    $SQLQuery= "call informe_ventasPorFamilia('".$fini."','".$ffin."'); ";
	    return DBFactory::ExecuteSQL($SQLQuery);
	    
	}
	
	
}
?>
