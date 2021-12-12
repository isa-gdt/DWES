<?php
//iniciar sesion
session_start();
//conexion BD
require_once ("Producto.php");
require_once("Consta.php");
require_once("Compra.php");

//traer id del producto
$idProd = $_GET["idProd"]??"";

/**si el id no está ya en la lista, añadirlo, si está, subir la cantidad, pero que NO se cree cada vez que entras en la pgn */

//recuperar compra
$compra= Compra::recuperarCompraID($_SESSION["user"]);;
//coger id de compra
$idCompra= $compra[0]->id_compra;
//
$consta = Consta::recuperarConsta($idCompra);

//si consta esta vacio se añade el producto al carrito
// var_dump($consta);
$array=[];
if(!$consta){
  $carrito= Consta::insertar($idProd, $idCompra, 1);
  header("Location:main.php");
}else{
  //meter todos los codProd que esten en consta en un array
  foreach($consta as $key => $value){
    array_push($array, $value->cod_prod);
  }
  //si el cod del producto ya está en el array se aumenta su cantidad y sino, se añade a la tabla
  (in_array($idProd, $array))?$cantidad=Consta::aumentarCantidad($idProd):$carrito= Consta::insertar($idProd, $idCompra, 1);

  header("Location:main.php");

}

