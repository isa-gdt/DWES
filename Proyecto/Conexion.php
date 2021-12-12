<?php

//patron singleton

class Conexion {

    const NOMBREBD = "dm";
    const USER= "root";
    const PASS ="";

    private static ?Conexion $instanciaBD= null;
    private $resultado;
    private $pdo;

    private function __clone(){}

    private function __construct(){
        try{
            $this->pdo = new PDO("mysql:host=localhost;dbname=".self::NOMBREBD, self::USER, self::PASS);
        }catch (PDOException $e){
            die("Error: $e->getMessage()");
        } 
    }

    //metodo para instanciar la clase
    public static function getInstanciaBD(){
        if(self::$instanciaBD==null) self::$instanciaBD = new Conexion;
        return self::$instanciaBD;
    }

    //metodo para hacer consultas
    public function consultaBD (string $sql):Conexion{
        $this->resultado= $this->pdo->query($sql);
        return $this;
    }
    //la consulta se vuelca en un objeto
    public function recuperarBD(string $class = 'StndClass'){
        return $this->resultado->fetchObject($class);
    }

    public function recuperarTodoBD(string $class='StndClass'):array{
        $datos = [];
        while($item=$this->recuperarBD($class))
            array_push($datos,$item);
        
        return $datos;
    }

    public function totalBD():?int{
        return $this->resultado->rowCount();
    }

    //cerrar la conexion
    public function __destruct(){
        $this->pdo=null;
    }


    public function total():?int {
        return $this->resultado->rowCount() ;
    }

    
}
