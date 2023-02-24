<?php
    class EventoMysql implements InterfazOperaciones {

        private $bd;

        public function __construct() {
            $dsn = "mysql:dbname=docker_demo;host=docker-mysql";
            $usuario = "root";
            $password = "root123";
            $this->bd = new PDO($dsn, $usuario, $password);
        }

        public function guardar($evento) {
            
            try {
                $sql = "INSERT INTO evento (nombre, fecha_inicio, fecha_fin, id_usuario) VALUES (?, ?, ?, ?)";
                $stm = $this->bd->prepare($sql);
                $stm->execute($evento->getNombre, $evento->getFechaInicio, $evento->getFechaFin, $evento->getIdUsuario); 
            } catch (Exception $e) {
                return $e->getMessage();
            }
            
        }

        public function eliminar($evento) {

            try {
                $sql = "DELETE FROM evento WEHRE id = ?";
                $stm = $this->bd->prepare($sql);
                $stm->execute($evento->getIdEvento);
            } catch (Exception $e) {
                return $e->getMessage();
            }

        }

        public function editar($evento) {

        }

        public function listar($evento) {
            try {
                $sql = "SELECT * from evento";
                $stm = $this->bd->prepare($sql);
                $stm->execute();

                foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
                    $result[] = $r;
                }

                return $result;

            } catch (Exception $e) {
                return $e->getMessage(); 
            }
        }

    }
