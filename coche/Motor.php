<?php
    class Motor {
        
        private $estado;

        public function __construct()  {
            $this->estado = false;
        }
        
        public function getEstado() {
            return $this->estado;
        }

        public function setEstado($estado) {
            $this->estado = $estado;
            return $this;
        }

        public function apagar() {
            $this->setEstado(false);
        }

        public function encender() {
            $this->setEstado(true);
        }

        public function __toString() {
            $estado = "Apagado";
            if ($this->estado) {
                $estado = "Encendido";
            }
            return "Estado del motor: ".$estado;
        }

    }
?>