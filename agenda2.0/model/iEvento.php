<?php
interface iEvento {
    public function create($evento);
    public static function getAll($idUsuario);
    public static function delete($idEvento);
   // public function delete();
    public function getById($idEvento);
    public function modify($idEvento);
}