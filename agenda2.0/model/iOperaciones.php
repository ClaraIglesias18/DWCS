<?php
interface iOperaciones {
    public function getAll();
    public function getById($id);
    public function deleteById($id);
    public function modify($id);
}
