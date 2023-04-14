<?php
require_once('ConexionMongo.php');
require_once('Evento.php');
require_once('../vendor/autoload.php');
require_once('iEvento.php');
class EventoMongo extends Evento implements iEvento, MongoDB\BSON\Persistable
{
    public function create($evento)
    {
        $nombre = $evento[0];
        $fecha_inicio = $evento[1]->format('Y-m-d H:i:s');
        $fecha_fin = $evento[2]->format('Y-m-d H:i:s');
        $id_usuario = $evento[3];

        ConexionMongo::getConexion()->evento->insertOne([
            '_id' => new MongoDB\BSON\ObjectID(),
            'id_usuario' => $id_usuario,
            'nombre' => $nombre,
            'fecha_inicio' => $fecha_inicio,
            'fecha_fin' => $fecha_fin
        ]);
    }
    public  static function getAll($idUsuario)
    {
        $resultado = ConexionMongo::getConexion()->evento->find(['id_usuario' => $idUsuario]);
        $eventos = [];

        foreach ($resultado as $evento) {
            array_push($eventos, new self(
                $evento->_id,
                $evento->id_usuario,
                $evento->nombre,
                $evento->fecha_inicio = new DateTime($evento->fecha_inicio),
                $evento->fecha_fin = new DateTime($evento->fecha_fin)
            ));
        }

        return $eventos;
    }
    public function getById($idEvento)
    {
        $resultado = ConexionMongo::getConexion()->evento->findOne(['_id' => new MongoDB\BSON\ObjectID($idEvento)]);

        $evento = new self(
            $resultado->_id,
            $resultado->id_usuario,
            $resultado->nombre,
            $resultado->fecha_inicio = new DateTime($resultado->fecha_inicio),
            $resultado->fecha_fin = new DateTime($resultado->fecha_fin)
        );

        return $evento;
    }
    public function delete($idEvento)
    {
        ConexionMongo::getConexion()->evento->deleteOne(['_id' => new MongoDB\BSON\ObjectID($idEvento)]);
    }
    public function modify($evento)
    {
        ConexionMongo::getConexion()->evento->updateMany(
            ['_id' => new MongoDB\BSON\ObjectID($evento->getIdEvento())],
            ['$set' => [
                'nombre' => $evento->getNombre(),
                'fecha_inicio' => $evento->getFechaInicio()->format('Y-m-d H:i:s'),
                'fecha_fin' => $evento->getFechaFin()->format('Y-m-d H:i:s')
            ]]
        );
    }

    public function bsonUnserialize(array  $data): void
    {

        //$this->nombre = $data["nombre"];
        foreach ($data as $key => $value) {
            switch ($key) {
                case '_id':
                    ConexionMongo::getConexion()->id_evento = $value;
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
        if (isset(ConexionMongo::getConexion()->id_evento)) {
            $array['_id'] = new MongoDB\BSON\ObjectID(ConexionMongo::getConexion()->id_evento);
        }
        unset($array['id_evento']);
        return $array;
    }
}
