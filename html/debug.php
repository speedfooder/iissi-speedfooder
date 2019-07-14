<?php
session_start();
	
if (isset($_REQUEST["IDALIMENTO"])){

    $alimento["IDALIMENTO"] = $_REQUEST["IDALIMENTO"];
    $alimento["NOMBREALIMENTO"] = $_REQUEST["NOMBREALIMENTO"];
    $alimento["PROCEDENCIA"] = $_REQUEST["PROCEDENCIA"];
    $alimento["ALERGENO"]=$_REQUEST;
    
    $_SESSION["alim"] = $alimento;
    
    print_r($alimento);
    echo("===========================================================");
    

echo '<pre>';
var_dump($_SESSION);
echo '</pre>';
    
}
else 
    echo("you got yeeted by the request");
?>