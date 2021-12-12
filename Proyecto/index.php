<?php
session_start();
// traer del formulario el usuario y la contraseña
$nombre= $_POST["usuario"]??"";
$pass = $_POST["password"]??"";

require_once("Compra.php");

require_once("Sesion.php");
    //si existen nombre y contraseña
    if($nombre!="" and $pass!==""){
       //crear instancia de sesion
       $sesion = Sesion::instanciaSesion();      
       //si el nombre y la contrasña no coinciden con el de la BD, mensaje de error
       if(!$sesion->login($nombre, md5($pass))){
           $error= "vaya, parece que tu usuario o contraseña no son correctos.";          
       }
   }

//control de sesiones, si la sesion está iniciada, mandar al main
 if(isset($_SESSION["user"])){
     header("Location: main.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
<!-- PRINCIPAL -->

<div id="container">
    <!-- NAV -->
   <div id="nav" class="item">

 <!-- Texto amarillo  -->
    <div id="texto--amarillo">
		<p>¡El envío gratis ha vuelto para todas las compras superiores a 50€! Compra ahora y paga a plazos. <a href="comingsoon.php">Informate</a></p>
	</div>

    <!--  logo y búsqueda -->
   <div id="logo">
			<a href="index.php"><img class="logo--img"src="img/logo.png" alt=""> </a>
			</div>		
   </div>

   <!-- MAIN -->
   <div id="main" class="item">
       <div id="main--texto">
            <p id="main--texto__p">Limitless paper in a paperless world</p>
            <button id="main--texto__btn">Comprar</button>
       </div>
   </div>



   <!-- fORMULARIO -->
   <div id="formulario">
    <form id="form"  method="POST" >
            <label class="form__label--titulo" for="titulo">¡Hola!</label></br>
            <label class= "form__label" for="usuario"><strong>Usuario: </strong></label>
            <input class= "form__input"type="text" name="usuario" required /><br/>
            <label class= "form__label pass" for="password"><strong>Contraseña:</strong></label>
            <input class="form__input" type="password" name="password" required><br/>
            <!--<input type="radio" name="tipo" required> Particular
            <input type="radio" name="tipo" required> Empresa-->
            <p class="form__text">¿No estas registrado?<a href="registro.php" class="form__text--reg">¡Regístrate ahora!</a></p>
            <button class="form__btn">Enviar</button>
        </form>
   </div>

   <?php
   require_once("footer.php");
   ?>

</div>

    <?php

     if (isset($error)): ?>
        <script>
            document.getElementById("main--texto__p").innerHTML = "<?php echo $error ?>";
        </script>

    <?php endif ; ?>
    <script src="js/index.js"></script>
</body>
</html>