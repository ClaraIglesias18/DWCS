<?php
require_once('conexionMysql.php');
require_once('InterfazOperaciones.php');
require_once('Usuario.php');

class UsuarioMysql implements InterfazOperaciones
{

    private $bd;

    public function __construct()
    {
        $this->bd =  ConexionMysql::getConexion();
    }

    public function guardar($usuario)
    {
        try {
            $nombre = $usuario->getNombre();
            $correo = $usuario->getCorreo();
            $password = $usuario->getPassword();
            $idUsuario = $usuario->getIdUsuario();
            $rol = $usuario->getRol();

            $sql = "INSERT INTO usuario (id_usuario, nombre, correo, password, rol) VALUES (?, ?, ?, ?, ?)";
            $stm = $this->bd->prepare($sql);
            $stm->execute([$idUsuario, $nombre, $correo, $password, $rol]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function eliminar($usuario)
    {
        try {
            $sql = "DELETE FROM usuario WHERE id_usuario = ?";
            $stm = $this->bd->prepare($sql);
            $stm->execute([$usuario]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function editar($usuario)
    {
        try {
            $sql = "UPDATE usuario SET nombre = ?, correo = ?, password = ? WHERE id_usuario = ?";
            $stm = $this->bd->prepare($sql);
            $stm->execute([$usuario->getNombre(), $usuario->getCorreo(), $usuario->getPassword(), $usuario->getIdUsuario()]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function listar($usuario)
    {
        try {
            $sql = "SELECT * from usuario where rol = 0";
            $stm = $this->bd->prepare($sql);
            $stm->execute();

            while (($r = $stm->fetch(PDO::FETCH_OBJ)) != null) {
                $result[] = new Usuario($r->id_usuario, $r->nombre, $r->correo, $r->password);
            }

            return $result;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function comprobarUsuario($correo, $password)
    {
        $bd = ConexionMysql::getConexion();
        $sql = "SELECT * from usuario where correo = '$correo' AND password = '$password'";
        $stm = $bd->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_OBJ);

        return $result;
    }

    public function getUsuario($idUsuario)
    {
        try {
            $sql = "SELECT * FROM usuario where id_usuario = ?";
            $stm = $this->bd->prepare($sql);
            $stm->execute([$idUsuario]);
            $result = $stm->fetch(PDO::FETCH_OBJ);

            $usuario = new Usuario($result->id_usuario, $result->nombre, $result->correo, $result->password);

            return $usuario;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
