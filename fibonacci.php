<?php
    function fibonacci($numero) {
        $resultado = 1;

        if($numero > 1) {
            $resultado = fibonacci($numero -1) + fibonacci($numero - 2);
        }

        return $resultado;

    }

    $count = 10;

    for($i = 0; $i <= 10; $i++ ) {
        echo fibonacci($i);
        echo " ";
    }
    
?>