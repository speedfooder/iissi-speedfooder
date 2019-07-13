<?php 

session_start();

require_once ("gestionBD.php");
require_once ("gestionarPlatos.php");
require_once ("paginacion_consulta.php");


if (isset($_SESSION["plato"])) {
			$plato1 = $_SESSION["plato"];
		unset($_SESSION["plato"]);
		$_SESSION["platotrabajo"]=$plato1;
	}else if (isset($_SESSION["platotrabajo"])){
	$plato1=$_SESSION["platotrabajo"];
}else{
	header ("Location: menu.php");
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

	$query=	"SELECT DISTINCT ALIMENTOS.IDALIMENTO, NOMBREALIMENTO, NOMBRE 
	FROM ALIMENTOS,PLATOSALIMENTOS, PROVEEDORES 
	WHERE PLATOSALIMENTOS.IDPLATO=" . $plato1["IDPLATO"]
		 ." AND PLATOSALIMENTOS.IDALIMENTO=ALIMENTOS.IDALIMENTO AND PROVEEDORES.EIN = ALIMENTOS.PROCEDENCIA"
		 . " ORDER BY NOMBREALIMENTO";
		
							

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
	<title>Consulta tus alimentos</title>
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

						<a class="current" href="alimento.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $pag_tam; ?>"><?php echo $pagina; ?></a>

			<?php } ?></li>
		</ul>
  </div>


		
		<div class="menu-section">
			<form method="get" action="alimento.php">

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

		<form method="get" class="plato" action="controlador_alimentos.php">
		

			<input id="IDALIMENTO" name="IDALIMENTO"

				type="hidden" value="<?php echo $fila["IDALIMENTO"]; ?>"/>

			<input id="NOMBREALIMENTO" name="NOMBREALIMENTO"

				type="hidden" value="<?php echo $fila["NOMBREALIMENTO"]; ?>"/>

			<input id="PROCEDENCIA" name="PROCEDENCIA"

				type="hidden" value="<?php echo $fila["NOMBRE"]; ?>"/>
		
			<table>
					<tr>
						<th class="columnas">
								<div><b><?php echo $fila["NOMBREALIMENTO"]; ?></b></div>
						</th>
						<th  class="columnas">
								<div><em><?php echo $fila["NOMBRE"]; ?></em></div>
						</th>
						<th class="c-icono">
							<?php if (isset($_SESSION['login']) && $_SESSION['login'] =='admin') {?>
								<button id="delete" name="deleteAlimento" type="submit">
									<img src="../images/ic-delete.png">
								</button>
							<?php }?>
						</th>
					</tr>	
			</table>		
		</form>
	</article >		

<?php } ?>	