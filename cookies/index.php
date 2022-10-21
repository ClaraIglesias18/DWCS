<?php
    if(!isset($_COOKIE["nombre"])){
        setcookie("nombre", "clara", time() + 3600);
    }
    echo "Mi nombre es: ".$_COOKIE["nombre"]; 
?>