<?php	
	session_start();
	
	if (isset($_REQUEST["IDALIMENTO"])){

		$alimento["IDALIMENTO"] = $_REQUEST["IDALIMENTO"];
		$alimento["NOMBREALIMENTO"] = $_REQUEST["NOMBREALIMENTO"];
		$alimento["PROCEDENCIA"] = $_REQUEST["PROCEDENCIA"];
		$alimento["marker"]="marcador";
		
        $_SESSION["alim"] = $alimento;
        
		Header("Location: alimento.php");
		if (isset($_REQUEST["deleteAlimento"])) Header("Location:debug.php");
		
	}
	else 
		Header("Location: alimento.php");
?>