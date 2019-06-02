<?php
	session_start();
  	
  	include_once("gestionBD.php");
 	include_once("gestionar_usuarios.php");
	
	if (isset($_POST['submit'])){
		$usuario= $_POST['usuario'];
		$contrasena = $_POST['contrasena'];

		$conexion = crearConexionBD();
		$num_usuarios = consultarUsuario($conexion,$usuario,$contrasena);
		cerrarConexionBD($conexion);	
		
		if ($num_usuarios > 0){
			$_SESSION['login'] = $usuario;
			Header("Location: menu.php");
			
		}
				
		else {
			$login = "error";
		}	
	}

?>

<html>
<head>
    <title>¡Inicia Sesión!</title>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css?family=Barlow+Condensed|Overpass" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/inicioSesion.css">
                                
    
</head>
<body>
	
	<?php if (isset($login)) {
		echo "<div class=\"error\">";
		echo "Error en la contraseña o no existe el usuario.";
		echo "</div>";
	}	
	?>
	
<div class="d-inicio">
    <button class="btn-main-icon" ><a href="index.html"><img src="../images/speedfooder-icon.png"></a></button>
</div>
<section id="formulario">
<p id="titulo">Inicia Sesión</p>
  <form action="inicioSesion.php" method="post">
      

      <input type="text" id="Usuario" name="usuario" size="40" placeholder="Introduce tu usuario">
      <input type="password" id="Contraseña" name="contrasena" size="40" placeholder="Escribe tu contraseña secreta">

      
      
      <input type="submit" name="submit" value="¡INICIA SESIÓN!">
    
  
</form>
    <p id="AlertaReg">¿No tienes usuario? Regístrate <a href="formularioSesion.php">aquí</a></p>
</section>
</body>
</html>