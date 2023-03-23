<?php
require_once('Evento.php');
require_once('iEvento.php');
class EventoMysql extends Evento implements iEvento
{
    private $bd;

    public function __construct()
    {
        $this->bd =  ConexionMysql::getConexion();
    }

    //pasar datos de evento desde controller con un array de datos para
    //tratarlos desde el metodo create
    //ARREGLAR PASANDO CON HERENCIA DE OBJ
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
    public function getAll($idUsuario)
    {
        $sql = "SELECT * from evento where id_usuario = ?";
        $stm = $this->bd->prepare($sql);
        $stm->execute([$idUsuario]);
        $result = $stm->fetchAll(PDO::FETCH_CLASS, __CLASS__);
        $eventos = [];

        foreach ($result as $evento) {
            $eventos[$evento->id_usuario] = new self($evento->id_evento, $evento->id_usuario, $evento->nombre, $evento->fecha_inicio = new DateTime(), $evento->fecha_fin = new DateTime());
        }

        return $eventos;
    }
    public function delete($id)
    {
        $sql = "DELETE FROM evento WHERE id_evento = ?";
        $stm = $this->bd->prepare($sql);
        $stm->execute([$id]);
    }
    public function modify($id)
    {
        //pendiente
    }
}
