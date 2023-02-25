<?php

class ConexionMysql {

    private static $instancia;

    private function __construct(){

    }

    public static function getConexion() {
        if (!isset(self::$instancia)) {
            
            $dsn = "mysql:dbname=agenda;host=docker-mysql";
            $usuario ="root";
            $password = "root123";

            self::$instancia = new PDO($dsn, $usuario, $password);
            self::$instancia->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        
        return self::$instancia;
    }
 
}
     
?>