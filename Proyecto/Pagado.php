<?php
require_once ("Tiempo.php");
require_once("compra.php");
require_once("consta.php");
require_once("producto.php");

//variables desde url
$precioConsta= $_GET["precioTotal"];
$idCompra= $_GET["idCompra"];

//solo si hay cosas en el carrito
if ($precioConsta !=0) {

    //Método para generar codigo aleatorio
    function CodigoAleatorio($length = 10) { 
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length); 
    } 
    //numero aleatorio
    $premio= rand(1,10);
    $codRandom= CodigoAleatorio();



    // var_dump($compra);

    $carrito = Consta::mostrarCarrito($idCompra);

    $recuperarCompra= Compra::recuperarCompraCod($idCompra);

    $actualizarPrecio = Compra::actualizarPrecio($precioConsta, $idCompra);


    $consta = Consta::recuperarConsta($idCompra);
    foreach($consta as $key =>$value){
        //sacar el codigo de los prod de consta para recuperarlos de la tabla productos
        $idProd= $value->cod_prod;
        $compra = Producto::recuperarProductosID($idProd);
        //cantidad de cada producto en la tabla consta
        $cantidadConsta = $value->cantidad;
        //cantidad de stock de cada uno de esos productos en la tabla producto
        $stockProducto= $compra[0]->stock;
        //si el stock que hay es mayor que 0 y que lo que se quiere comprar(lo que hay en consta)
        if ($stockProducto>0 and $stockProducto>$cantidadConsta){
            //restar la cantidad original con la cantidad que hay en consta
            $nuevoStock = $stockProducto - $cantidadConsta;   
            //actualizar la tabla producto con el nuevo stock
            Producto::actualizarStock($nuevoStock, $idProd);  
        } else {
            header("Location:Mipedido.php");
        }
    }


    $borrar = Consta::borrarConsta($recuperarCompra[0]->id_compra);
    // header("Location:final.php");

    //insertar codRandom y premio en compra
    Compra::codRandomyPremio($codRandom, $premio, $recuperarCompra[0]->id_compra);

    ?>


    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Final</title>
        <link rel="stylesheet" href="./css/pagado.css">
    </head>
    <body>
        <div id="container">
        <h2>Compra realizada!</h2>
        <h4>En breve recibiras un email con la confirmación de tu compra y los detalles del envío</h4>

        <p id="codigo">Este es tu código de compra: <?=$codRandom ?></p>

        <!-- <p>numero aleatorio: </p> -->
        <!-- <?= $premio?> -->

        <a id="volver" href="main.php">Volver</a>
        </div>
    </body>
    </html>

    <?php

} else{
    header("Location:Mipedido.php");
}