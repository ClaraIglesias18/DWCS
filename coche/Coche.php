<?php
    include_once("Puerta.php");
    include_once("Rueda.php");
    include_once("Motor.php");
    class Coche {
        private $nombre;
        private $motor;
        private $ruedas = array();
        private $puertas = array();

        public function __construct($nombre) {
            $this->nombre = $nombre;
            $this->motor = new Motor();
            $this->ruedas = array("rueda1" => new Rueda(),
                                "rueda2" => new Rueda(),
                                "rueda3" => new Rueda(),
                                "rueda4" => new Rueda());
            $this->puertas = array("puerta1" => new Puerta(),
                                "puerta2" => new Puerta());
        }

        public function getNombre(){
            return $this->nombre;
        }

        public function setNombre($nombre){
            $this->nombre = $nombre;

            return $this;
        }

        public function getRueda($rueda) {
            return $this->ruedas[$rueda];
        }

        public function getPuerta($puerta) {
            return $this->puertas[$puerta];
        }

        public function encenderMotor() {
            $this->motor->encender();
        }

        public function apagarMotor() {
            $this->motor->apagar();
        }

        public function abrirPuerta($puerta) {
            $this->getPuerta($puerta)->abrir();
        }

        public function cerrarPuerta($puerta) {
            $this->getPuerta($puerta)->cerrar();
        }

        public function inflarRueda($rueda) {
            $this->getRueda($rueda)->inflar();
        }

        public function desinflarRueda($rueda) {
            $this->getRueda($rueda)->desinflar();
        }

        public function abrirVentana($puerta) {
            $this->getPuerta($puerta)->getVentanaPuerta()->abrir();
        }

        public function cerrarVentana($puerta) {
            $this->getPuerta($puerta)->getVentanaPuerta()->cerrar();
        }

        public function __toString() {
            return "Nombre del coche: ".$this->nombre
                    ."\n".$this->motor
                    ."\n".print_r(array_values($this->puertas))
                    ."\n".print_r($this->ruedas);
        }

    }
    
?>