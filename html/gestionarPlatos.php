<?php
  
function consultarPlatos($conexion) {
	$consulta = "SELECT IDPLATO, NOMBRE, PRECIO FROM PLATOS"
		. " ORDER BY NOMBRE";
    return $conexion->query($consulta);
}

?>