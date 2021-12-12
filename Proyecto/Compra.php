<?php 

require_once "Conexion.php";


class Compra {
    
    private $id_compra;
    private $id_cliente;
    private $fecha;
    private $importe;
    private $codigo_random;
    private $premio;

    public function __get($key){
        
        if(property_exists("Compra",$key)) return $this->$key;
        throw new Exception;
    }

    //recuperar la compra
    public static function recuperarCompra():array{
        $db=Conexion::getInstanciaBD();
        $sql= "SELECT * FROM compra;";
        $db->consultaBD($sql);
       return $db->recuperarTodoBD("Compra");
   }

    public static function recuperarCompraID($idCliente):array{
        $db=Conexion::getInstanciaBD();
        $sql= "SELECT * FROM compra WHERE id_cliente =$idCliente;";
        $db->consultaBD($sql);
        return $db->recuperarTodoBD("Compra");
    }

    public static function recuperarCompraCod($codCompra):array{
        $db=Conexion::getInstanciaBD();
        $sql= "SELECT * FROM compra WHERE id_compra =$codCompra;";
        $db->consultaBD($sql);
        return $db->recuperarTodoBD("Compra");
    }

    public static function registrarCompra($idCliente){
        $db = Conexion::getInstanciaBD();
        $array=[];
        $compra = Compra::recuperarCompra();
        $idCompra = $compra[0]->id_compra;
        
        if(!$compra){
            $insertar = $db->consultaBD("INSERT INTO `compra` VALUES (0, '$idCliente','28-11-2021', 0);");  
        } else{
            foreach($compra as $key => $value){
                array_push($array, $value->id_cliente);
                // var_dump($array);
            }
            if (!in_array($idCliente, $array))
                $insertar = $db->consultaBD("INSERT INTO `compra` VALUES (0, '$idCliente','28-11-2021', 0);");                 

        }
    }

    public static function actualizarPrecio($precioTotal, $idCompra){
        $db = Conexion::getInstanciaBD();
        $actualizar = $db->consultaBD(("UPDATE compra SET importe = $precioTotal WHERE id_compra = $idCompra"));
    }

    public static function codRandomyPremio($CodRandom, $premio, $idCompra){
        $db = Conexion::getInstanciaBD();
        $actualizar = $db->consultaBD(("UPDATE compra SET codigo_random = '$CodRandom', premio='$premio' WHERE id_compra = $idCompra"));
    }

    public static function recuperarPorCodigoRandom($codRandom):array{
        $db=Conexion::getInstanciaBD();
        $sql= "SELECT * FROM compra WHERE codigo_random = '$codRandom';";
        $db->consultaBD($sql);
        return $db->recuperarTodoBD("Compra");
    }

   

}