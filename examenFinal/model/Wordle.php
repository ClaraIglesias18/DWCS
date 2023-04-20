<?php
require_once('DiccionarioMysql.php');

class Wordle {
    public $palabraOculta;
    public $palabraOcultaObj;
    public $vidas;
    public $partidasJugadas;
    public $partidasGanadas;
    public $diccionario;

    public function __construct()
    {   
        $this->partidasJugadas = 0;
        $this->partidasGanadas = 0;
    }

    public function iniciarJuego() {
        $this->diccionario = new DiccionarioMysql();
        $this->palabraOcultaObj = $this->diccionario->seleccionPalabra();
        $this->palabraOculta = $this->palabraOcultaObj->getPalabra();
        $this->vidas = 6;
    }

    public function comprobarLetrasPalabra($palabraJugada) {

        $arrPalabraOculta = str_split($this->palabraOculta);
        $arrPalabraJugada = str_split($palabraJugada);
        $arrSalida = [];
        $count = 0;


        for($i = 0; $i < count($arrPalabraOculta); $i++) {
            if($arrPalabraJugada[$i] == $arrPalabraOculta[$i]) {
                $arrSalida[$i] = 2;
                $count++;                
            } else if(in_array($arrPalabraJugada[$i], $arrPalabraOculta)) {
                $arrSalida[$i] = 1;
            } else {
                $arrSalida[$i] = 0;
            }
        }

        $this->vidas --;

        if($count == 5) {
            $this->partidasJugadas++;
            $this->partidasGanadas++;
        }

        if($this->vidas == 0) {
            $this->partidasJugadas++;
        }

        return $arrSalida;
        
    }


    /**
     * Get the value of palabraOculta
     */
    public function getPalabraOculta()
    {
        return $this->palabraOculta;
    }

    /**
     * Set the value of palabraOculta
     */
    public function setPalabraOculta($palabraOculta): self
    {
        $this->palabraOculta = $palabraOculta;

        return $this;
    }

    /**
     * Get the value of palabraOcultaObj
     */
    public function getPalabraOcultaObj()
    {
        return $this->palabraOcultaObj;
    }

    /**
     * Set the value of palabraOcultaObj
     */
    public function setPalabraOcultaObj($palabraOcultaObj): self
    {
        $this->palabraOcultaObj = $palabraOcultaObj;

        return $this;
    }

    /**
     * Get the value of vidas
     */
    public function getVidas()
    {
        return $this->vidas;
    }

    /**
     * Set the value of vidas
     */
    public function setVidas($vidas): self
    {
        $this->vidas = $vidas;

        return $this;
    }

    /**
     * Get the value of partidasJugadas
     */
    public function getPartidasJugadas()
    {
        return $this->partidasJugadas;
    }

    /**
     * Set the value of partidasJugadas
     */
    public function setPartidasJugadas($partidasJugadas): self
    {
        $this->partidasJugadas = $partidasJugadas;

        return $this;
    }

    /**
     * Get the value of partidasGanadas
     */
    public function getPartidasGanadas()
    {
        return $this->partidasGanadas;
    }

    /**
     * Set the value of partidasGanadas
     */
    public function setPartidasGanadas($partidasGanadas): self
    {
        $this->partidasGanadas = $partidasGanadas;

        return $this;
    }
}