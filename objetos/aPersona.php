<?php
    require_once("iPersona.php");
    abstract class aPersona implements iPersona {

        public function __toString()
        {
            return $this->getNombre()." ".$this->getApellido();
        }

    }

    class Persona extends aPersona {
        function __construct(private $nombre,private $apellido) {
        
        }

        public function getNombre () {
            return $this->nombre;
        }

        public function getApellido() {
            return $this->apellido;
        }
    }

    $perso = new Persona("Loco", "lolo");
    echo $perso;
?>