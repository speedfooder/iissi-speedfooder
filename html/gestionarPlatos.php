<?php
  
function consultarPlatos($conexion) {
	$consulta = "SELECT IDPLATO, NOMBRE, PRECIO FROM PLATOS"
		. " ORDER BY NOMBRE";
    return $conexion->query($consulta);
}

function consulta_alimentos( $conn, $query)
{
	try {

		$stmt = $conn->prepare( $query );
		
		$stmt->execute();
		return $stmt;
	}	
	catch ( PDOException $e ) {
		$_SESSION['excepcion'] = $e->GetMessage();
		header("Location: excepcion.php");
	}
} 
?>