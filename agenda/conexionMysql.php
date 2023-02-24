<?php

class ConexionMysql {
    private $dsn = "mysql:dbname=docker_demo;host=docker-mysql";
    private $usuario = "root";
    private $password = "root123";
    private $bd;
    private static $instancia;

    public static function getConexion() {
        
        if(!self::$instancia) {
            self::$instancia = new ConexionMysql();
        }

        return self::$instancia->bd;
    }

    private function __construct() {
        
        try {
            $this->bd = new PDO($this->dsn, $this->usuario, $this->password);
        }catch (Exception $e) {
            return $e->getMessage();
        }
        
    }

    public function getBd() {
        return $this->bd;
    }
 
}
     
?>