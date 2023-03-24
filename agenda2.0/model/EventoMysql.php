<?php
require_once('Evento.php');
require_once('iEvento.php');
class EventoMysql extends Evento implements iEvento
{
    private $bd;

    /* public function __construct()
    {

        $this->bd =  ConexionMysql::getConexion();
    }*/

    public function __construct(
        public $id_evento = null,
        public $id_usuario = null,
        public $nombre = "",
        public ?DateTime $fecha_inicio = null,
        public ?DateTime $fecha_fin = null
    ) {
        parent::__construct($id_evento, $id_usuario, $nombre, $fecha_inicio, $fecha_fin);
        $this->bd =  ConexionMysql::getConexion();
    }

    public function create($evento)
    {
        $nombre = $evento[0];
        $fecha_inicio = $evento[1]->format('Y-m-d H:i:s');
        $fecha_fin = $evento[2]->format('Y-m-d H:i:s');
        $id_usuario = $evento[3];

        $sql = "INSERT INTO evento (nombre, fecha_inicio, fecha_fin, id_usuario) VALUES (?, ?, ?, ?)";
        $stm = $this->bd->prepare($sql);
        $stm->execute([$nombre, $fecha_inicio, $fecha_fin, $id_usuario]);
    }
    public static function getAll($idUsuario)
    {
        $sql = "SELECT * from evento where id_usuario = ?";
        $stm = ConexionMysql::getConexion()->prepare($sql);
        $stm->execute([$idUsuario]);
        //$result = $stm->fetchAll(PDO::FETCH_CLASS, __CLASS__);
        $result = $stm->fetchAll(PDO::FETCH_OBJ);
        $eventos = [];
        foreach ($result as $evento) {
            $e = new EventoMysql($evento->id_evento, $evento->id_usuario, $evento->nombre, $evento->fecha_inicio = new DateTime(), $evento->fecha_fin = new DateTime());
            $eventos[$evento->id_evento] = $e;
        }

        return $eventos;
    }
    public function getById($idEvento)
    {
        $sql = "SELECT * from evento where id_evento = ?";
        $stm = ConexionMysql::getConexion()->prepare($sql);
        $stm->execute([$idEvento]);
        $result = $stm->fetchAll(PDO::FETCH_OBJ)[0];
        $e = new EventoMysql($result->id_evento, $result->id_usuario, $result->nombre, $result->fecha_inicio = new DateTime(), $result->fecha_fin = new DateTime());
        return $e;
    }
    public static function delete($id)
    {
        $sql = "DELETE FROM evento WHERE id_evento = ?";
        $stm = ConexionMysql::getConexion()->prepare($sql);
        $stm->execute([$id]);
    }
    public function modify($evento)
    {
        $sql = "UPDATE evento SET nombre = ?, fecha_inicio = ?, fecha_fin = ? WHERE id_evento = ?";
        $stm = $this->bd->prepare($sql);
        $stm->execute([$evento->getNombre(), $evento->getFechaInicio()->format('Y-m-d H:i:s'), $evento->getFechaFin()->format('Y-m-d H:i:s'), $evento->getIdEvento()]);
    }
}
