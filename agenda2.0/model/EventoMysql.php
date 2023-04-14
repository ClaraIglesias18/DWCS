<?php
require_once('Evento.php');
require_once('iEvento.php');
class EventoMysql extends Evento implements iEvento
{

    public function create($evento)
    {
        $nombre = $evento[0];
        $fecha_inicio = $evento[1]->format('Y-m-d H:i:s');
        $fecha_fin = $evento[2]->format('Y-m-d H:i:s');
        $id_usuario = $evento[3];

        $sql = "INSERT INTO evento (nombre, fecha_inicio, fecha_fin, id_usuario) VALUES (?, ?, ?, ?)";
        $stm = ConexionMysql::getConexion()->prepare($sql);
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
            $e = new EventoMysql(
                $evento->id_evento,
                $evento->id_usuario,
                $evento->nombre,
                $evento->fecha_inicio = new DateTime($evento->fecha_inicio),
                $evento->fecha_fin = new DateTime($evento->fecha_fin)
            );
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
        $e = new EventoMysql(
            $result->id_evento,
            $result->id_usuario,
            $result->nombre,
            $result->fecha_inicio = new DateTime($result->fecha_inicio),
            $result->fecha_fin = new DateTime($result->fecha_fin)
        );
        return $e;
    }
    public function delete($id)
    {
        $sql = "DELETE FROM evento WHERE id_evento = ?";
        $stm = ConexionMysql::getConexion()->prepare($sql);
        $stm->execute([$id]);
    }
    public function modify($evento)
    {
        $sql = "UPDATE evento SET nombre = ?, fecha_inicio = ?, fecha_fin = ? WHERE id_evento = ?";
        $stm = ConexionMysql::getConexion()->prepare($sql);
        $stm->execute([
            $evento->getNombre(),
            $evento->getFechaInicio()->format('Y-m-d H:i:s'),
            $evento->getFechaFin()->format('Y-m-d H:i:s'),
            $evento->getIdEvento()
        ]);
    }
}
