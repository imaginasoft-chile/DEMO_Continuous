<?php 
class dtGasto{
	public static function getGastoTipo()
	{
		$SQLQuery= "call getGastoTipo(); ";
		return DBFactory::ExecuteSQL($SQLQuery);
	}
	public static function addGasto($tipo,$beneficiario,$nota,$monto_gasto,$usuarioid)
	{
		$SQLQuery= "call addGasto('".$tipo."','".$beneficiario."','".$nota."',".$monto_gasto.",".$usuarioid.");";
		return DBFactory::ExecuteNonQuery($SQLQuery);
	}
	
}

?>