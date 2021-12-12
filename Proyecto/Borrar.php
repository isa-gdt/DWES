<?php
//iniciar sesion
session_start();

require_once("Consta.php");

//BORRAR DE CARRITO
	$codProd = $_GET["codProd"]??"";
	$borrar = Consta::borrarItem($codProd);
    header("Location:main.php");
    ?>