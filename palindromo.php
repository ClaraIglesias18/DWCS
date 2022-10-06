<?php
    $palabra = "Somos";
    $palabraRev = strrev($palabra);

    if(strcasecmp($palabra, $palabraRev) == 0) {
        echo "Es palindromo";
    } else {
        echo "No es palindromo";
    }
    

?>