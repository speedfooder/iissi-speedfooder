<?php
 if (isset($_SESSION["alim"])){
    $alimento = $_SESSION["alim"];
    print_r($alimento);
    echo("howdy estoy en el if");

} 
else{
    echo ("no estas en el if");
}
?>