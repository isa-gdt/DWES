<?php

require_once('Conexion.php');
require_once('Producto.php');


class Consta {

    private $cod_prod;
    private $cod_compra;
    private $cantidad;


    public function __get($key){
        
        if(property_exists("Consta",$key)) return $this->$key;
        throw new Exception;
    }

    public function __set($key, $value){

        switch ($key){
            case "cod_prod":
            case "cod_compra":
            case "cantidad": $this->$key = $value;
                break;
            default:
                throw new Exception;
        }
    }

    //insertar en consta
    public static function insertar(int $codProd, int $codCompra, int $cantidad){
        $db = Conexion::getInstanciaBD();
        $sql = "INSERT INTO `consta` VALUES ('$codProd','$codCompra','$cantidad');";
        $db->consultaBD($sql);
    }

    //recuperar los productos
    public static function recuperarConsta($idCompra):array{
        $db=Conexion::getInstanciaBD();
        $sql= "SELECT * FROM consta WHERE cod_compra = $idCompra;";
        $db->consultaBD($sql);
       return $db->recuperarTodoBD("Consta");
   }

   public static function mostrarCarrito($idCompra):array{
    $db=Conexion::getInstanciaBD();
    $sql= "SELECT p.cod_prod, nombre, descripcion, precio, valoracion, imagen, categoria, cantidad, stock FROM producto P JOIN consta C ON P.cod_prod = C.cod_prod WHERE cod_compra = $idCompra;";
    $db->consultaBD($sql);
    return $db->recuperarTodoBD("Producto");
    
   }

   public static function borrarItem($codProd){
    $db=Conexion::getInstanciaBD();
    $sql="DELETE FROM consta WHERE cod_prod = $codProd";
    $db->consultaBD($sql);
   }

   public static function aumentarCantidad($codProd){
    $db = Conexion:: getInstanciaBD();
    $db->consultaBD("UPDATE consta SET cantidad = cantidad+1  WHERE cod_prod=$codProd;");   
    }
   

    public static function precioTotal($carrito):?float{
        //iniciar variable precio total
		$precio=0;
		$precioTotal=0;
		//recorrer carrito para sacar el precio			
		foreach($carrito as $key => $value){
			//multiplicar el precio por la cantidad
			$precio = floatval($value->precio)*floatval($value->cantidad);
			$precioTotal = $precioTotal + $precio;            
		}
        return $precioTotal;
    }

    public static function borrarConsta($idCompra){
        $db = Conexion:: getInstanciaBD();
        $db->consultaBD("DELETE FROM consta WHERE cod_compra=$idCompra;");   
    }


}
?>