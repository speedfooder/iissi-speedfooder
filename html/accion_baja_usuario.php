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
		Header("Location: bajausuario.php");	

	$conexion = crearConexionBD(); 

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="../css/accion_alta_usuario.css">
  <link href="https://fonts.googleapis.com/css?family=Barlow+Condensed|Overpass" rel="stylesheet">
  <title>¿Ya te vas?</title>
</head>

<body class="bienvenida">


	<main>
		<?php if (baja_usuario($conexion, $nuevoUsuario)) {
				unset($_SESSION['login']);
		?>
				<h1>¡Hasta la próxima <?php echo $nuevoUsuario['usuario']; ?>!</h1>
				Pulsa <a href="index.php">aquí</a> para volver a la página principal.
				
		<?php } else { ?>
				<h1>¡Vaya! Algo ha salido mal.</h1>
				<div >	
					Pulsa <a href="bajausuario.php">aquí</a> para volver al formulario.
				</div>
		<?php }
		?>
			
		

	</main>

</body>
</html>
<?php
	cerrarConexionBD($conexion);
?>

