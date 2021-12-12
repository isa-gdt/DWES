<?php

require_once("Cliente.php");

$id=$_POST["id"]??"";
$nombre=$_POST["nombre"]??"";
$telefono =$_POST["telefono"]??"";
$direccion=$_POST["direccion"]??"";

// var_dump($nombre);
// var_dump($id);

if ($nombre!="")$nuevoCliente=Cliente::editarNombre($nombre, $id);

if($telefono!="")Cliente::editarTelefono($telefono, $id);

if($direccion!="")Cliente::editardireccion($direccion,$id);


header("Location:mipedido.php");


?>