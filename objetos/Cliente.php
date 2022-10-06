<?php
    require_once("Persona.php");
    class Cliente extends Persona {
        private $saldo;

        function __construct($dni, $nombre, $apellido, $saldo){
            parent::__construct($dni, $nombre, $apellido);

            $this->saldo = $saldo;
            
        }

        public function getSaldo() {
            return $this->saldo;
        }

        public function setSaldo($saldo) {

            $this->saldo = $saldo;

            return $this;

        }


        public function __toString()
        {
            return "Cliente: ". $this->saldo." ".parent::__toString();
        }
    }

    $cli = new Cliente("33333E", "super", "man", 30000);
    echo $cli;
?>