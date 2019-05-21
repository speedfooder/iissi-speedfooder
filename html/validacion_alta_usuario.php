<?php
	session_start();

	// Importar librerías necesarias para gestionar direcciones y géneros literarios
	require_once("gestionBD.php");

	// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
	if (isset($_SESSION["formulario"])) {
		// Recogemos los datos del formulario
		$nuevoUsuario["dni"] = $_REQUEST["dni"];
		$nuevoUsuario["nombre"] = $_REQUEST["nombre"];
		$nuevoUsuario["apellidos"] = $_REQUEST["apellidos"];
		$nuevoUsuario["email"] = $_REQUEST["email"];
		$nuevoUsuario["usuario"] = $_REQUEST["usuario"];
		$nuevoUsuario["contrasena"] = $_REQUEST["contrasena"];
		// $nuevoUsuario["confirmpass"] = $_REQUEST["confirmpass"];
		
		
		// Guardar la variable local con los datos del formulario en la sesión.
		$_SESSION["formulario"] = $nuevoUsuario;		
	}
	else // En caso contrario, vamos al formulario
		Header("Location: formularioSesion.php");

	// Validamos el formulario en servidor
	$conexion = crearConexionBD(); 
	$errores = validarDatosUsuario($conexion, $nuevoUsuario);
	cerrarConexionBD($conexion);
	
	// Si se han detectado errores
	if (count($errores)>0) {
		// Guardo en la sesión los mensajes de error y volvemos al formulario
		$_SESSION["errores"] = $errores;
		Header('Location: formularioSesion.php');
	} else
		// Si todo va bien, vamos a la página de acción (inserción del usuario en la base de datos)
		Header('Location: accion_alta_usuario.php');

///////////////////////////////////////////////////////////
// Validación en servidor del formulario de alta de usuario
///////////////////////////////////////////////////////////
function validarDatosUsuario($conexion, $nuevoUsuario){
	$errores=array();
	// Validación del NIF
	if($nuevoUsuario["nif"]=="") 
		$errores[] = "<p>El NIF no puede estar vacío</p>";
	else if(!preg_match("/^[0-9]{8}[A-Z]$/", $nuevoUsuario["nif"])){
		$errores[] = "<p>El NIF debe contener 8 números y una letra mayúscula: " . $nuevoUsuario["nif"]. "</p>";
	}

	// Validación del Nombre			
	if($nuevoUsuario["nombre"]=="") 
		$errores[] = "<p>El nombre no puede estar vacío</p>";
	
	// Validación del email
	if($nuevoUsuario["email"]==""){ 
		$errores[] = "<p>El email no puede estar vacío</p>";
	}else if(!filter_var($nuevoUsuario["email"], FILTER_VALIDATE_EMAIL)){
		$errores[] = "<p>El email es incorrecto: " . $nuevoUsuario["email"]. "</p>";
	}
	
		
	// Validación de la contraseña
	// if(!isset($nuevoUsuario["pass"]) || strlen($nuevoUsuario["pass"])<8){
		// $errores [] = "<p>Contraseña no válida: debe tener al menos 8 caracteres</p>";
	// }else if(!preg_match("/[a-z]+/", $nuevoUsuario["pass"]) || 
		// !preg_match("/[A-Z]+/", $nuevoUsuario["pass"]) || !preg_match("/[0-9]+/", $nuevoUsuario["pass"])){
		// $errores[] = "<p>Contraseña no válida: debe contener letras mayúsculas y minúsculas y dígitos</p>";
	// }else if($nuevoUsuario["pass"] != $nuevoUsuario["confirmpass"]){
		// $errores[] = "<p>La confirmación de contraseña no coincide con la contraseña</p>";
	// }

?>

