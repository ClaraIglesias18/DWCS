<?php
    class Nif {
        private $numero;
        private $letra;
        private const letras = "TRWAGMYFPDXBNJZSQVHLCKE";

        public function __construct($numero = 0) {

            $this->setNumero($numero);
            
        }

        public function getNumero() {

            return $this->numero."-".$this->letra;
        
        }

        public function setNumero($numero){

            $this->numero = $numero; 
            
            if($numero != 0) {
                $this->letra = $this->calcularLetra($numero);
            } else {
                $this->letra = " ";
            }
        
        }

        public function calcularLetra($numero) {

            $numeroLetra = ($numero % 23); 

            $letraNif = Nif::letras[$numeroLetra];

            return $letraNif;

        }

        public function leer() {

            $this->setNumero(readline("Introduzca el numero de NIF: "));

        }
        
        public function mostrar() {
            return $this->numero."-".$this->letra;
        }

        
    }
?>