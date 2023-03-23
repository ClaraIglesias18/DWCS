<?php
require_once('vendor/autoload.php');

class ConexionMongo
{

    private static $instancia;

    private function __construct()
    {
    }

    public static function getConexion()
    {
        if (!isset(self::$instancia)) {

            $host = "mongo";
            $puerto = "27017";
            $usuario = rawurldecode("root");
            $password = rawurldecode("example");

            $urlConexion = sprintf("mongodb://%s:%s@%s:%s/", $usuario, $password, $host, $puerto);
            $cliente = new MongoDB\Client($urlConexion);


            self::$instancia = $cliente->agenda;
        }

        return self::$instancia;
    }
}
