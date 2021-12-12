<?php
session_start();
 // Comprobamos si hay sesión iniciada. Si no la hay,
// redirigimos a la página principal.
if (!isset($_SESSION["user"]))
    header("Location:Index.php") ;

//control del tiempo de sesion
$inactivo = 1800;
 
if(isset($_SESSION['tiempo']) ) {
    $vida_session = time() - $_SESSION['tiempo'];
    if($vida_session > $inactivo)
    {
        session_destroy();
        header("Location:Logout.php"); 
    }
}
?>