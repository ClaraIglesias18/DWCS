<?php
require_once('ConexionMysql.php');
require_once('iOperaciones.php');
require_once('Usuario.php');
class UsuarioMysql extends Usuario implements iOperaciones
{
    private $bd;

    public function __construct()
    {
        $this->bd =  ConexionMysql::getConexion();
    }

    public function getAll()
    {
        $sql = "SELECT * FROM usuario where rol = ?";
        $stm = $this->bd->prepare($sql);
        $stm->execute([0]);
        $usuarios = [];



    }

    public function getById($id)
    {
        
    }

    public function deleteByid($id)
    {
    }

    public function modify($id)
    {
    }
}
