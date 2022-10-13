<?php
    include_once("Punto.php");
    include_once("Rectangulo.php");

    $rec1 = new Rectangulo(0, 0, 4, 0, 0, 5, 4, 5);

    echo $rec1;
    echo "\nSuperficie: ";    
    echo $rec1->calcularSup();

    $rec1->mover(14, 20);

    echo "\nNuevo rectangulo: ";
    echo $rec1;
    echo "\nSuperficie: ";
    echo $rec1->calcularSup();
    


?>