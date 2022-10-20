<?php
    //usuario = usuario;
    //clave = 1234;
    
    if (isset($_POST['usuario']) && isset($_POST['clave'])) {
        if($_POST['usuario'] == "usuario" && $_POST['clave'] == "1234") {
            echo "Hola: ".$_POST['usuario'];
        }
    }
    exit(0);
?>