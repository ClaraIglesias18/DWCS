<?php
require_once('ConexionMysql.php');
require_once('iUsuario.php');
require_once('Usuario.php');
class UsuarioMysql extends Usuario implements iUsuario
{
    private $bd;

    public function __construct()
    {
        $this->bd =  ConexionMysql::getConexion();
    }

    //para pasar datos de usuarios crear un array de usuario en controller
    //y recorrer el array en el metodo create
    //ARREGLAR PASANDO CON HERENCIA DE OBJ
    public function create($usuario) {
        $nombre = $usuario[0];
        $correo = $usuario[1];
        $password = $usuario[2];
        $idUsuario = $usuario[3];
        $rol = $usuario[4];

        $sql = "INSERT INTO usuario (id_usuario, nombre, correo, password, rol) VALUES (?, ?, ?, ?, ?)";
        $stm = $this->bd->prepare($sql);
        $stm->execute([$idUsuario, $nombre, $correo, $password, $rol]);
    }

    public function getAll()
    {
        $sql = "SELECT * FROM usuario where rol = ?";
        $stm = $this->bd->prepare($sql);
        $stm->execute([0]);
        $result = $stm->fetchAll(PDO::FETCH_CLASS, self::class)[0];
        $usuarios = [];

        foreach($result as $usuario) {
            $usuarios[$usuario->id_usuario] = new self($usuario->id_usuario, $usuario->nombre, $usuario->correo, $usuario->password);
        }

        return $usuarios;

    }

    public function getById($id)
    {
        $sql = "SELECT * from usuario where id_usuario = ?";
        $stm = $this->bd->prepare($sql);
        $stm->execute([$id]);
        $usuario = $stm->fetchAll(PDO::FETCH_CLASS, self::class)[0];

        return $usuario;
    }

    public function delete($id)
    {
        $sql = "DELETE FROM usuario WHERE id_usuario = ?";
        $stm = $this->bd->prepre($sql);
        $stm->execute([$id]);
    }

    //pensar implementacion con obj usuarioMysql
    public function modify($usuario)
    {   
        $sql = "UPDATE usuario SET nonmbre = ?, correo = ?, password = ? WHERE id_usuario = ?";
        $stm = $this->bd->prepare($sql);
        $stm->execute([$usuario->getNombre(), $usuario->getCorreo(), $usuario->getPassword(), $usuario->getIdUsuario()]);
    }

    public function comprobarUsuario($correo, $password)
    {
        $bd = ConexionMysql::getConexion();
        $sql = "SELECT * from usuario where correo = ? AND password = ?";
        $stm = $this->bd->prepare($sql);
        $stm->execute([$correo, $password]);

        return $stm->fetchAll(PDO::FETCH_CLASS, self::class)[0];
    }
}
