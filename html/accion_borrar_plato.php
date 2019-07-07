<?php	
	session_start();	
	
	if (isset($_SESSION["plato"])) {
		$plato = $_SESSION["plato"];
		unset($_SESSION["plato"]);
		
		require_once("gestionBD.php");
		require_once("gestionarPlatos.php");
		
		$conexion = crearConexionBD();		
		$excepcion = elimina_plato($conexion,$plato["NOMBRE"]);
		$query = "SELECT IDPLATO FROM PLATOS WHERE NOMBRE=:nombre";
		$stmt = $conexion->prepare($query);
		$stmt->bindParam(':nombre',$plato['NOMBRE']);
		$stmt->execute();
		$id=$stmt->fetchColumn();
		$excepcion2= eliminaDepPlato($conexion,$id);
		cerrarConexionBD($conexion);
			
		if ($excepcion<>"") {
			$_SESSION["excepcion"] = $excepcion;
			$_SESSION["destino"] = "menu.php";
			Header("Location: excepcion.php");
		}
		else if ($excepcion2<>"") {
			$_SESSION["excepcion"] = $excepcion2;
			$_SESSION["destino"] = "menu.php";
			Header("Location: excepcion.php");
		}
		else Header("Location: menu.php");
	}
	else Header("Location: menu.php"); // Se ha tratado de acceder directamente a este PHP
?>

<?
/* EXISTENCIA DE ESTE FICHERO

	Este fichero existe por motivos de futuras actualizaciones para otro equipo del proyecto. durante el desarrollo de la primera
	versión estable de este proyecto, se abandonó la idea de eliminar platos desde la interfaz de admin. Por tanto este fichero ha perdido toda utilidad.
*/
?>