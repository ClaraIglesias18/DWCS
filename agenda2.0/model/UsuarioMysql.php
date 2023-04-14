<?php
require_once('ConexionMysql.php');
require_once('iUsuario.php');
require_once('Usuario.php');
class UsuarioMysql extends Usuario implements iUsuario
{
    public function create($usuario)
    {
        $nombre = $usuario[0];
        $correo = $usuario[1];
        $password = $usuario[2];
        $rol = 0;

        $sql = "INSERT INTO usuario (nombre, correo, password, rol) VALUES ( ?, ?, ?, ?)";
        $stm = ConexionMysql::getConexion()->prepare($sql);
        $stm->execute([$nombre, $correo, $password, $rol]);
    }

    public function getAll()
    {
        $sql = "SELECT * FROM usuario where rol = ?";
        $stm = ConexionMysql::getConexion()->prepare($sql);
        $stm->execute([0]);
        $result = $stm->fetchAll(PDO::FETCH_OBJ);
        $usuarios = [];

        foreach ($result as $usuario) {
            $usuarios[$usuario->id_usuario] = new self(
                $usuario->id_usuario,
                $usuario->nombre,
                $usuario->correo,
                $usuario->password
            );
        }

        return $usuarios;
    }

    public function getById($id)
    {
        $sql = "SELECT * from usuario where id_usuario = ?";
        $stm = ConexionMysql::getConexion()->prepare($sql);
        $stm->execute([$id]);
        $result = $stm->fetchAll(PDO::FETCH_OBJ)[0];
        $usuario = new self(
            $result->id_usuario,
            $result->nombre,
            $result->correo,
            $result->password
        );

        return $usuario;
    }

    public function delete($id)
    {
        $sql = "DELETE FROM usuario WHERE id_usuario = ?";
        $stm = ConexionMysql::getConexion()->prepare($sql);
        $stm->execute([$id]);
    }

    public function modify($usuario)
    {
        $sql = "UPDATE usuario SET nombre = ?, correo = ?, password = ? WHERE id_usuario = ?";
        $stm = ConexionMysql::getConexion()->prepare($sql);
        $stm->execute([
            $usuario->getNombre(),
            $usuario->getCorreo(),
            $usuario->getPassword(),
            $usuario->getIdUsuario()
        ]);
    }

    public function comprobarUsuario($correo, $password)
    {
        $sql = "SELECT * from usuario where correo = ? AND password = ?";
        $stm = ConexionMysql::getConexion()->prepare($sql);
        $stm->execute([$correo, $password]);
        $result = $stm->fetchAll(PDO::FETCH_OBJ)[0];

        if ($result != null) {
            $usuario = new self(
                $result->id_usuario,
                $result->nombre,
                $result->correo,
                $result->password,
                $result->rol
            );

            return $usuario;
        } else {
            return false;
        }
    }
}
