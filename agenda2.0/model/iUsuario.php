<?php
interface iUsuario {
    public function create($usuario);
    public function getAll();
    public function getById($id);
    public function delete($id);
    public function modify($usuario);
}
