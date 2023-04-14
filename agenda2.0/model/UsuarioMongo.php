<?php
require_once('ConexionMongo.php');
require_once('../vendor/autoload.php');
require_once('iUsuario.php');
require_once('Usuario.php');

class UsuarioMongo extends Usuario implements iUsuario, MongoDB\BSON\Persistable
{
    public function create($usuario)
    {
        $nombre = $usuario[0];
        $correo = $usuario[1];
        $password = $usuario[2];
        $rol = 0;

        ConexionMongo::getConexion()->usuario->insertOne([
            '_id' => new MongoDB\BSON\ObjectID(),
            'nombre' => $nombre,
            'correo' => $correo,
            'password' => $password,
            'rol' => $rol
        ]);
    }
    public function getAll()
    {
        $resultado = ConexionMongo::getConexion()->usuario->find(['rol' => 0]);
        $usuarios = [];

        foreach ($resultado as $usuario) {
            array_push($usuarios, new self(
                $usuario->_id,
                $usuario->nombre,
                $usuario->correo,
                $usuario->password,
                $usuario->rol
            ));
        }

        return $usuarios;
    }
    public function getByid($id)
    {
        $resultado = ConexionMongo::getConexion()->usuario->findOne(['_id' => new MongoDB\BSON\ObjectID($id)]);

        $usuario = new self(
            $resultado->_id,
            $resultado->nombre,
            $resultado->correo,
            $resultado->password,
            $resultado->rol
        );

        return $usuario;
    }
    public function delete($id)
    {
        ConexionMongo::getConexion()->usuario->deleteOne(['_id' => new MongoDB\BSON\ObjectID($id)]);
    }
    public function modify($usuario)
    {
        ConexionMongo::getConexion()->usuario->updateMany(
            ['_id' => new MongoDB\BSON\ObjectID($usuario->getIdUsuario())],
            ['$set' => [
                'nombre' => $usuario->getNombre(),
                'correo' => $usuario->getCorreo(),
                'password' => $usuario->getPassword()
            ]],
        );
    }

    public function comprobarUsuario($correo, $password)
    {
        $resultado = ConexionMongo::getConexion()->usuario->findOne(['$and' => [['correo' => $correo], ['password' => $password]]]);

        if ($resultado != null) {
            $usuario = new self(
                $resultado->_id,
                $resultado->nombre,
                $resultado->correo,
                $resultado->password,
                $resultado->rol
            );

            return $usuario;
        } else {
            return false;
        }
    }

    public function bsonUnserialize(array  $data): void
    {

        //$this->nombre = $data["nombre"];
        foreach ($data as $key => $value) {
            switch ($key) {
                case '_id':
                    ConexionMongo::getConexion()->id_usuario = $value;
                    break;
                default:
                    ConexionMongo::getConexion()->$key = $value;
                    break;
            }
        }
    }

    public function bsonSerialize(): array
    {
        $array = (array) ConexionMongo::getConexion();
        if (isset(ConexionMongo::getConexion()->id_usuario)) {
            $array['_id'] = new MongoDB\BSON\ObjectID(ConexionMongo::getConexion()->id_usuario);
        }
        unset($array['id_usuario']);
        return $array;
    }
}
