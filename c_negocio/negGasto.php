<?php

class negGasto{
	
	public static function getGastoTipo()
	{
		return dtGasto::getGastoTipo();
	}
	public static function addGasto($tipo,$beneficiario,$nota,$monto_gasto,$usuarioid)
	{
		return dtGasto::addGasto($tipo,$beneficiario,$nota,$monto_gasto,$usuarioid);
	}  
	
}
?>