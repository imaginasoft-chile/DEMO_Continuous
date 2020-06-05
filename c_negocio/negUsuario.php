<?php

class negUsuario{
	
	public static function getUsuario($usuarioid)
	{
		return dtUsuario::getUsuario($usuarioid);
	}
	public static function getUsuariosSistema()
	{
		return dtUsuario::getUsuariosSistema();
	}
	
	
	//DE AQUI PARA ABAJO PENDIENTE
	public static function creaUsuario($nombre,$apellidos,$mail,$telefono,$ususario_mae,$clave,$perfil,$avataridPath)
	{
		
		$usuarioidADM = "1";
		if(isset($_SESSION["IGT-usuarioid"]))
		{
			$usuarioidADM = $_SESSION["IGT-usuarioid"];
		}
		
		$usuario = dtUsuario::creaUsuario($nombre,$apellidos,$mail,$telefono,$ususario_mae,$clave,$usuarioidADM,$perfil,$avataridPath);
		negSistema::creaSistemaRegistro($usuario[0]["usuarioid"], "sistema_usuario", "usuarios", "CREA USUARIO");
		
	}
	public static function modificaaUsuario($nombre,$apellidos,$mail,$telefono,$ususario_mae,$clave,$perfil,$usuarioid,$estado)
	{
		$usuario = dtUsuario::modificaaUsuario($nombre,$apellidos,$mail,$telefono,$ususario_mae,$clave,$perfil,$usuarioid,$estado);
		negSistema::creaSistemaRegistro($usuarioid, "sistema_usuario", "usuarios", "MODIFICA USUARIO");
		
	}
	public static function validaDisponibilidadUsarioMae($ususario_mae)
	{
		
		$salida = "";
		$usuario = dtUsuario::validaDisponibilidadUsarioMae($ususario_mae);
		if(count($usuario)>0)
		{
			$salida = "NO DISPONIBLE";
			
		}else
		{
			$salida = "DISPONIBLE";
		}
		
		return $salida;
	}
	public static function modificaImagen($usuarioid,$avataridPath)
	{
		dtUsuario::modificaImagen($usuarioid,$avataridPath);
		negSistema::creaSistemaRegistro($usuarioid, "sistema_usuario", "usuarios", "MODIFICA IMAGEN USUARIO");
	}
	public static function desHabilitaUsuario($usuarioid)
	{
		dtUsuario::desHabilitaUsuario($usuarioid);
		negSistema::creaSistemaRegistro($usuarioid, "sistema_usuario", "usuarios", "DESHABILITA USUARIO");
	}
	public static function eliminarUsuario($usuarioid)
	{
		dtUsuario::eliminarUsuario($usuarioid);
		negSistema::creaSistemaRegistro($usuarioid, "sistema_usuario", "usuarios", "ELIMINA USUARIO Y ELIMINA REISTROS ASOCIADOS");
	}
	
    
}
?>