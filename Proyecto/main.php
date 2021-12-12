<?php
	require_once ("Tiempo.php");
	require_once "Producto.php";
	require_once "Conexion.php";
	require_once "Consta.php";
	require_once "Compra.php";
	//  $productos = Producto::recuperarProductos();

	//mostrar productos ordenados segun categoria
	$busqueda = $_POST["opcionesBusqueda"]??"";
	if (isset($busqueda))
		$productos = Producto::ordenarProductos($busqueda);


	//contar productos
	$contarProd = Producto::contarProductos();

	//recuperar compra
	  $compra= Compra::recuperarCompraID($_SESSION["user"]);
	//coger id de compra
	 $idCompra= $compra[0]->id_compra;


	//MOSTRAR CARRITO
	//recuperar productos del carrito
	 $carrito = Consta::mostrarCarrito($idCompra);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main</title>
		<!-- css -->
		<link rel="stylesheet" href="./css/main.css">
	<!-- bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<!-- fontawesome -->
	<script src="https://kit.fontawesome.com/5831c4a164.js" crossorigin="anonymous"></script>


</head>
<body>

	<div id="container">
		<!-- NAV -->
		<div id="nav" class="item">
			<!-- Nav superior, con logo y búsqueda -->

			<div id="logo">
			<a href="index.php">	<img class="logo--img"src="img/logo.png" alt=""> </a>
			</div>
			<div id="buscar">
				<form class="nav--form">
					<input class="nav--form__input" type="search" placeholder="&#xf07a Buscar" aria-label="Search" readonly>
					<a href="#" class="nav--form__icon"><i class="far fa-smile"></i></i></i></a>
					<a href="#" id="carrito--btn" class="nav--form__icon"><i class="fas fa-shopping-cart"></i></a>
					<a href="logout.php" class="nav--form__icon " ><i class="fas fa-times"></i></a>
				</form>
			</div>
			<!-- Botones de cada seccion -->
			<div id="btn">
				<a class="btn--item__grid" href="comingsoon.php">Nuestros Valores</a>
				<a class="btn--item__grid"href="#">New</a>
				<a class="btn--item__grid"href="#">Descubre</a>
				<a class="btn--item__grid"href="comingsoon.php">El equipo</a>
			</div>
			<!-- Texto amarillo : font-family: tahoma -->
			<div id="texto--amarillo">
				<p>¡El envío gratis ha vuelto para todas las compras superiores a 50€! Compra ahora y paga a plazos. <a href="comingsoon.php">Informate</a></p>
			</div>
		</div>
		<!-- Fin nav -->


		<!--  Texto -->
		<div id="texto--div" class="item">
		<!-- font family: impact -->
			<p>Sometimes I'll start a sentence and I don't even know where it's going. I just hope I find it along the way.</p>
		</div>

		<!-- SIDE -->
		<div id="side" class="item" method="post">
			<div id="goldenTicket">
				<a href="GTicket.php">Descubre aquí si has ganado el Golden Ticket</a>
				<img id="gt--michael"src="https://gcdn.lanetaneta.com/wp-content/uploads/2021/06/La-oficina-5-formas-en-que-Dunder-Mifflin-es-la.5.jpeg" alt="">
				<img id="gt--gt"src="./img/gt.jpg" alt="">

			</div>


		</div>

		<!-- procesamiento del checkbox -->

		<?php
		$db = Conexion::getInstanciaBD();
		$imploded;
		//si se procesa el formulario
		if(isset($_POST["enviar"])):
			//longitud del array estados []
			$tamaño = count($_POST["categoria"]);
			//recorrer el array pasado por el formulario con los valores de los checkbox que fueron marcados
    		for($i=0;$i<$tamaño;$i++){
        	$imploded= implode("','",$_POST["categoria"]);

			}
			$sql = " SELECT * FROM producto WHERE categoria IN ($imploded)";
			$busqueda = $db->consultaBD($sql);

			$busquedaTodo = $db->Conexion::recuperarTodoBD("Producto");
			var_dump($busquedaTodo);

		endif;


		?>


		<!-- MAIN -->
		<div id="main" class="item">
			<div id="buscar--main">
				<p><?=$contarProd?> resultados</p>
				<form method="POST">
					<select name="opcionesBusqueda" id="opt--busqueda">
						<option selected disabled>Ordenar por</option>
						<option value="valoracion">Valoracion</option>
						<option value="nombre">Nombre</option>
						<option value="precioDESC">Precio (desc)</option>
						<option value="precioASC">Precio (asc)</option>
					</select>
					<input type="submit">
				</form>
			</div>
		<?php



		if (empty($productos)):
		?>
			<div class="alert alert-info">
				No se han encontrado registros
			</div>
		<?php
		else:
			$i = 0 ;
				while ($i < count($productos)):
		?>
				<div class="card" >
					<img src="<?=$productos[$i]->imagen?>" class="main--prod__img" >
					<h5 class="main--prod__tit"><?=$productos[$i]->nombre?></h5>
					<p class="main--prod__desc"><?=$productos[$i]->valoracion?> /5</p>
					<p class="main--prod__desc"><?=$productos[$i]->descripcion?></p>
					<a href="carrito.php?<?php echo "idProd={$productos[$i]->cod_prod}"?>" class="main--prod__btn">Añadir a la cesta</a>
				</div>
			<?php
				$i++;
			endwhile ;
		 endif ;
		 ?>
		</div>

		<!-- Footer -->
		<?=
		require_once("footer.php");
		?>

	</div>
	<div id="fondo">

	</div>


		<!-- Carrito -->

		<div id="carrito">
			<div id="carrito--titulo">
				<h3>Cesta</h3>
				<a href="#" id="carrito--close__btn"><i  class="fas fa-times"></i></a>
			</div>
			<div id="carrito--productos">
				<?php

				if (empty($carrito)):
				?>
					<h2>La CESTA ESTA VACIA</h2>
				<?php
				else:
					$i=0;
					while($i < count($carrito)):
				?>
						<div id="c--items">
							<img src="<?=$carrito[$i]->imagen?>" class="c--items__img">
							<p class="c--items__nombre"><?=$carrito[$i]->nombre?></p>
							<a href="borrar.php?<?php echo "codProd={$carrito[$i]->cod_prod}"?>"><i class="fas fa-trash-alt c--items__borrar"></i></a>
							<p class="c--items__cantidad">Cantidad :<?=$carrito[$i]->cantidad?></p>
							<p class="c--items__precio"><?=$carrito[$i]->precio?>€</p>
						</div>
				<?php
					$i++;
					endwhile;
				endif;
				?>
			</div>
			<?php
			$precioTotal = Consta::precioTotal($carrito);
			?>
			<div id="carrito--total">
				<p class="total">Total</p>
				<p class="precio--total"><?=$precioTotal?>€</p>
				<a id="total--btn"href="mipedido.php">Realizar mi compra</a>
			</div>
		</div>






   <script src="js/Main.js"></script>
</body>
</html>