<?php
    require_once("Persona.php");
    class Cliente extends Persona {
        private $saldo;

        function __construct($dni, $nombre, $apellido, $saldo){
            parent::__construct($dni, $nombre, $apellido);

            $this->saldo = $saldo;
            
        }


        public function __toString()
        {
            return "Cliente: ". $this->saldo." ".parent::__toString();
        }

        /**
         * Get the value of saldo
         */
        public function getSaldo()
        {
                return $this->saldo;
        }

        /**
         * Set the value of saldo
         */
        public function setSaldo($saldo): self
        {
                $this->saldo = $saldo;

                return $this;
        }
    }

    $cli = new Cliente("33333E", "super", "man", 30000);
    echo $cli;
?>