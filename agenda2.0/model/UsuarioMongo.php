<?php
require_once('ConexionMongo.php');
require_once('../vendor/autoload.php');
require_once('iUsuario.php');
require_once('Usuario.php');

class UsuarioMongo extends Usuario implements iUsuario, MongoDB\BSON\Persistable
{   
    public function create($usuario) {
        //hay que formatear los datos que viene en arr a json
       ConexionMongo::getConexion()->usuario->insertOne($usuario);
    }
    public function getAll()
    {
        $resultado = ConexionMongo::getConexion()->usuario->find();
        $resultado->setTypeMap(['root' => self::class]);
        $usuarios = [];
    
        foreach ($resultado as $user) {
            $usuarios[(String)$user->id_usuario] = $user;

        }
        
        return $usuarios;
    }
    public function getByid($id)
    {
    }
    public function delete($id)
    {
    }
    public function modify($id)
    {
    }

    public function comprobarUsuario($correo, $password)
    {   
        return ConexionMongo::getConexion()->usuario->findOne(array('$and' => array(array("correo" => $correo), array("password" => $password))),
        ['typeMap'=>['root' => self::class]]);
    }

    public function bsonUnserialize(array  $data): void
   {

    //$this->nombre = $data["nombre"];
      foreach ($data as $key => $value) {
          switch ($key) {
              case '_id': ConexionMongo::getConexion()->id_usuario = $value; break;
              default: ConexionMongo::getConexion()->$key = $value; break;
          }
      }
   }
   
   public function bsonSerialize(): array
   {
       $array = (array) ConexionMongo::getConexion();
       if (isset( ConexionMongo::getConexion()->id_usuario)) {
        $array['_id'] = new MongoDB\BSON\ObjectID(ConexionMongo::getConexion()->id_usuario);
       }
       unset($array['id_usuario']);
       return $array;
   }
    
}
