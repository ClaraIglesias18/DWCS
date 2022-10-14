<?php
    class Ventana {
        private $estado;

        public function __construct() {
            $this->estado = false;
        }

        public function getEstado(){
            return $this->estado;
        }

        public function setEstado($estado) {
            $this->estado = $estado;

            return $this;
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
            return "Estado de la ventana: ".$estado;
        }
    }
?>