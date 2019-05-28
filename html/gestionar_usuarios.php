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
		return false;
		$e -> getMessage();
		// Si queremos visualizar la excepción durante la depuración: $e->getMessage();
    }
}

  
function consultarUsuario($conexion,$usuario,$contrasena) {
	try{
	echo $usuario ."\n";
	echo $contrasena."\n";
	$consulta ='SELECT CASE WHEN MAX(DNI) IS NULL THEN 0 ELSE 1 END User_exists FROM CONSUMIDORES WHERE USUARIO=:usuario AND CONTRASENA=:contrasena';
	$stmt = $conexion->prepare($consulta);
	$stmt->bindParam(':usuario',$usuario);
	$stmt->bindParam(':contrasena',$contrasena);
	$stmt->execute();
	$count=$stmt->fetchColumn();
	echo $count."\n";
	$data=$stmt->fetch(PDO::FETCH_OBJ);
	return $count;
	}
	catch(PDOException $e) {
	echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

function consultarUsuario2($conexion,$email,$pass) {
 	$consulta = "SELECT COUNT(*) AS TOTAL FROM CONSUMIDORES WHERE USUARIO=:email AND contrasena=:pass";
	$stmt = $conexion->prepare($consulta);
	$stmt->bindParam(':email',$email);
	$stmt->bindParam(':pass',$pass);
	$stmt->execute();
	return $stmt->fetchColumn();
}


