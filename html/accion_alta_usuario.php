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
  <link rel="stylesheet" type="text/css" href="../css/accion_alta_usuario.css">
  <link href="https://fonts.googleapis.com/css?family=Barlow+Condensed|Overpass" rel="stylesheet">
  <title>¡Bienvenido!</title>
</head>

<body>


	<main>
		<?php if (alta_usuario($conexion, $_POST)) { 
				$_SESSION['login'] = $_POST['email'];
		?>
				<h1 class="bienvenida">Hola <?php echo $_POST["nombre"]; ?>, gracias por registrarte</h1>
				<div class="bienvenida">	
			   		Pulsa <a class="bienvenida" href="index.php">aquí</a> para acceder a tu restaurante favorito.
				</div>
		<?php } else { ?>
				<h1>El usuario ya existe en la base de datos.</h1>
				<div >	
					Pulsa <a href="formularioSesion.php">aquí</a> para volver al formulario.
				</div>
		<?php }
		?>
			
		

	</main>

</body>
</html>
<?php
	cerrarConexionBD($conexion);
?>

