<?php
require_once('vendor/autoload.php');
require_once('ConexionMongo.php');
require_once('Usuario.php');

class UsuarioMongo extends Usuario  implements MongoDB\BSON\Persistable
{

    private $bd;

    public function __construct()
    {
        $this->bd =  ConexionMongo::getConexion();
    }

    public function guardar($usuario)
    {
        $this->bd->usuario->insertOne($usuario);
    }

    public function editar($usuario)
    {
        $this->bd->usuario->updateOne(
            ["_id" => $usuario->id_usuario],
            ['$set' =>  $usuario]
        );
    }

    public function eliminar($usuario)
    {
        $this->bd->usuario->deleteOne(
            ["_id" => $usuario->id_usuario]
        );
    }

    public function listar($usuario)
    {
        $resultado = $this->bd->usuario->find();
        $resultado->setTypeMap(['root' => self::class]);
        $usuarios = [];
    
        foreach ($resultado as $user) {
            $usuarios[(String)$user->id_usuario] = $user;

        }

        
        return $usuarios;

    }

    public function comprobarUsuario($correo, $password)
    {

        return $this->bd->usuario->findOne(array('$and' => array(array("correo" => $correo), array("password" => $password))),
        ['typeMap'=>['root' => self::class]]);
    }
    
    public function bsonUnserialize(array  $data): void
   {

    //$this->nombre = $data["nombre"];
      foreach ($data as $key => $value) {
          switch ($key) {
              case '_id': $this->id_usuario = $value; break;
              default: $this->$key = $value; break;
          }
      }
   }
   
   public function bsonSerialize(): array
   {
       $array = (array) $this;
       if (isset( $this->id_usuario)) {
        $array['_id'] = new MongoDB\BSON\ObjectID($this->id_usuario);
       }
       unset($array['id_usuario']);
       return $array;
   }
    
}