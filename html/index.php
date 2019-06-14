 <!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link href="https://fonts.googleapis.com/css?family=Acme|Barlow+Condensed|Courgette|Overpass|Pathway+Gothic+One" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../css/index.css" media="screen" />
<title>Pizzas Y Empanadas</title>
</head>
<body>
<div class="d-inicio-sesion">
<?php 
session_start();
if (!isset($_SESSION['login'])) {?>
	<a href="inicioSesion.php">¡Inicia sesión!</a>
	<p>¿Aún no tienes cuenta? <a href="formularioSesion.php">¡Regístrate!</a></p>
<?php } else { ?>
 <p>Hola, <?php echo $_SESSION['login'];?></p>
 <a href="accion_desconectar_usuario.php">Desconectar</a>
<?php }?>
</div>

<div>
	<table>
		<tr>
			<th class="column1"><a href="inicioSesion.php"><button class="btn"> <img src="../images/pizza1.jpg"/></button></a></th>
			<th class="column2"><a href="menu.php"><button class="btn"> <img src="../images/pizza2.jpg"/></button></a></th>
		</tr>
		<tr>
			<th class="column1"><a href="bajausuario.php"><button class="btn"><img src="../images/pizza3.jpg"/></button></a></th>
			<th class="column2"><a href="about-us.html"><button class="btn"><img src="../images/pizza4.jpg"/></button></a></th>
		</tr>
	</table>
</div>
<div id="icons">
	<table>
		<tr>
			<th class="column1"><a href="https://www.facebook.com"><button class="btn-icon"><img src="../images/fb-icon.png"/></button></a></th>
			<th><a href="https://www.twitter.com"><button class="btn-icon"><img src="../images/tw-icon.png"/></button></a></th>
			<th class="column2"><a href="https://www.instagram.com"><button class="btn-icon"><img src="../images/ig-icon.png"/></button></a></th>

		</tr>
	</table>
</div>
</body>
</html>
