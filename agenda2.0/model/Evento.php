<?php
class Evento
{
    public function __construct(private $id_evento = null, private $id_usuario = null, private $nombre = "", private ?DateTime $fecha_inicio = null, private ?DateTime $fecha_fin = null)
    {

        if ($this->fecha_inicio == null) {
            $this->fecha_inicio = new DateTime();
        }

        if ($this->fecha_fin == null) {
            $this->fecha_fin = $this->fecha_inicio->add(new DateInterval('PT01H'));
        }
    }

    /**
     * Get the value of id_evento
     */
    public function getIdEvento()
    {
        return $this->id_evento;
    }

    /**
     * Set the value of id_evento
     */
    public function setIdEvento($id_evento): self
    {
        $this->id_evento = $id_evento;

        return $this;
    }

    /**
     * Get the value of nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     */
    public function setNombre($nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of fecha_inicio
     */
    public function getFechaInicio()
    {
        return $this->fecha_inicio;
    }

    /**
     * Set the value of fecha_inicio
     */
    public function setFechaInicio($fecha_inicio): self
    {
        $this->fecha_inicio = $fecha_inicio;

        return $this;
    }

    /**
     * Get the value of fecha_fin
     */
    public function getFechaFin()
    {
        return $this->fecha_fin;
    }

    /**
     * Set the value of fecha_fin
     */
    public function setFechaFin($fecha_fin): self
    {
        $this->fecha_fin = $fecha_fin;

        return $this;
    }

    /**
     * Get the value of id_usuario
     */
    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    /**
     * Set the value of id_usuario
     */
    public function setIdUsuario($id_usuario): self
    {
        $this->id_usuario = $id_usuario;

        return $this;
    }

    public function __serialize(): array
    {
        return [
            'id_evento' => $this->id_evento,
            'id_usuario' => $this->id_usuario,
            'nombre' => $this->nombre,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin
        ];
    }

    public function __unserialize(array $data): void
    {
        $this->id_evento = $data['id_evento'];
        $this->id_usuario = $data['id_usuario'];
        $this->nombre = $data['nombre'];
        $this->fecha_inicio = $data['fecha_inicio'];
        $this->fecha_fin = $data['fecha_fin'];
    }
}
