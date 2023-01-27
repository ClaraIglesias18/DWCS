<?php
    require_once(dirname(__FILE__).'/libro.php');
    require_once(dirname(__FILE__).'/xmlLibro.php');
    
    $libros = [];
    $xmlLibro = new xmlLibro("libro_1.xml", "libro.xslt");

    /*$librosXML = $xmlLibros->getElementsByTagName('book');
    foreach($librosXML as $libro) {
        $libros[] = xmlLibro::getLibro($libro);
    };*/


    $libro = new Libro("44", "prueba1", "clara", "libro de prueba", "genero de prueba", "999$", "26/01/23", "esto es un libro de prueba");

    /*$nuevoDoc = $xmlLibro->appendLibro($libro);
    $xmlLibro->saveXml($nuevoDoc, "libros_1.xml");
    
    $xmlLibros = $xmlLibro->load("libros_1.xml");
    echo xmlLibro::toHtml($xmlLibros, $xslDoc);
*/

?>