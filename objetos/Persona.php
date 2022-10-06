<?php
    class Persona {
        private $dni;
        private $nombre;
        private $apellido;

        function __construct($dni, $nombre, $apellido) {
            $this->dni = $dni;
            $this->nombre = $nombre;
            $this->apellido = $apellido;
        }



        public function setNombre($nombre) {
            $this->nombre = $nombre;
            
            return $this;
        }

        public function __toString() {
            return "Persona: " .$this->dni." - ".$this->nombre." ".$this->apellido;
        }

    }

    //$persona = new Persona("111111E", "Pepe", "Gotera Lopez");
    //echo $persona
?>