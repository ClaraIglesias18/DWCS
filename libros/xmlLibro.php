<?php
    require_once(dirname(__FILE__).'/libro.php');

    class xmlLibro extends Libro {

        public static function getLibro($xmlLibro){
            $libro = new Libro(
                $xmlLibro->attributes->getNamedItem('id')->nodeValue,
                $xmlLibro->getElementsByTagName('author')->item(0)->textcontent,
                $xmlLibro->getElementsByTagName('title')->item(0)->textContent,
                $xmlLibro->getElementsByTagName('genre')->item(0)->textContent,
                $xmlLibro->getElementsByTagName('price')->item(0)->textContent,
                $xmlLibro->getElementsByTagName('publish_date')->item(0)->textContent,
                $xmlLibro->getElementsByTagName('description')->item(0)->textContent
            );

            return $libro;
        }

        public static function appendLibro($xmlDoc, $libro){
            
            $catalogo = $xmlDoc->documentElement;

            $book = $xmlDoc->createElement("book");
            $book->setAttribute("id", $libro[0]);
            $author = $xmlDoc->createElement("author", $libro[2]);
            $title = $xmlDoc->createElement("title", $libro[3]);
            $genre = $xmlDoc->createElement("genre", $libro[4]);
            $price = $xmlDoc->createElement("price", $libro[5]);
            $publish_date = $xmlDoc->createElement("publish_date", $libro[6]);
            $description = $xmlDoc->createElement("description", $libro[7]);

            $catalogo->appendChild($book);
            $book->appendChild($author);
            $book->appendChild($title);
            $book->appendChild($genre);
            $book->appendChild($price);
            $book->appendChild($publish_date);
            $book->appendChild($description);

            return $xmlDoc;

        }   

    }

?>