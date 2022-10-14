<?php
    class Rueda {
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

        public function desinflar() {
            $this->setEstado(false);
        }

        public function inflar() {
            $this->setEstado(true);
        }

        public function __toString() {
            $estado = "Desinflada";
            if ($this->estado) {
                $estado = "Inflada";
            }
            return "Estado de la Rueda: ".$estado;
        }
    }
?>