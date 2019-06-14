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
    <link rel="stylesheet" type="text/css" href="../css/bajausuario.css">
</head>
<body>
<div class="d-inicio">
    <button class="btn-main-icon" ><a href="index.html"><img src="../images/speedfooder-icon.png"></a></button>
</div>
<section id="formulario">
<p id="titulo">Este es el adios...</p>

<p id="descript">Lamentamos que te tengas que ir, pero si así lo deseas, rellena los campos necesarios</p>
  <form action="accion_baja_usuario.php" method="post">
      

      <input type="text" id="Usuario" name="usuario" size="40" placeholder="Escribe aquí tu usuario">
      <input type="password" id="Contraseña" name="contrasena" size="40" placeholder="Escribe tu contraseña">

      
      
      <input type="submit" name="submit" value="¡Nos vemos pronto!">
    
  
</form>
</section>
</body>
</html>