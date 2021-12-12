<?php

include_once('Cliente.php');
include_once('Compra.php');

class Sesion {


    private static ?Sesion $instanciaSesion= null;


    private function __clone(){}

    private function __construct(){}

    public static function instanciaSesion(){
        if(self::$instanciaSesion==null)self::$instanciaSesion= new Sesion;
        return self::$instanciaSesion;
    }

    //metodo para loguear


    public function login(string $nombre, string $pass):bool {
        //variable con el metodo de cliente
        $cliente = Cliente::UseryPass($nombre, $pass);
        // var_dump ($cliente);
        //si la var no es nula, es decir, si devuelve obj tipo cliente
        if(!is_null($cliente)){
            //se inicia la sesion
            session_start();
            //el usuario de la sesion sera el objeto cliente (serializado:string)
             $_SESSION["user"]= $cliente->id;
             $_SESSION["time"]= time();
            //crear carrito de compra
             $registro = Compra::registrarCompra($cliente->id);          
            //despues de iniciar sesion, se redirige a main            
            header("Location:main.php");
            die();
        }
        return false;
    }
}