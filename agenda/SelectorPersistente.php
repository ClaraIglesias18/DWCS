<?php
    require_once('EventoMysql.php');

    class SelectorPersistente {
        public static function getEventoPersistente() {
            return new EventoMysql(); 
        }

        public static function getUsuarioPersistente() {
            return new UsuarioMysql();
        }
    }
?>