<?php
abstract class Diccionario {

    public function __construct(
        protected $idPalabra = null, 
        protected $palabra = null)
    {
    }

    /**
     * Get the value of idPalabra
     */
    public function getIdPalabra()
    {
        return $this->idPalabra;
    }

    /**
     * Set the value of idPalabra
     */
    public function setIdPalabra($idPalabra): self
    {
        $this->idPalabra = $idPalabra;

        return $this;
    }

    /**
     * Get the value of palabra
     */
    public function getPalabra()
    {
        return $this->palabra;
    }

    /**
     * Set the value of palabra
     */
    public function setPalabra($palabra): self
    {
        $this->palabra = $palabra;

        return $this;
    }

    public function __serialize(): array
    {
        return [
            'idPalabra' => $this->idPalabra,
            'palabra' => $this->palabra
        ];
    }

    public function __unserialize(array $data): void
    {
        $this->idPalabra = $data['idPalabra'];
        $this->palabra = $data['palabra'];
    }
}