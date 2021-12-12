<?php


$nombre= $_POST["usuario"]??"";
$pass= $_POST["password"]??"";
$email= $_POST["email"]??"";
$telefono=$_POST["telefono"]??"";
$direccion= $_POST["direccion"]??"";


require_once('Cliente.php');
if ($nombre!="" and $pass!==""){
    $registro = Cliente::registrar(0,$nombre,md5($pass), $email, $telefono, $direccion);
    ?> 
    <div> 
        <p>"Usuario Registrado Correctamente" </p>
        <a href="Index.php">Volver</a>
    </div>
<?php
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="./css/registro.css">


</head>
<body>
    <form id="form" method="POST">
        <label class="form__label--titulo" for="titulo">REGISTRO</label></br>
        <label class="form__label" for="usuario"><strong>Nombre: </strong></label>
        <input class="form__input"type="text" name="usuario" required /><br/>
        <label class="form__label" for="password"><strong>Contraseña:</strong></label>
        <input class="form__input" type="password" name="password" required><br/>
        <label class="form__label" for="email"><strong>Email: </strong></label>
        <input class="form__input"type="email" name="email" required /><br/>
        <label class="form__label" for="telefono"><strong>Teléfono: </strong></label>
        <input class="form__input"type="telefono" name="telefono" required /><br/>
        <label class="form__label" for="direccion"><strong>Dirección: </strong></label>
        <input class="form__input"type="textarea" name="direccion" required /><br/>
        <button class="form__btn">Enviar</button>
    </form>
</body>
</html>