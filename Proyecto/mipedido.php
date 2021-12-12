<?php

require_once ("Tiempo.php");
require_once("consta.php");
require_once("compra.php");
require_once("cliente.php");

	// Comprobamos si hay sesión iniciada. Si no la hay,
	// redirigimos a la página principal.
	if (!isset($_SESSION["user"]))
	header("Location:index.php") ;

	//control del tiempo de sesion
 	if (time() - $_SESSION["time"] > 1800)
  	header("Location:logout.php") ;



	//recuperar compra
	$compra = Compra::recuperarCompraID($_SESSION["user"]);

	//coger id de compra
	$idCompra= $compra[0]->id_compra;
	//id cliente en compra
	$idCli = $compra[0]->id_cliente;
	$cliente = Cliente::mostrarCliente($idCli);

		//MOSTRAR CARRITO	
	//recuperar productos del carrito
	$carrito = Consta::mostrarCarrito($idCompra);
	$precioTotal = Consta::precioTotal($carrito);
	$entrega =5;


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi pedido</title>
    <link rel="stylesheet" href="css/mipedido.css">
</head>
<body>
    <div id="container">
		<div id="izq">
			<div >
				<a id="seguirComprando"href="main.php">Seguir comprando</a>
			</div>
			<div id="izq--flex">

				<div>Mi pedido</div>
				<div>Información de Contacto
					<input disabled name ="email" id="email" placeholder="<?=$cliente[0]->email?>"type="text">
				</div>
				<div>Direccion de entrega
					<div id="direccion--div">
						<?=$cliente[0]->nombre?></br>
						+34 <?=$cliente[0]->telefono?></br>
						<?=$cliente[0]->direccion?>
						<a id="editarDireccion--btn" href="#" >Editar direccion</a>
					</div>
				</div>
				<div id="editarDireccion--form">
					<form action="editarEntrega.php" method="post">
						<input  type="hidden" name ="id" value="<?=$cliente[0]->id?>">
						<label for="">Editar Dirección</label>
						<input type="text" name="nombre" placeholder="<?=$cliente[0]->nombre?>" >
						<input type="text" name="telefono" placeholder="<?=$cliente[0]->telefono?>">
						<label for="">Detalles de la dirección</label>
						<input id="form--direccion" type="text" name="direccion" placeholder="<?=$cliente[0]->direccion?>"></input>
						<button id="form__btn" class="form__btn" >Guardar cambios</button>
					</form>
						
				</div>
			</div>
		</div>
        <div id="derecha">
            
<div id="carrito">
			<div id="carrito--titulo">
				<h3>Resumen Pedido</h3>
				<a href="#" id="carrito--close__btn"><i  class="fas fa-times"></i></a>
			</div>
			<div id="carrito--productos">
				<?php

				if (empty($carrito)):
				?>
					<h2>LA CESTA ESTA VACIA</h2>
				<?php
				else:
					$i=0;
					while($i < count($carrito)):
				?>
						<div id="c--items">
							<img src="<?=$carrito[$i]->imagen?>" class="c--items__img">
							<p class="c--items__nombre"><?=$carrito[$i]->nombre?></p>
							<p class="c--items__cantidad">Cantidad :<?=$carrito[$i]->cantidad?></p>
							<p class="c--items__precio"><?=$carrito[$i]->precio?>€</p>
						</div>			
				<?php
					$i++;
					endwhile;
				endif;
				?>
			</div>
				
			<div id="carrito--total">
				<p class="total">Subtotal <?=$precioTotal?>€</p></br>
				<p class="precio--total">Entrega  <?=$entrega?>€</p></br>
				<p class="entrega"> Total <?=$precioTotal+$entrega?>€</p></br>
				<a id="total--btn"href="pagado.php?<?php echo "precioTotal={$precioTotal}&idCompra={$idCompra}"?>">Pagar</a>
			</div>	
		</div>
        </div>
    </div>

</body>
<script src="js/mipedido.js" type="text/javascript"></script>
</html>

<?php
?>