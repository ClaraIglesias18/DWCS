<?php

require_once('InterfazOperaciones.php');
require_once('Evento.php');
require_once('conexionMysql.php');


class EventoMysql extends Evento implements InterfazOperaciones
{

    private $bd;

    public function __construct()
    {
        $this->bd =  ConexionMysql::getConexion();
    }

    public function guardar($evento)
    {
        try {
            $nombre = $evento->getNombre();
            $fecha_inicio = $evento->getFechaInicio()->format('Y-m-d H:i:s');
            $fecha_fin = $evento->getFechaFin()->format('Y-m-d H:i:s');
            $id_usuario = $evento->getIdUsuario();

            $sql = "INSERT INTO evento (nombre, fecha_inicio, fecha_fin, id_usuario) VALUES (?, ?, ?, ?)";
            $stm = $this->bd->prepare($sql);
            $stm->execute([$nombre, $fecha_inicio, $fecha_fin, $id_usuario]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function eliminar($evento)
    {
        try {
            $sql = "DELETE FROM evento WHERE id_evento = ?";
            $stm = $this->bd->prepare($sql);
            $stm->execute([$evento]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function editar($evento)
    {
        try {
            $sql = "UPDATE evento SET nombre = ?, fecha_inicio = ?, fecha_fin = ? WHERE id_evento = ?";
            $stm = $this->bd->prepare($sql);
            $stm->execute([$evento->getNombre(), $evento->getFechaInicio()->format('Y-m-d H:i:s'), $evento->getFechaFin()->format('Y-m-d H:i:s'), $evento->getIdEvento()]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function listar($idUsuario)
    {
        try {
            $sql = "SELECT * from evento where id_usuario = $idUsuario";
            $stm = $this->bd->prepare($sql);
            $stm->execute();

            while (($r = $stm->fetch(PDO::FETCH_OBJ)) != null) {
                $result[] = new self($r->id_evento, $r->id_usuario, $r->nombre, $r->fecha_inicio = new DateTime(), $r->fecha_fin = new DateTime());
            }

            return $result;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function getEvento($idEvento)
    {
        try {
            $sql = "SELECT * FROM evento where id_evento = ?";
            $stm = $this->bd->prepare($sql);
            $stm->execute([$idEvento]);
            $result = $stm->fetch(PDO::FETCH_OBJ);

            $evento = new Evento($result->id_evento, $result->id_usuario, $result->nombre, $result->fecha_inicio = new DateTime(), $result->fecha_fin = new DateTime());

            return $evento;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
