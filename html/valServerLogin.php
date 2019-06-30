<?php

session_start();

// Importar librerías necesarias para gestionar direcciones y géneros literarios
require_once("gestionBD.php");

if (isset($_POST["submit"])) {
    // Recogemos los datos del formulario
    $nuevoUsuario["usuario"] = $_POST["usuario"];
    $nuevoUsuario["contrasena"] = $_POST["contrasena"];
   

    // Guardar la variable local con los datos del formulario en la sesión.
    $_SESSION["formulario"] = $nuevoUsuario;		
}
else{
    Header("Location: inicioSesion.php");
} // En caso contrario, vamos al formulario
    

    // Validamos el formulario en servidor
	$conexion = crearConexionBD(); 
	$errores = validarDatosUsuario($conexion, $nuevoUsuario);
	cerrarConexionBD($conexion);
	
	$_SESSION["errores"] = $errores;
	Header('Location: inicioSesion.php');
	

///////////////////////////////////////////////////////////
// Validación en servidor del formulario de alta de usuario
///////////////////////////////////////////////////////////
function validarDatosUsuario($conexion, $nuevoUsuario){
	$errores=array();

	// Validación de la contraseña
	if(!isset($nuevoUsuario["contrasena"]) || strlen($nuevoUsuario["contrasena"])<=0){
		array_push($errores,"La contraseña no puede estar vacia. Debe tener al menos 8 caracteres. \n");
	
	}
	//validacion usuario
	if(!isset($nuevoUsuario["usuario"]) || strlen($nuevoUsuario["usuario"])<=0){
		array_push($errores,"El usuario no puede estar vacío.\n");
	
	}

	return $errores;
}

?>