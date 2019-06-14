<?php
  /*
     * #===========================================================#
     * #	Este fichero contiene las funciones de gestión
     * #	de usuarios de la capa de acceso a datos
     * #==========================================================#
     */

 function alta_usuario($conexion,$usuario) {
	$consulta = "CALL CREA_CLIENTE(:w_dni, :w_nombre, :w_apellidos, :w_email, :w_usuario, :w_contrasena)";

	try {
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':w_dni',$usuario["dni"]);
		$stmt->bindParam(':w_nombre',$usuario["nombre"]);
		$stmt->bindParam(':w_apellidos',$usuario["apellidos"]);
		$stmt->bindParam(':w_email',$usuario["email"]);
		$stmt->bindParam(':w_usuario',$usuario["usuario"]);
		$stmt->bindParam(':w_contrasena',$usuario["contrasena"]);
		
		$stmt->execute();
		
		return true;
	} catch(PDOException $e) {
		$_SESSION['excepcion'] = $e->GetMessage();
		header("Location: excepcion.php");
		return false;
		
    }
}

function consultarUsuario($conexion,$email,$pass) {
 	$consulta = "SELECT COUNT(*) AS TOTAL FROM CONSUMIDORES WHERE USUARIO=:email AND contrasena=:pass";
	$stmt = $conexion->prepare($consulta);
	$stmt->bindParam(':email',$email);
	$stmt->bindParam(':pass',$pass);
	$stmt->execute();
	return $stmt->fetchColumn();
}

function consulta_dni_usuario($conexion,$usuario) {
 	$consulta = "SELECT DNI FROM CONSUMIDORES WHERE USUARIO=:usuario AND contrasena=:pass";
	$stmt = $conexion->prepare($consulta);
	$stmt->bindParam(':usuario',$usuario["usuario"]);
	$stmt->bindParam(':pass',$usuario["contrasena"]);
	$stmt->execute();
	return $stmt->fetchColumn();
}



function baja_usuario($conexion,$usuario) {
	$dni = consulta_dni_usuario($conexion,$usuario);
	if($dni == 0) {
		return false;
	} else {
		$consulta = "CALL ELIMINA_CLIENTE(:w_dni)";
		try {
			$stmt = $conexion->prepare($consulta);
			$stmt->bindParam(':w_dni',$dni);
			$stmt->execute();
			return true;
		} catch(PDOException $e) {
			$_SESSION['excepcion'] = $e->GetMessage();
			header("Location: excepcion.php");
			return false;
		}	
	}
}


