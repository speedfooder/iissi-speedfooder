<?php
  /*
     * #===========================================================#
     * #	Este fichero contiene las funciones de gestión
     * #	de usuarios de la capa de acceso a datos
     * #==========================================================#
     */

 function alta_usuario($conexion,$usuario) {
	$consulta = "CALL crea_cliente(:dni, :nombre, :apellidos, :email, :usuario, :contrasena)";

	try {
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':dni',$usuario["dni"]);
		$stmt->bindParam(':nombre',$usuario["nombre"]);
		$stmt->bindParam(':apellidos',$usuario["apellidos"]);
		$stmt->bindParam(':email',$usuario["email"]);
		$stmt->bindParam(':usuario',$usuario["usuario"]);
		$stmt->bindParam(':contrasena',$usuario["contrasena"]);
		
		$stmt->execute();
		
		return true;
	} catch(PDOException $e) {
		return false;
		$e -> getMessage();
		// Si queremos visualizar la excepción durante la depuración: $e->getMessage();
    }
}

  
function consultarUsuario($conexion,$email,$pass) {
 	$consulta = "SELECT COUNT(*) AS TOTAL FROM USUARIOS WHERE EMAIL=:email AND PASS=:pass";
	$stmt = $conexion->prepare($consulta);
	$stmt->bindParam(':email',$email);
	$stmt->bindParam(':pass',$pass);
	$stmt->execute();
	return $stmt->fetchColumn();
}

