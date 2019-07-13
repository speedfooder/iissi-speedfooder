<?php	
	session_start();	
	
	if (isset($_SESSION["plato"])) {
		$plato = $_SESSION["plato"];
				
		require_once("gestionBD.php");
		require_once("gestionarPlatos.php");
		
		$conexion = crearConexionBD();		
		$excepcion = actualiza_plato($conexion,$plato["IDPLATO"],$plato["NOMBRE"], $plato["PRECIO"]);
		cerrarConexionBD($conexion);
			
		if ($excepcion<>"") {
			$_SESSION["excepcion"] = $excepcion;
			$_SESSION["destino"] = "alimento.php";
			Header("Location: excepcion.php");
		}
		else
			Header("Location: alimento.php");
	} 
	else Header("Location: alimento.php"); // Se ha tratado de acceder directamente a este PHP
?>
