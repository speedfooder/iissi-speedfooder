<?php 

session_start();

require_once ("gestionBD.php");
require_once ("gestionarPlatos.php");
require_once ("paginacion_consulta.php");


if (isset($_SESSION["platotrabajo"])) {
		unset($_SESSION["platotrabajo"]);
	}
if (isset($_SESSION["plato"])) {
		$plato = $_SESSION["plato"];
		unset($_SESSION["plato"]);
	}
if (isset($_SESSION["paginacion"])){
		$paginacion = $_SESSION["paginacion"];
}
if (isset($_SESSION["opcion"])){
	$option=$_SESSION["opcion"];
	unset($_SESSION["opcion"]);
}

$pagina_seleccionada = isset($_GET["PAG_NUM"]) ? (int)$_GET["PAG_NUM"] : (isset($paginacion) ? (int)$paginacion["PAG_NUM"] : 1);
	$pag_tam = isset($_GET["PAG_TAM"]) ? (int)$_GET["PAG_TAM"] : (isset($paginacion) ? (int)$paginacion["PAG_TAM"] : 5);

if ($pagina_seleccionada < 1){
 	$pagina_seleccionada = 1;
}
if ($pag_tam < 1){ 		
	$pag_tam = 5;
}
	// borramos las variables de sección para no confundirnos más adelante
unset($_SESSION["paginacion"]);

$conexion = crearConexionBD();

$query="SELECT IDPLATO, NOMBRE, PRECIO FROM PLATOS"
		. " ORDER BY NOMBRE";
		

							

$total_registros = total_consulta($conexion, $query);
$total_paginas = (int)($total_registros / $pag_tam);

if ($total_registros % $pag_tam > 0){		
	$total_paginas++;
}
if ($pagina_seleccionada > $total_paginas){		
	$pagina_seleccionada = $total_paginas;
	}
	// Generamos los valores de sesión para página e intervalo para volver a ella después de una operación
$paginacion["PAG_NUM"] = $pagina_seleccionada;
$paginacion["PAG_TAM"] = $pag_tam;
$_SESSION["paginacion"] = $paginacion;

$filas = consulta_paginada($conexion, $query, $pagina_seleccionada, $pag_tam);

	cerrarConexionBD($conexion);

?>


<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Menu</title>
	<link href="https://fonts.googleapis.com/css?family=Barlow+Condensed|Overpass" rel="stylesheet">
	<script src="../js/menu_popup.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="../css/menu.css">
</head>

<body>

	<div class="d-inicio">
    <a href="index.php"><button class="btn-main-icon"><img src="../images/speedfooder-icon.png"></button>
    <p class="p-inicio">¡Vuelve al inicio!</p></a>
	</div>
	<div>
		<ul>
 			
			<li class = "pagina"><?php

				for( $pagina = 1; $pagina <= $total_paginas; $pagina++ )

					if ( $pagina == $pagina_seleccionada) { 	?>

						<span class="current"><?php echo $pagina; ?></span>

			<?php }	else { ?>

						<a class="current" href="menu.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $pag_tam; ?>"><?php echo $pagina; ?></a>

			<?php } ?></li>
			<?php 
				if (isset($_SESSION['login'])) {?>
					<li class = "pedido"><a  href="#">¡Haz tu pedido!</a></li>
			<?php } else { ?>
					<li class = "pedido"><a  href="inicioSesion.php">¡Inicia sesión para hacer tu pedido!</a></li>
			<?php }?>
		</ul>
  </div>


		
		<div class="menu-section">
		

			
			
			<form method="get" action="menu.php">

			<input id="PAG_NUM" name="PAG_NUM" type="hidden" value="<?php echo $pagina_seleccionada?>"/>

			Mostrando

			<input id="PAG_TAM" name="PAG_TAM" type="number"

				min="1" max="<?php echo $total_registros; ?>"

				value="<?php echo $pag_tam?>" autofocus="autofocus" />

			entradas de <?php echo $total_registros?>

			<input type="submit" style="font-family: 'Overpass', sans-serif;" value="Cambiar">

			</form>
		</div>
		
		
	<?php

		foreach($filas as $fila) {

	?>



	<article >

		<form method="post" class="plato" action="controlador_platos.php">
		

			<input id="IDPLATO" name="IDPLATO"

				type="hidden" value="<?php echo $fila["IDPLATO"]; ?>"/>

			<div>
			<input id="NOMBRE" name="NOMBRE"

				type="hidden" value="<?php echo $fila["NOMBRE"]; ?>"/>

			<input id="PRECIO" name="PRECIO"

				type="hidden" value="<?php echo $fila["PRECIO"]; ?>"/>
			
			<input id="alimentos" name="alimentos"

				type="hidden" value="<?php echo $fila["IDPLATO"]; ?>"/>
			
			<input id="alergenos" name="alergenos"

				type="hidden" value="<?php echo $fila["IDPLATO"]; ?>"/>
			
			<div>
				
				<table>
				<tr>
				<th class="columnas">

						<!-- mostrando plato -->

						<!-- <input id="TITULO" name="TITULO" type="hidden" value="<?php echo $fila["IDPLATO"]; ?>"/> -->

						<div><b><?php echo $fila["NOMBRE"]; ?></b></div>
				</th>
				<th  class="columnas">
						<div><em><?php echo $fila["PRECIO"]; ?></em>€</div>
				</th>
				
				<th class="columnas">
						<div>
						
						<div class="popup" onclick="myFunction(<?php echo $fila["IDPLATO"];?>)"> Alimentos
							<span class="popuptext" id=<?php echo "Popupalimentos".$fila["IDPLATO"];?>><?php
							$platoSeleccionado = $fila["IDPLATO"];
							$conexion2=crearConexionBD();
							$query2= "SELECT DISTINCT NOMBREALIMENTO FROM ALIMENTOS,PLATOSALIMENTOS WHERE PLATOSALIMENTOS.IDPLATO=" . $platoSeleccionado
							." AND PLATOSALIMENTOS.IDALIMENTO=ALIMENTOS.IDALIMENTO";
							$alimentos=consulta_alimentos($conexion2,$query2);
							$cadena="";
							
							$longitud = count($alimentos);
							$listaAl="";
							foreach($alimentos as $aliment)
								 {
								  foreach(array_unique($aliment) as $a) {
									$listaAl .= $a . ",";
								  }
								  
								}
							$listaAl = trim($listaAl,",");
							$listaAl = str_replace(",",", ",$listaAl);
							echo $listaAl;
							;?></span>
							
						</div>
					</th>
					<th class="columnas">
				
						<div class="popup" onclick="FunctionAlerg(<?php echo $fila["IDPLATO"];?>)">Alergenos
							<span class="popuptext" id=<?php echo "Popupalerg".$fila["IDPLATO"];?>>
							<?php
							$conexion3=crearConexionBD();
							$query3= "SELECT DISTINCT NOMBREALERGENO FROM ALIMENTOS,ALERGENOS, PLATOSALIMENTOS WHERE PLATOSALIMENTOS.IDPLATO=" 
							. $fila["IDPLATO"]
							." AND PLATOSALIMENTOS.IDALIMENTO=ALIMENTOS.IDALIMENTO AND ALIMENTOS.ALERGENO = ALERGENOS.IDALERGENO";
							$alergenos=consulta_alimentos($conexion3,$query3);
							$listaAler="";
							foreach($alergenos as $alergen)
								 {
								  foreach(array_unique($alergen) as $alerg) {
									$listaAler .= $alerg . ",";
								  }
								  
								}
							$listaAler = trim($listaAler,",");
							$listaAler = str_replace(",",", ",$listaAler);
							echo $listaAler;
						;?>
							
							</span>
							
						</div>
				</div>
				</th>
				<th id="c-icono">

				<?php
					if (isset($plato) and $option==1 and ($plato["IDPLATO"] == $fila["IDPLATO"])) { ?>

						<!-- Editando título -->

						<h3><input id="NOMBRE" name="NOMBRE" type="text" value="<?php echo $fila["NOMBRE"]; ?>"/>	</h3>

					<?php }	else { ?>

						<!-- mostrando título -->

						<input id="NOMBRE" name="NOMBRE" type="hidden" value="<?php echo $fila["NOMBRE"]; ?>"/>
				<?php } ?>
				
				<?php
					if (isset($plato) and $option==2 and ($plato["IDPLATO"] == $fila["IDPLATO"])) { ?>

						<!-- Editando precio -->

						<h3><input class="precio" name="precio" type="text" value="<?php echo $fila["PRECIO"]; ?>"/>	</h3>

					<?php }	else { ?>

						<!-- mostrando precio -->

						<input class="i-precio" name="precio" type="hidden" value="<?php echo $fila["PRECIO"]; ?>"/>
					<?php } ?>
					
					

			<div id="botones_fila">

			<?php if (isset($_SESSION['login']) && $_SESSION['login'] =='admin') {?>
					
						
					<?php if (isset($plato) and $option==1 and ($plato["IDPLATO"] == $fila["IDPLATO"])) { ?>

							<button id="grabar" name="grabar" type="submit" class="editar_fila">

								<img src="../images/ic-save.png" class="editar_fila" alt="Guardar modificación">

							</button>

					<?php } else { ?>

							<button id="editar" name="editar" type="submit" class="editar_fila">

								<img src="../images/ic-edit.png" class="editar_fila" alt="Editar plato">

							</button>

					<?php } ?>

					<?php if (isset($plato) and $option==2 and ($plato["IDPLATO"] == $fila["IDPLATO"])) { ?>

							<button id="grabar" name="grabarprecio" type="submit" class="editar_fila">

								<img src="../images/ic-save.png" class="editar_fila" alt="Guardar modificación">

							</button>

					<?php } else { ?>

						<button id="precio" name="editprecio" type="submit" class="editar_fila">
						<img src="../images/ic-precio.png" alt="Guardar modificación">
						</button>

					<?php } ?>		
					

					<button id="aliment" name="aliment" type="submit">
					<img src="../images/ic-food.png">
					</button>
			
					<button id="alerg" name="alerg" type="submit">
					<img src="../images/ic-alergeno.png">
					</button>
					
					<button id="delete" name="delete" type="submit">
					<img src="../images/ic-delete.png">
					</button>

				<?php }?>
					
				</div>
				</th>
				</tr>
				</table>


			</div>

		</form>

	</article>



	<?php } ?>
</body>
</html>

