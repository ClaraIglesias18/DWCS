<?php
    include_once("Nif.php");
    class Alumno {
        private $nombre;
        private $nif;
        private $apellidos;
        private $sexos = array("Hombre", "Mujer", "Otro");
        private $sexo;

        public function __construct($nombre, $apellidos, $sexo, $nif) {
            $this->nombre = $nombre;
            $this->apellidos = $apellidos;
            if(ctype_digit($nif)) {
                $this->nif = new Nif($nif);
            } else {
                $this->nif = $nif;    
            }
            $this->sexo = $this->sexos[array_search($sexo, $this->sexos)];
        }

        public function __toString() {
            return "<br>"."Nombre: ".$this->nombre
                ."<br>"."Apellidos: ".$this->apellidos
                ."<br>"."\nSexo: ".$this->sexo
                ."<br>"."\nNIF: ".$this->nif;
        }

        

    }
?>