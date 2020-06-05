<?php
class negInforme{
	
	public static function ventasPorProductoProCaja($cajaid, $fini, $ffin)
	{
		$fini = $fini." 00:00:00";
		$ffin = $ffin."  23:59:59";
		return  dtInforme::ventasPorProductoProCaja($cajaid, $fini, $ffin);
		
	}
	public static function informe_ventasPorDiaPorCaja($cajaid, $fini, $ffin)
	{
		$fini = $fini." 00:00:00";
		$ffin = $ffin."  23:59:59";
		return  dtInforme::informe_ventasPorDiaPorCaja($cajaid, $fini, $ffin);
		
	}
	public static function informe_ventasPorAperturaPorCaja($cajaid, $fini, $ffin)
	{
		$fini = $fini." 00:00:00";
		$ffin = $ffin."  23:59:59";
		return  dtInforme::informe_ventasPorAperturaPorCaja($cajaid, $fini, $ffin);
		
	}
	public static function informe_compraVenta($fini, $ffin)
	{
		$fini = $fini." 00:00:00";
		$ffin = $ffin."  23:59:59";
		return  dtInforme::informe_compraVenta($fini, $ffin);
		
	}
	public static function informe_gastos($fini,$ffin)
	{
		$fini = $fini." 00:00:00";
		$ffin = $ffin."  23:59:59";
		return dtInforme::informe_gastos($fini,$ffin);
	}  
	public static function informe_CajaVentaXDia($cajaid, $fecha)
	{
		return dtInforme::informe_CajaVentaXDia($cajaid, $fecha);
	}
	public static function informe_ventasPorProductoTop10()
	{
		return dtInforme::informe_ventasPorProductoTop10();
	}
	public static function informe_ventasPorProductoHoy()
	{
		return dtInforme::informe_ventasPorProductoHoy();
	}
	public static function informe_prodPocoStock($valida)
	{
		return dtInforme::informe_prodPocoStock($valida);
	}
	public static function ventasPorFamilia($fini, $ffin)
	{
	    $fini = $fini." 00:00:00";
	    $ffin = $ffin."  23:59:59";
	    return  dtInforme::ventasPorFamilia($fini, $ffin);
	}	
}
?>