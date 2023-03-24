<?php
require_once('Evento.php');
require_once('iEvento.php');
class EventoMongo extends Evento implements iEvento
{   
    public function create($evento) {
        
    }
    public  static function getAll($idUsuario)
    {
    }
    public function getById($idEvento)
    {
    }
    public static function delete($idEvento)
    {
    }
    public function modify($idEvento)
    {
    }
}
