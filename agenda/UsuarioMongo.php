<?php
    require_once('vendor/autoload.php');
    require_once('ConexionMongo.php');
    require_once('Usuario.php');

    class UsuarioMongo extends Usuario implements InterfazOperaciones, MongoDB\BSON\Unserializable, MongoDB\BSON\Serializable {
        
        private $bd;

        public function __construct() {
            $this->bd =  ConexionMongo::getConexion();
        }
        
        public function guardar($usuario) {
            $this->bd->usuario->insertOne($usuario);
        }

        public function editar($usuario) {
            $this->bd->usuario->updateOne(
                [ "_id" => $usuario->id_usuario ],
                [ '$set' =>  $usuario]
            );
        }

        public function eliminar($usuario) {
            $this->bd->usuario->deleteOne(
                [ "_id" => $usuario->id_usuario]
            );
        }

        public function listar($usuario) {
            
        }

        public function comprobarUsuario($correo, $password) {
            return $this->bd->usuario->find(array("username"=>$correo, "password"=>$password));
        }

        public function bsonUnserialize ( array $data ) {

            foreach ($data as $key => $value) {
                switch ($key) {
                    case '_id': $this->id_usuario = $value; break;
                    default: $this->$key = $value; break;
      
                }
            }
         }
      
         public function bsonSerialize()
         {
             $array = (array) $this;
             if (isset( $this->id_usuario)) {
              $array['_id'] = new MongoDB\BSON\ObjectID($this->id_usuario);
             }
             unset($array['id_usuario']);
             return $array;
         }

        
    }
    
?>
