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

function elimina_plato($conexion,$idplato) {
	try {
		$stmt=$conexion->prepare('CALL BORRADOPLATO(:idplato)');
		$stmt->bindParam(':idplato',$idplato);
		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
}

function actualiza_plato($conexion,$idplato,$nombrePlato, $precioPlato) {
	try {
		$stmt=$conexion->prepare('CALL ACTUALIZA_NOMBRE_PLATO(:idplato,:nombrePlato)');
		$stmt->bindParam(':idplato',$idplato);
		$stmt->bindParam(':nombrePlato',$nombrePlato);
		//$stmt->bindParam(':precioPlato',$precioPlato);
		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
}

function actualiza_precio_plato($conexion,$idplato,$nombrePlato, $precioPlato) {
	try {
		$stmt=$conexion->prepare('CALL ACTUALIZA_PRECIO_PLATO(:idplato,:precioPlato)');
		$stmt->bindParam(':idplato',$idplato);
		$k=(string)$precioPlato;
		$stmt->bindParam(':precioPlato',$k);
		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
}

function elimina_alimento($conexion,$idalimento) {
	try {
		$stmt=$conexion->prepare('CALL deleteAlimento(:idalimento)');
		$stmt->bindParam(':idalimento',$idalimento);
		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
}

function elimina_alergeno($conexion,$idalergeno) {
	try {
		$stmt=$conexion->prepare('CALL eliminaalergenos(:idalergeno)');
		$stmt->bindParam(':idalergeno',$idalergeno);
		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
}
?>