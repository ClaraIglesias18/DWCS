<?php
interface iEvento {
    public function create($evento);
    public function getAll($idUsuario);
    public function delete($idEvento);
    public function modify($idEvento);
}