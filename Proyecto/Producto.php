<?php

require_once "Conexion.php";

class Producto {

    private $cod_prod;
    private $nombre;
    private $descripcion;
    private $precio;
    private $valoracion;
    private $imagen;
    private $categoria;
    private $cantidad;
    private $stock;


    public function __get($key){
        
        if(property_exists("Producto",$key)) return $this->$key;
        throw new Exception;
    }


    public function __set($key, $value){

        switch ($key){
            case "cod_prod":
            case "nombre":
            case "descripcion":
            case "precio":
            case "valoracion":
            case "imagen":
            case "categoria": 
            case "cantidad": 
            case "stock": $this->$key = $value;
                break;
            default:
                throw new Exception;
        }
    }

    //recuperar los productos
       public static function recuperarProductos():array{
           $db=Conexion::getInstanciaBD();
           $sql= "SELECT * FROM producto;";
           $db->consultaBD($sql);
          return $db->recuperarTodoBD("Producto");
      }

          //recuperar los productos
          public static function recuperarProductosID($id):array{
            $db=Conexion::getInstanciaBD();
            $sql= "SELECT * FROM producto WHERE cod_prod=$id;";
            $db->consultaBD($sql);
           return $db->recuperarTodoBD("Producto");
       }

       public static function ordenarProductos($busqueda):array{
            $db=Conexion::getInstanciaBD();
            switch($busqueda){
			    case ("valoracion"):
                    $sql= "SELECT * FROM producto ORDER BY valoracion DESC ;";
                    break;
                case ("nombre"):
                    $sql= "SELECT * FROM producto ORDER BY nombre ;";
                    break;
                case ("precioASC"):
                    $sql= "SELECT * FROM producto ORDER BY precio ASC ;";
                    break;
                case ("precioDESC"):
                    $sql= "SELECT * FROM producto ORDER BY precio DESC ;";
                    break;
                default:
                $sql= "SELECT * FROM producto;";
		    }
            $db->consultaBD($sql);
            return $db->recuperarTodoBD("Producto");
       }

       public static function actualizarStock($nuevoStock, $idProducto){
        $db = Conexion::getInstanciaBD();
        $actualizar = $db->consultaBD(("UPDATE producto SET stock = $nuevoStock WHERE cod_prod = $idProducto"));
       }




    //funcion que buscara los productos en base al tipo de categoria

    // public static function buscarPorCategoria($categoria):?Producto{
    //     $db = Conexion:: getInstanciaBD();
    //     $db->consultaBD("SELECT * FROM producto WHERE categoria=$categoria;");
    //     return $bd->recuperarTodoBD("Producto");
    // }


    public static function contarProductos():int{
        $db = Conexion::getInstanciaBD() ;
        return $db->consultaBD("SELECT * FROM producto;")
                  ->total() ;
    }


}