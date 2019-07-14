<?php	
	session_start();
	
	if (isset($_REQUEST["IDALIMENTO"])){

		$alimento["IDALIMENTO"] = $_REQUEST["IDALIMENTO"];
		$alimento["NOMBREALIMENTO"] = $_REQUEST["NOMBREALIMENTO"];
		$alimento["PROCEDENCIA"] = $_REQUEST["PROCEDENCIA"];
		$alimento["ALERGENO"]=$_REQUEST["ALERGENO"];
		
        $_SESSION["alimento"] = $alimento;
        
		Header("Location: alimento.php");
		if (isset($_REQUEST["deleteAlimento"])){
			Header("Location:accion_borrar_alimento.php");
		} 
		elseif (isset($_REQUEST["editAlimento"])) {
			Header("Location: alimento.php");
		}elseif (isset($_REQUEST["grabarAlimento"])) {
			Header("Location: accion_modifica_alimento.php");
		}
		elseif (isset($_REQUEST["alerg"])) {
			Header("Location: alergeno.php");
		}
		
	}
	else 
		Header("Location: alimento.php");
?>