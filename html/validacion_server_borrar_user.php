<?php 
session_start();

// Importar librerías necesarias para gestionar direcciones y géneros literarios
require_once("gestionBD.php");

// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
if (isset($_SESSION["formulario"])) {
    // Recogemos los datos del formulario
    $eliminarUsuario["usuario"] = $_POST["usuario"];
    $eliminarUsuario["contrasena"] = $_POST["contrasena"];
   
    // Guardar la variable local con los datos del formulario en la sesión.
    $_SESSION["formulario"] = $eliminarUsuario;		
}
else{
    Header("Location: bajausuario.php");
} // En caso contrario, vamos al formulario
    

    // Validamos el formulario en servidor
	$conexion = crearConexionBD(); 
	$errores = validarDatosUsuario($conexion, $eliminarUsuario);
	cerrarConexionBD($conexion);
	
	// Si se han detectado errores
	if (count($errores)>0) {
		// Guardo en la sesión los mensajes de error y volvemos al formulario
		$_SESSION["errores"] = $errores;
		Header('Location: bajausuario.php');
	} else
		// Si todo va bien, vamos a la página de acción (inserción del usuario en la base de datos)
		Header('Location: accion_baja_usuario.php');

///////////////////////////////////////////////////////////
// Validación en servidor del formulario de baja de usuario
///////////////////////////////////////////////////////////
function validarDatosUsuario($conexion, $eliminarUsuario){
	$errores=array();

	// Validación del Nombre			
	if($eliminarUsuario["usuario"]=="") {
        array_push($errores,"El usuario no puede estar vacío. \n");
    }
	
	// Validación de la contraseña
	if(!isset($eliminarUsuario["contrasena"]) || strlen($eliminarUsuario["contrasena"])<8){
		array_push($errores,"La contraseña es incorrecta. Debe tener al menos 8 caracteres. \n");
	
	}else if(!preg_match("/[a-z]+/", $eliminarUsuario["contrasena"]) || 
		!preg_match("/[A-Z]+/", $eliminarUsuario["contrasena"]) || !preg_match("/[0-9]+/", $eliminarUsuario["contrasena"])){
		array_push($errores,"Contraseña no válida: debe contener letras mayúsculas y minúsculas y dígitos. \n");
	}

	return $errores;
}

?>