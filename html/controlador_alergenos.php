<?php	
	session_start();
	
	if (isset($_REQUEST["IDALERGENO"])){

		$alergeno["IDALERGENO"] = $_REQUEST["IDALERGENO"];
		$alergeno["NOMBREALIMENTO"] = $_REQUEST["NOMBREALIMENTO"];
		$alergeno["PROCEDENCIA"] = $_REQUEST["PROCEDENCIA"];
		
        $_SESSION["alergeno"] = $alergeno;
        
		Header("Location: alergeno.php");
		if (isset($_REQUEST["deleteAlergeno"])) Header("Location:accion_borrar_alergeno.php");
		
	}
	else 
		Header("Location: alergeno.php");
?>