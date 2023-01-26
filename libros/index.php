<?php
    require_once(dirname(__FILE__).'/libro.php');
    require_once(dirname(__FILE__).'/xmlLibro.php');
    
    $libros = [];
    $xmlLibros = new DOMDocument();
    $xmlLibros->load(dirname(__FILE__).'/libros.xml');
    $catalogo = $xmlLibros->documentElement;

    /*$librosXML = $xmlLibros->getElementsByTagName('book');
    foreach($librosXML as $libro) {
        $libros[] = xmlLibro::getLibro($libro);
    };*/


    $libro = ["0", "prueba", "clara", "libro de prueba", "genero de prueba", "999$", "26/01/23", "esto es un libro de prueba"];

    $nuevoDoc = xmlLibro::appendLibro($xmlLibros, $libro);
    $nuevoDoc->save(dirname(__FILE__)."/libros_1.xml");
    //var_dump($nuevoCatalogo);

?>