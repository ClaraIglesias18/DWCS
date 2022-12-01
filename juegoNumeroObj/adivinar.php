<?php
    class Adivinar {
        private $valorNumero;
        private $intenos;
        private $mensaje;

        public function __construct(){
            $this->iniciarJuego();
        }

        public function iniciarJuego() {
            $this->valorNumero = rand(0-100);
            $this->intentos = 5;
            $this->mensaje = "Introduce un numero";
        }

        public function __sleep()  {
            return array('valorNumero', 'intentos', 'mensaje');
        }

        public function __wakeup() {
            
        }

        function jugarNumero($numero) {
            if($numero == $this->valorNumero) {
                $this->mensaje
            }
        }

    }
?>