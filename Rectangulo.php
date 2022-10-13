<?php

    include_once("Punto.php");
    
    class Rectangulo {

        private Punto $punto1;
        private Punto $punto2;
        private Punto $punto3;
        private Punto $punto4;        

        public function __construct($punto1x, $punto1y, $punto2x, $punto2y, $punto3x, $punto3y, $punto4x, $punto4y) {
            $this->punto1 = new Punto($punto1x, $punto1y);
            $this->punto2 = new Punto($punto2x, $punto2y);
            $this->punto3 = new Punto($punto3x, $punto3y);
            $this->punto4 = new Punto($punto4x, $punto4y);

        }

        public function getPunto1()
        {
                return $this->punto1;
        }

        public function setPunto1(Punto $punto1)
        {
                $this->punto1 = $punto1;

                return $this;
        }

        public function getPunto2()
        {
                return $this->punto2;
        }

        public function setPunto2(Punto $punto2)
        {
                $this->punto2 = $punto2;

                return $this;
        }

        public function getPunto3()
        {
                return $this->punto3;
        }

        public function setPunto3(Punto $punto3)
        {
                $this->punto3 = $punto3;

                return $this;
        }

        public function getPunto4()
        {
                return $this->punto4;
        }

        public function setPunto4(Punto $punto4)
        {
                $this->punto4 = $punto4;

                return $this;
        }

        public function calcularSup() {
            $base = ($this->punto2->getx()) - ($this->punto1->getX());
            $altura = ($this->punto3->gety()) - ($this->punto1->getY());

            $superficie = $base * $altura;

            return $superficie;
            
        }

        public function mover($moverx=0, $movery=0) {

            $this->punto1->setX(($this->punto1->getX()) + $moverx);
            $this->punto1->setY(($this->punto1->gety()) + $movery);
            $this->punto2->setX(($this->punto2->getX()) + $moverx);
            $this->punto2->setY(($this->punto2->gety()) + $movery);
            $this->punto3->setX(($this->punto3->getX()) + $moverx);
            $this->punto3->setY(($this->punto3->gety()) + $movery);
            $this->punto4->setX(($this->punto4->getX()) + $moverx);
            $this->punto4->setY(($this->punto4->gety()) + $movery);

        }

        public function __toString()
        {
            return $this->punto1." ".$this->punto2." ".$this->punto3." ".$this->punto4; 
        }
    }
?>