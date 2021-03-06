<?php	
	session_start();	
	
	if (isset($_SESSION["plato"])) {
		$plato = $_SESSION["plato"];
		unset($_SESSION["plato"]);
		
		require_once("gestionBD.php");
		require_once("gestionarPlatos.php");
		
		$conexion = crearConexionBD();		
		$excepcion = elimina_plato($conexion,$plato["IDPLATO"]);
		
		cerrarConexionBD($conexion);
			
		if ($excepcion<>"") {
			$_SESSION["excepcion"] = $excepcion;
			$_SESSION["destino"] = "menu.php";
			Header("Location: excepcion.php");
		}
		else Header("Location: menu.php");
	}
	else Header("Location: menu.php"); // Se ha tratado de acceder directamente a este PHP
?>

