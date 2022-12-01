<?php
    class Envio {
        private $asunto;
        private $cuerpo;
        private $origen;

        public function __construct($asunto, $cuerpo, $origen) {
            $this->asunto = $asunto;
            $this->cuerpo = $cuerpo;
            $this->origen = $origen;
        }


        /**
         * Get the value of asunto
         */
        public function getAsunto()
        {
                return $this->asunto;
        }


        /**
         * Get the value of cuerpo
         */
        public function getCuerpo()
        {
                return $this->cuerpo;
        }


        /**
         * Get the value of origen
         */
        public function getOrigen()
        {
                return $this->origen;
        }
    }
?>