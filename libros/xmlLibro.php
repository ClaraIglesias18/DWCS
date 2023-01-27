<?php
    require_once(dirname(__FILE__).'/libro.php');

    class xmlLibro extends Libro {

        public function __construct(private $xmlDoc, private $xsltDoc = null) {
            
            if(!is_null($this->xsltDoc)) {
                $this->load($xsltDoc);
            }

            $this->xmlDoc = $this->load($xmlDoc);
        }

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

        public function appendLibro($libro){
            
            $catalogo = $this->xmlDoc->documentElement;

            $book = $this->xmlDoc->createElement("book");
            $book->setAttribute("id", $libro->getId());
            $author = $this->xmlDoc->createElement("author", $libro->getAutor());
            $title = $this->xmlDoc->createElement("title", $libro->getTitle());
            $genre = $this->xmlDoc->createElement("genre", $libro->getGenre());
            $price = $this->xmlDoc->createElement("price", $libro->getPrice());
            $publish_date = $this->xmlDoc->createElement("publish_date", $libro->getPublishDate());
            $description = $this->xmlDoc->createElement("description", $libro->getDescription());

            $catalogo->appendChild($book);
            $book->appendChild($author);
            $book->appendChild($title);
            $book->appendChild($genre);
            $book->appendChild($price);
            $book->appendChild($publish_date);
            $book->appendChild($description);

            return $this->xmlDoc;

        }
        

        public static function toHtml($xmlDoc, $xsltDoc) {
            
            $procesador = new XSLTProcessor();
            $procesador->importStylesheet($xsltDoc);

            $transformada = $procesador->transformToXml($xmlDoc);

            return $transformada;

        }


        public function load($xmlDoc) {
            $documento = new DOMDocument();
            $documento->load(dirname(__FILE__)."/$xmlDoc");
            return $documento;
        }

        public function saveXml($ruta) {
            $this->xmlDoc->save(dirname(__FILE__)."/$ruta");
        }

    }

?>