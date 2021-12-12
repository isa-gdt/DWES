<?php

require_once("Tiempo.php"); 
require_once("Compra.php");

$codigo = $_POST["codigo"]??"";

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Golden Ticket</title>
    <link rel="stylesheet" href="./css/GTicket.css">
</head>
<body>
    <form method="POST">
        <label for="">Introduce tu código de compra</label></br>
        <input class="input" type="text" name="codigo"></br>
        <button  type="submit">Comprueba si has ganado!</button></br>
    </form>

    <?php

    if($codigo!=""){
        if((strlen($codigo)>10)){
            print "codigo no válido";
        } else{
            $compra= Compra::recuperarPorCodigoRandom($codigo);
            if(!$compra){
                print "No se encontró tu código, inténtalo de nuevo";
            } else{
                $premio= $compra[0]->premio;
                if ($premio!=1){
                    ?>
                    <div id="noPremio" style="display:block">
                        <img src="https://areajugones.sport.es/wp-content/uploads/2020/03/steve-carell-the-office.jpg" alt="">
                        <p>Lo sentimos, no has tenido suerte esta vez.</p></br>
                        <a id="volver" href="Main.php">Volver</a>
                    </div>
                    <?php
                } else{
                    ?>
                    <div id="premio" style="display:block">
                    <p>¡¡¡Enhorabuena!!!</p></br>
                    <p>Has ganado el GOLDEN TICKET</p>
                    <img src="https://c.tenor.com/j5uPfkaOQ98AAAAM/steve-carell-wow.gif" alt="">    </br>  
                    <a id="volver" href="Main.php">Volver</a>       
                    </div>
                    <?php

                }
            }
           
        }
    }

    ?>
    
   
</body>
</html>