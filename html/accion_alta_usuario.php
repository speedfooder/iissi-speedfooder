<?php
	session_start();

	require_once("gestionBD.php");
	require_once("gestionar_usuarios.php");
		
	// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
	if (isset($_SESSION["formulario"])) {
		$nuevoUsuario = $_SESSION["formulario"];
		$_SESSION["formulario"] = null;
		$_SESSION["errores"] = null;
	}
	else 
		Header("Location: formularioSesion.php");	

	$conexion = crearConexionBD(); 

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>¡Bienvenido!</title>
</head>

<body>


	<main>
		<?php if (alta_usuario($conexion, $nuevoUsuario)) { 
				$_SESSION['login'] = $nuevoUsuario['email'];
		?>
				<h1>Hola <?php echo $nuevoUsuario["nombre"]; ?>, gracias por registrarte</h1>
				<div >	
			   		Pulsa <a href="index.html">aquí</a> para acceder a tu restaurante favorito.
				</div>
		<?php } else { ?>
				<h1>El usuario ya existe en la base de datos.</h1>
				<div >	
					Pulsa <a href="formularioSesion.php">aquí</a> para volver al formulario.
				</div>
		<?php }
		?>
			
		?>

	</main>

</body>
</html>
<?php
	cerrarConexionBD($conexion);
?>

