<?php	
	session_start();
	
	if (isset($_REQUEST["IDALIMENTO"])){

		$alimento["IDALIMENTO"] = $_REQUEST["IDALIMENTO"];
		$alimento["NOMBREALIMENTO"] = $_REQUEST["NOMBREALIMENTO"];
		$alimento["PROCEDENCIA"] = $_REQUEST["PROCEDENCIA"];
		$alimento["ALERGENO"]=$_REQUEST;
		
        $_SESSION["alim"] = $alimento;
        
		Header("Location: alimento.php");
		if (isset($_REQUEST["deleteAlimento"])) Header("Location:accion_borrar_alimento.php");
		elseif (isset($_REQUEST["editAlimento"])) {
			# code...
			Header("Location: alimento.php")
		}
		
	}
	else 
		Header("Location: alimento.php");
?>