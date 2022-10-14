<?php
    include_once("Ventana.php");
    class Puerta {
        private $estado;
        private Ventana $ventanaPuerta; 

        public function __construct() {
            $this->estado = false;
            $this->ventanaPuerta = new Ventana;
        }

        public function getEstado() {
            return $this->estado;
        }

        public function setEstado($estado) {
            $this->estado = $estado;

            return $this;
        }

        public function getVentanaPuerta() {
            return $this->ventanaPuerta;
        }

        public function cerrar() {
            $this->setEstado(false);
        }

        public function abrir() {
            $this->setEstado(true);
        }

        public function __toString() {
            $estado = "Cerrada";
            if ($this->estado) {
                $estado = "Abierta";
            }
            return "Estado de la puerta: ".$estado." , ".$this->ventanaPuerta;
        }

    }
?>