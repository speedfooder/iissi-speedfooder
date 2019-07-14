<?php	
	session_start();	
	
	if (isset($_SESSION["alergeno"])) {
		$alergeno = $_SESSION["alergeno"];
		unset($_SESSION["alergeno"]);
		
		require_once("gestionBD.php");
		require_once("gestionarPlatos.php");
		
		$conexion = crearConexionBD();		
		$excepcion = elimina_alergeno($conexion,$alergeno["IDALERGENO"]);
		
		cerrarConexionBD($conexion);
			
		if ($excepcion<>"") {
			$_SESSION["excepcion"] = $excepcion;
			$_SESSION["destino"] = "alergeno.php";
			Header("Location: excepcion.php");
		}
		else Header("Location: alergeno.php");
	}
	else Header("Location: alergeno.php"); // Se ha tratado de acceder directamente a este PHP
?>