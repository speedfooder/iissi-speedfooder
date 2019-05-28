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
 	$consulta = "SELECT DNI FROM CONSUMIDORES WHERE USUARIO=:usuario AND CONTRASENA=:contrasena";
	$stmt = $conexion->prepare($consulta);
	$stmt->bindParam(':usuario',$usuario,PDO::PARAM_STR);
	$stmt->bindParam(':contrasena',$contrasena,PDO::PARAM_STR);
	$stmt->execute();
	//echo $stmt ."\n";
	$count=$stmt->rowCount();
	$data=$stmt->fetch(PDO::FETCH_OBJ);
	echo $count;
	if($count>0)
	{
	$_SESSION['dni']=$data->dni; // Storing user session value
	return true;
	}
	else
	{
	return false;
	} 
	}
	catch(PDOException $e) {
	echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

function consultarUsuario2($conexion,$usuario,$contrasena) {
	$consulta = "SELECT DNI FROM CONSUMIDORES WHERE USUARIO=:w_usuario AND CONTRASENA=contrasena";
	
	try {
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':w_usuario',$usuario, PDO::PARAM_STR);
		$stmt->bindParam(':w_contrasena',$contrasena, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt -> rowCount();
	} catch(PDOException $e) {
		$e -> getMessage();
		print_r($e -> getMessage());
		return 0;
		
    }
}

