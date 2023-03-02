<?php
    require_once('EventoMysql.php');
    require_once('UsuarioMysql.php');
    require_once('EventoMongo.php');
    require_once('UsuarioMongo.php');

    class SelectorPersistente {
        public static function getEventoPersistente($selector) {
            switch ($selector) {
                case '0':
                    return new EventoMysql;
                    break;
                case '1':
                    return new EventoMongo;
                    break;
            }
        }

        public static function getUsuarioPersistente($selector) {
            switch ($selector) {
                case '0':
                    return new UsuarioMysql;
                    break;
                case '1':
                    return new UsuarioMongo;
                    break;
            }
        }
    }
?>