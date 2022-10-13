<?php
    include_once("Nif.php");

    $nif1 = new Nif();
    echo $nif1->mostrar();
    $nif1->leer();
    echo $nif1->mostrar();

?>