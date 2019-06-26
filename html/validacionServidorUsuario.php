<?php 
session_start();

// Importar librerías necesarias para gestionar direcciones y géneros literarios
require_once("gestionBD.php");

// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
if (isset($_SESSION["formulario"])) {
    // Recogemos los datos del formulario
    $nuevoUsuario["dni"] = $_POST["dni"];
    $nuevoUsuario["nombre"] = $_POST["nombre"];
    $nuevoUsuario["apellidos"] = $_POST["apellidos"];
    $nuevoUsuario["email"] = $_POST["email"];
    $nuevoUsuario["usuario"] = $_POST["usuario"];
    $nuevoUsuario["contrasena"] = $_POST["contrasena"];
   

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
		Header('Location: insercionusuario.php');
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
        array_push ($errores,"El DNI no puede estar vacío \n");
    }
	else if(!(is_numeric($nuevoUsuario["dni"])) || strlen($nuevoUsuario["dni"])!=8){
		array_push($errores,"el formato de DNI deben ser ocho numeros. \n");
	}

	// Validación del Nombre			
	if(empty($nuevoUsuario["nombre"])) {
        array_push($errores,"el nombre no puede estar vacío. \n");
    }
	// Validación del email
	if(empty($nuevoUsuario["email"])){ 
		array_push($errores,"el email/gmail no puede estar vacío. \n");
	}else if(!filter_var($nuevoUsuario["email"], FILTER_VALIDATE_EMAIL)){
        array_push($errores,"el formato de correo es incorrrecto. \n");
    }
	
	// Validación de la contraseña
	if(!isset($nuevoUsuario["contrasena"]) || strlen($nuevoUsuario["contrasena"])<8){
		array_push($errores,"La contraseña es incorrecta. Debe tener al menos 8 caracteres. \n");
	
	}else if(!preg_match("/[a-z]+/", $nuevoUsuario["contrasena"]) || 
		!preg_match("/[A-Z]+/", $nuevoUsuario["contrasena"]) || !preg_match("/[0-9]+/", $nuevoUsuario["contrasena"])){
		array_push($errores,"Contraseña no válida: debe contener letras mayúsculas y minúsculas y dígitos. \n");
	}

	return $errores;
}

?>