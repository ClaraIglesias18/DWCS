<?php
    class Cuenta {
        private $titular;
        private $cantidad;

        function __construct($titular) {
            $this->titular = $titular;
        }

        public function getTitular() {
                return $this->titular;
        }

        public function setTitular($titular) {
                $this->titular = $titular;

                return $this;
        }

        public function getCantidad() {
                return $this->cantidad;
        }

        public function setCantidad($cantidad) {
                $this->cantidad = $cantidad;

                return $this;
        }

        public function retirar($cantidad) {
            if($cantidad > $this->cantidad) {
                $this->cantidad = 0;
            } else if($cantidad < 0) {
                echo "No puedes retirar valores negativos";
            } else {
                $this->cantidad -= $cantidad;
            }
        }

        public function ingresar($cantidad) {
            if($cantidad >= 0) {
                $this->cantidad += $cantidad;
            } else {
                echo "No puedes ingresar valores negativos";
            }
        }

        public function __toString()
        {
            return $this->getTitular()." ".$this->getCantidad();
        }
    }

    $cuenta1 = new Cuenta("Clara");

    $cuenta1->ingresar(3000);

    echo $cuenta1."\n";

    $cuenta1->retirar(2000);

    echo $cuenta1;

?>
