<?php
	session_start();
	
	// Importar librerías necesarias para gestionar direcciones y géneros literarios
	require_once("gestionBD.php");

	// Si no existen datos del formulario en la sesión, se crea una entrada con valores por defecto
	if (!isset($_SESSION["formulario"])) {
		$formulario['usuario'] = "";
		$formulario['contrasena'] = "";
		$_SESSION["formulario"] = $formulario;
	}
	// Si ya existían valores, los cogemos para inicializar el formulario
	else
		$formulario = $_SESSION["formulario"];
		
		#unset($formulario);
			
	// Si hay errores de validación, hay que mostrarlos y marcar los campos (El estilo viene dado y ya se explicará)
	if (isset($_SESSION["errores"])){
		$errores = $_SESSION["errores"];
		unset($_SESSION["errores"]);
	}
		
	// Creamos una conexión con la BD
	$conexion = crearConexionBD();
?>


<html>
<head>
    <title>Baja de usuario</title>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css?family=Barlow+Condensed|Overpass" rel="stylesheet">
    <script src="../js/validacion_cliente_alta_usuario.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="../css/bajausuario.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jQuery/1.12.4/jQuery.min.js"></script>
</head>
<body>
<div class="d-inicio">
    <button class="btn-main-icon" ><a href="index.php"><img src="../images/speedfooder-icon.png"></a></button>

	<?php 
		// Mostrar los erroes de validación (Si los hay)
		if (isset($errores) && count($errores)>0) { 
	    	echo "<div class=\"error\">";
			echo "<h4> Errores en el formulario:</h4>";
    		foreach($errores as $error){
    			echo $error;
			} 
    		echo "</div>";
  		}
	?>

</div>

<section id="formulario">
<p id="titulo">Este es el adios...</p>

<p id="descript">Lamentamos que te tengas que ir, pero si así lo deseas, rellena los campos necesarios</p>
  <form action="validacion_server_borrar_user.php" method="post">
      

      <input type="text" id="nombre" name="usuario" size="40" placeholder="Escribe aquí tu usuario" required oninput="nameValidation();">
      <input type="password" id="password" name="contrasena"  size="40" placeholder="Escribe tu contraseña" pattern="([A-Za-z0-9]+){8,}" required oninput="passwordValidation();">

      
      
      <input type="submit" name="submit" value="¡Nos vemos pronto!">
    
  
</form>
</section>
</body>
</html>