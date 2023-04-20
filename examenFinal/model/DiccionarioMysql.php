<?php
require_once('ConexionDB.php');
require_once('Diccionario.php');

class DiccionarioMysql extends Diccionario {

    public static function creaDB() {
        $db = ConexionDB::getConexion();
        $sql = file_get_contents('db/wordle.sql');

        $db->exec($sql);
    }

    public static function getAll() {
        $sql = "SELECT * FROM palabra";
        $stm = ConexionDB::getConexion()->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_OBJ);
        $palabras = [];

        foreach ($result as $palabra) {
            $palabras[$palabra->idPalabra] = new Self(
                $palabra->idPalabra,
                $palabra->palabra
            );
        }

        return $palabras;
    }

    public function getById($idPalabra) {
        $sql = "SELECT * from palabra where idPalabra = ?";
        $stm = ConexionDB::getConexion()->prepare($sql);
        $stm->execute([$idPalabra]);
        $result = $stm->fetchAll(PDO::FETCH_OBJ)[0];
        $palabra = new self(
            $result->idPalabra,
            $result->palabra
        );

        return $palabra;
    }

    public function seleccionPalabra() {
        $palabras = $this->getAll();
        
        $nPalabras = count($palabras);

        $idRandom = random_int(1, $nPalabras);
        
        $palabraRandom = $this->getById($idRandom);

        return $palabraRandom;

    }

}