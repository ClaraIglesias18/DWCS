<?php
    class Punto {
        private $x;
        private $y;

        public function __construct($x, $y) {
            $this->x = $x;
            $this->y = $y;
        }

        public function getX() {
            return $this->x;
        }

        public function setX($x)
        {
            $this->x = $x;

            return $this;
        }

        public function getY(){
            return $this->y;
        }

        public function setY($y) {
                $this->y = $y;

                return $this;
        }

        public function __toString()
        {
            return "(".$this->x.",".$this->y.")";
        }
    }
?>