<?php	
	session_start();
	
	if (isset($_REQUEST["IDALIMENTO"])){
		$alimento["IDALIMENTO"] = $_REQUEST["IDALIMENTO"];
		$alimento["NOMBREALIMENTO"] = $_REQUEST["NOMBREALIMENTO"];
		$alimento["PROCEDENCIA"] = $_REQUEST["PROCEDENCIA"];
		
		
		$_SESSION["alimento"] = $alimento;
		Header("Location: alimento.php");
		if (isset($_REQUEST["editarAlimento"])){
		  $_SESSION["opcion"]=1;
		  Header("Location: alimento.php");
		}else if (isset($_REQUEST["editarProcAlimento"])){
			$_SESSION["opcion"]=2;
			Header("Location: alimento.php");
		}
		else if (isset($_REQUEST["deleteAlimento"])) Header("Location: accion_borrar_alimento.php");
		else if (isset($_REQUEST["grabarAlimento"])) Header("Location: accion_modificar_alimento.php");
		else if (isset($_REQUEST["grabarProcAlimento"])) Header("Location: accion_modificar_procedencia.php");
	}
	else 
		Header("Location: alimento.php");

?>
