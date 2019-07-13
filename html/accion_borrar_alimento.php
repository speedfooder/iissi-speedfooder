<?php	
	session_start();	
	
	if (isset($_SESSION["alimento"])) {
		$alimento = $_SESSION["alimento"];
		unset($_SESSION["alimento"]);
		
		require_once("gestionBD.php");
		require_once("gestionarPlatos.php");
		
		$conexion = crearConexionBD();		
		$excepcion = elimina_alimento($conexion,$alimento["IDALIMENTO"]);
		
		cerrarConexionBD($conexion);
			
		if ($excepcion<>"") {
			$_SESSION["excepcion"] = $excepcion;
			$_SESSION["destino"] = "alimento.php";
			Header("Location: excepcion.php");
		}
		else Header("Location: alimento.php");
	}
	else Header("Location: alimento.php"); // Se ha tratado de acceder directamente a este PHP
?>