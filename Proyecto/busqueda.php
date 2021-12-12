<?php

require_once("producto.php");
require_once "Conexion.php";
$busqueda = $_POST["opcionesBusqueda"];

if ($busqueda!=""){
    var_dump($busqueda);
    $productos = Producto::ordenarProductos($busqueda);
} else {
    $productos = Producto::recuperarProductos();
}


?>