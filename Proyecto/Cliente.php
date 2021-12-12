<?php

require_once('Conexion.php');

class Cliente {

    private $id;
    private $nombre;
    private $pass;
    private $email;
    private $telefono;
    private $direccion;

    

    public function __get($key){
        
        if(property_exists("Cliente",$key)) return $this->$key;
        throw new Exception;
    }


    //metodo para buscar por usuario y contraseña

    public static function UseryPass(string $nombre, string $pass):?Cliente {
        //instanciar la BD
        $db = Conexion::getInstanciaBD();
        //metodo consulta para seleccionar todos los clientes donde nombre y pass sean como los parámetros
        $cliente= $db->consultaBD("SELECT * FROM cliente WHERE nombre='$nombre' and pass='$pass';")->totalBD();
        //si la consulta devuelve alguna final (total()), se recupera en forma de obj de clase usuario,sino, devuelve null
        return ($cliente)?$db->recuperarBD('Cliente'):null;
    }

    //insertar en la BD al registrar

    public static function registrar(int $id, string $nombre, string $pass, string $email, $tlf, string $direccion){
        $db = Conexion::getInstanciaBD();
        $insertar = $db->consultaBD("INSERT INTO `cliente` VALUES ('', '$nombre', '$pass', '$email', '$tlf', '$direccion');");
    }

    public static function mostrarCliente($idCliente):array{
        $db=Conexion::getInstanciaBD();
        $sql= "SELECT * FROM cliente WHERE id=$idCliente;";
        $db->consultaBD($sql);
       return $db->recuperarTodoBD("Cliente");
    }

    public static function editarNombre($nombre, $id){
        $db = Conexion::getInstanciaBD();
        $actualizar = $db->consultaBD("UPDATE cliente SET nombre= '$nombre' WHERE id=$id;");
    }

    public static function editarTelefono($telefono, $id){
        $db = Conexion::getInstanciaBD();
        $actualizar = $db->consultaBD("UPDATE cliente SET telefono = '$telefono' WHERE id=$id;");
    }

    public static function editarEmail($email, $id){
        $db = Conexion::getInstanciaBD();
        $actualizar = $db->consultaBD(("UPDATE cliente SET email = '$email' WHERE id=$id;"));
    }

    public static function editarDireccion($direccion, $id){
        $db = Conexion::getInstanciaBD();
        $actualizar = $db->consultaBD(("UPDATE cliente SET direccion = '$direccion' WHERE id=$id;"));
    }

}