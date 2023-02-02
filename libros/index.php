<?php
    require_once(dirname(__FILE__).'/libro.php');
    require_once(dirname(__FILE__).'/xmlLibro.php');
    
    $libros = [];
    $xmlLibro = new xmlLibro("libros_1.xml", "libros.xslt");

    $libro = new Libro("44", "prueba1", "clara", "libro de prueba", "genero de prueba", "999$", "26/01/23", "esto es un libro de prueba");
    
    echo $xmlLibro->toHtml();


?>