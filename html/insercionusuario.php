<?php
	session_start();

	require_once("gestionBD.php");

	// Si no existen datos del formulario en la sesión, se crea una entrada con valores por defecto
	if (!isset($_SESSION["formulario"])) {
		$formulario['dni'] = "";
		$formulario['nombre'] = "";
		$formulario['apellidos'] = "";
		$formulario['email'] = "";
		$formulario['usuario'] = "";
		$formulario['contrasena'] = "";
	
		$_SESSION["formulario"] = $formulario;
	}
	// Si ya existían valores, los cogemos para inicializar el formulario
	else
		$formulario = $_SESSION["formulario"];
		
	// Si hay errores de validación, hay que mostrarlos y marcar los campos (El estilo viene dado y ya se explicará)
	if (isset($_SESSION["errores"])){
		$errores = $_SESSION["errores"];
		unset($_SESSION["errores"]);
	}
		
	// Creamos una conexión con la BD
	$conexion = crearConexionBD();
?>
<!DOCTYPE HTML5>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
    <h1>Registra usuario</h1>
    
    <form action="validacionServidorUsuario.php" method="post">
      <input type="text" id="nombre" name="nombre" size="40" placeholder="Escribe tu nombre" value="<?php echo $formulario['nombre'];?>">
      <input type="text" id="Apellidos" name="apellidos" size="40" placeholder="Escribe tus apellidos" value="<?php echo $formulario['apellidos'];?>">
      <input type="text" id="DNI" name="dni" size="40" placeholder="Inserta tu DNI" value="<?php echo $formulario['dni'];?>"> 
      <input type="mail" id="email" name="email" size="40" placeholder="email/gmail/hotmailyahoo" value="<?php echo $formulario['email'];?>">
      <input type="text" id="usuario" name="usuario" size="40" placeholder="Inventa un usuario chachi" value="<?php echo $formulario['usuario'];?>">
      <input type="password" id="password" name="contrasena" size="40" placeholder="Escribe tu contraseña super secreta">
    <input type="submit" value="REGÍSTRATE">
    </form>
<br>
<?php 
		// Mostrar los erroes de validación (Si los hay)
		if (isset($errores) && count($errores)>0) { 
	    	echo "<div id=\"div_errores\" class=\"error\">";
			echo "<h4> Errores en el formulario:</h4>";
    		foreach($errores as $error){
    			echo $error;
			} 
    		echo "</div>";
  		}
	?>
    
</body>

<?php
		cerrarConexionBD($conexion);
	?>
</html>