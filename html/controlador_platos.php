<?php	
	session_start();
	
	if (isset($_REQUEST["OID_LIBRO"])){
		$libro["IDPLATO"] = $_REQUEST["IDPLATO"];
		$libro["NOMBRE"] = $_REQUEST["NOMBRE"];
		$libro["PRECIO"] = $_REQUEST["PRECIO"];
		
		$_SESSION["plato"] = $plato;
		Header("Location: menu.php");
		// if (isset($_REQUEST["editar"])) Header("Location: menu.php"); 
		// else if (isset($_REQUEST["grabar"])) Header("Location: accion_modificar_libro.php");
		// else /* if (isset($_REQUEST["borrar"])) */ Header("Location: accion_borrar_libro.php"); 
	}
	else 
		Header("Location: menu.php");

?>
