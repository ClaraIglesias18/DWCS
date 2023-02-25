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

        public function listar() {

        }

        public function comprobarUsuario($correo, $password) {

                $bd = ConexionMysql::getConexion();
                $sql = "SELECT * from usuario where correo = '$correo' AND password = '$password'";
                $stm = $bd->prepare($sql);
                $stm->execute();
                $result = $stm -> fetchAll(PDO::FETCH_OBJ);

                return $result;

        }
    }
?>