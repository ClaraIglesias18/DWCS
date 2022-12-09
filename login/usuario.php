<?php
class Usuario
{
    private $idUuario;
    private $nombre;
    private $apellidos;
    private $correo;
    private $contraseña;

    public function __construct($idUsuario, $nombre, $apellidos, $correo, $contraseña)
    {
        $this->idUuario = $idUsuario;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->correo = $correo;
        $this->contraseña = $contraseña;
    }

    public function validarUsuario($correo, $contraseña)
    {
        return $this->correo == $correo && $this->contraseña == $contraseña;
    }

    /**
     * Get the value of correo
     */
    public function getCorreo()
    {
        return $this->correo;
    }
}
?>