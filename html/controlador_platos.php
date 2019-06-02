<?php	
	session_start();
	
	if (isset($_REQUEST["IDPLATO"])){
		$plato["IDPLATO"] = $_REQUEST["IDPLATO"];
		$plato["NOMBRE"] = $_REQUEST["NOMBRE"];
		$plato["PRECIO"] = $_REQUEST["PRECIO"];
		
		$_SESSION["plato"] = $plato;
		Header("Location: menu.php");
		if (isset($_REQUEST["editar"])) Header("Location: menu.php"); 
		else if (isset($_REQUEST["grabar"])) Header("Location: accion_modificar_plato.php");
		else /*if (isset($_REQUEST["borrar"])) */ Header("Location: accion_borrar_plato.php"); 
	}
	else 
		Header("Location: menu.php");

?>
