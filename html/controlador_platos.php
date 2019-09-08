<?php	
	session_start();
	
	if (isset($_REQUEST["IDPLATO"])){
		$plato["IDPLATO"] = $_REQUEST["IDPLATO"];
		$plato["NOMBRE"] = $_REQUEST["NOMBRE"];
		$plato["PRECIO"] = $_REQUEST["PRECIO"];
		
		
		$_SESSION["plato"] = $plato;
		Header("Location: menu.php");
		if (isset($_REQUEST["editar"])){
		  $_SESSION["opcion"]=1;
		  Header("Location: menu.php");
		}else if (isset($_REQUEST["editprecio"])){
			$_SESSION["opcion"]=2;
			Header("Location: menu.php");
		}
		else if (isset($_REQUEST["aliment"])) Header("Location: alimento.php");
		else if (isset($_REQUEST["delete"])) Header("Location: accion_borrar_plato.php");
		else if (isset($_REQUEST["grabar"])) Header("Location: accion_modificar_plato.php");
		else if (isset($_REQUEST["grabarprecio"])) Header("Location: accion_modificar_precio_plato.php");
		else if (isset($_REQUEST["delete"])){
			if(isset($_SESSION["opcion"])){
				unset($_SESSION["opcion"]);
				Header("Location: menu.php");
			}
			else{
				Header("Location: accion_borrar_plato.php");
			}
		} 
	}
	else 
		Header("Location: menu.php");

?>
