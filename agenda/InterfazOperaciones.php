<?php

    interface InterfazOperaciones {
        public function guardar($dato);
        public function eliminar($dato);
        public function editar($dato);
        public function listar();
    }

?>