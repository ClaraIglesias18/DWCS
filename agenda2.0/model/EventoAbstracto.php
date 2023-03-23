<?php
abstract class EventoAbstracto
{
    public $id_evento;
    public $id_usuario;
    public $nombre;
    public $fecha_inicio;
    public $fecha_fin;

    public static function getClass()
    {
        return get_called_class();
    }

    public static function crearObjetoEvento($arrayEvento)
    {
        $tipo = get_called_class();
        $con = new $tipo();
        if (isset($arrayEvento['id_evento'])) {
            $con->id_evento = $arrayEvento['id_evento'];
        }
        $con->id_evento = $arrayEvento['id_evento'];
        $con->id_usuario = $arrayEvento['id_usuario'];
        $con->nombre = $arrayEvento['nombre'];
        $con->fecha_inicio = $arrayEvento['fecha_inicio'];
        $con->fecha_fin = $arrayEvento['fecha_fin'];
        return $con;
    }
}