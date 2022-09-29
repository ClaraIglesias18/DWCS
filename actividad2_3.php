<?php
    function factorial($numero) {
        $resultado = 1;
    
        if(is_nan($numero) || $numero < 1) {
             $resultado = -1;
        } else {
            for($i = 1; $i <= $numero; $i++) {
                $resultado = $resultado * $i;
            }
        };

        return $resultado;
    }

    echo factorial(3);
?>