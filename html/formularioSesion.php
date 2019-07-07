<?php
	session_start();
	
	// Importar librerías necesarias para gestionar direcciones y géneros literarios
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

<html>
<head>
    <meta charset="UTF-8">
    <title>Inicio de Sesión</title>
    <script src="../js/validacion_cliente_alta_usuario.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="../css/signinform.css">
    <link href="https://fonts.googleapis.com/css?family=Barlow+Condensed|Overpass" rel="stylesheet">
</head>
<body>
	
	<script>
		// Inicialización de elementos y eventos cuando el documento se carga completamente
		$(document).ready(function() {
			$("#altaUsuario").on("submit", function() {
				return validateForm();
			});			
			// Copiar automáticamente el email como usuario
			$("#email").on("input", function(){
				$("#usuario").val($(this).val());
			});

			/* Colorea la contraseña segun la fortaleza de esta
			$("#password").on("keyup", function() {
				// Calculo el color
				passwordColor();
			});*/
		});
	</script>
	
	
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
	
  <div class="d-inicio">
    <button class="btn-main-icon" ><a href="index.php"><img src="../images/speedfooder-icon.png"></a></button>
    
  </div>
<section id="formulario">
<p id="titulo">Regístrate</p>
  <form action="validacionServidorUsuario.php" method="post">
      <input type="text" id="nombre" name="nombre" size="40" placeholder="Escribe tu nombre" value="<?php echo $formulario['nombre'];?>" required oninput="nameValidation(); ">
      <input type="text" id="Apellidos" name="apellidos" size="40" placeholder="Escribe tus apellidos" value="<?php echo $formulario['apellidos'];?>">
      <input type="text" id="DNI" name="dni" size="40" placeholder="Inserta tu DNI" pattern="^[0-9]{8}"  value="<?php echo $formulario['dni'];?>" required oninput="dniValidation(); "> 
      <input type="mail" id="email" name="email" size="40" placeholder="email/gmail/hotmailyahoo" value="<?php echo $formulario['email'];?>" required oninput="emailValidation(); ">
      <input type="text" id="usuario" name="usuario" size="40" placeholder="Inventa un usuario chachi" value="<?php echo $formulario['usuario'];?>" required>
      <input type="password" id="password" name="contrasena" size="40" placeholder="Escribe tu contraseña super secreta" required oninput="passwordValidation(); ">
      
  
  
    <input type="submit" value="REGÍSTRATE">
    
  
</form>
</section>
     <?php
		cerrarConexionBD($conexion);
	?>
</body>
</html>