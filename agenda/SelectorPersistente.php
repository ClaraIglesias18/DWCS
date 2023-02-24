<?php
    class SelectorPersistente {
        public static function getEventoPersistente($tipo) {
            return new EventoMysql(); 
        }

        public static function getUsuarioPersistente($tipo) {
            return new UsuarioMysql();
        }
    }
?>