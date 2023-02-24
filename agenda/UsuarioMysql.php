<?php
    require_once('conexionMysql.php');
    require_once('InterfazOperaciones.php');

    class UsuarioMysql implements InterfazOperaciones {

        public function guardar($usuario) {
            
        }

        public function eliminar($usuario) {

        }

        public function editar($usuario) {

        }

        public function listar($usuario) {

        }

        public function comprobarUsuario($correo, $password) {
            try {
                $bd = ConexionMysql::getConexion();
                $sql = "SELECT * from evento where correo = '$correo' AND password = '$password'";
                $stm = $bd->prepare($sql);
                $stm->execute();

            } catch (Exception $e) {
                return $e->getMessage(); 
            }
        }
    }
?>