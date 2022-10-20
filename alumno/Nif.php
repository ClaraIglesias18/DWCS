<?php
    class Nif {
        private $numero;
        private $letra = " ";
        private const letras = "TRWAGMYFPDXBNJZSQVHLCKE";

        public function __construct($numero = 0) {
            $this->setNumero($numero);
        }

        public function getNumero() {
            return $this->numero."-".$this->letra;
        }

        public function setNumero($numero){

            //calcular letra si la entrada solo es numerica
            //si no calcular la letra quitando la introducida al numero
            if(ctype_digit($numero)) {
                $this->numero = $numero;
                if($numero != 0) {
                    $this->letra = $this->calcularLetra($numero);
                }
            } else{
                $letraEntrada = substr($numero, -1);
                $numEntrada = str_replace($letraEntrada, "", $numero);

                $this->numero = $numEntrada;
                $this->letra = $this->calcularLetra($numEntrada);
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

        public function validarLetra($letraEntrada) {
            $letraEntrada == $this->letra;
        }

        public function getLetra(){
            return $this->letra;
        }

        public function __toString() {
            return $this->numero.$this->letra;
        }
        
    }
?>