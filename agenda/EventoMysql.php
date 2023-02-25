<?php

    require_once('InterfazOperaciones.php');
    require_once('Evento.php');
    require_once('ConexionMysql.php');


    class EventoMysql implements InterfazOperaciones {

        private $bd;

        public function __construct() {
            $this->bd =  ConexionMysql::getConexion();
        }

        public function guardar($evento) {
            
            try {

                $nombre = $evento->getNombre;
                $fecha_inicio = $evento->getFechaInicio;
                $fecha_fin = $evento->getFechaFin;
                $id_usuario = $evento->getIdUsuario;

                $sql = "INSERT INTO evento (nombre, fecha_inicio, fecha_fin, id_usuario) VALUES (?, ?, ?, ?)";
                $stm = $this->bd->prepare($sql);
                $stm->execute([$nombre, $fecha_inicio, $fecha_fin, $id_usuario]);

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

        public function listar() {
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
