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
   

    // Guardar la variable local con los datos del formulario en la sesión.
    $_SESSION["formulario"] = $nuevoUsuario;		
}
else{
    Header("Location: insercionusuario.php");
} // En caso contrario, vamos al formulario
    

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
	// Validación del DNI
	if(empty($nuevoUsuario["dni"])){ 
        array_push ($errores,"El DNI no puede estar vacío");
    }
	else if(!(is_numeric($nuevoUsuario["dni"])) || strlen($nuevoUsuario["dni"])!=8){
		array_push($errores,"el formato de DNI deben ser ocho numeros");
	}

	// Validación del Nombre			
	if(empty($nuevoUsuario["nombre"])) {
        array_push($errores,"el nombre no puede estar vacío");
    }
	// Validación del email
	if(empty($nuevoUsuario["email"])){ 
		array_push($errores,"el email/gmail no puede estar vacío");
	}else if(!filter_var($nuevoUsuario["email"], FILTER_VALIDATE_EMAIL)){
        array_push($errores,"el formato de correo es incorrrecto");
    }
	
		
	// Validación de la contraseña
	if(!isset($nuevoUsuario["contrasena"]) || strlen($nuevoUsuario["contrasena"])<8){
		$errores [] = "<p>Contraseña no válida: debe tener al menos 8 caracteres</p>";
	}else if(!preg_match("/[a-z]+/", $nuevoUsuario["contrasena"]) || 
		!preg_match("/[A-Z]+/", $nuevoUsuario["contrasena"]) || !preg_match("/[0-9]+/", $nuevoUsuario["contrasena"])){
		$errores[] = "<p>Contraseña no válida: debe contener letras mayúsculas y minúsculas y dígitos</p>";
	}
}

?>