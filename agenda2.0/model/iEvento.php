<?php
interface iEvento {
    public function create($evento);
    public static function getAll($idUsuario);
    public function delete($idEvento);
    public function getById($idEvento);
    public function modify($idEvento);
}