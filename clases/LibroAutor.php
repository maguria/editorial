<?php


class LibroAutor {
    
    private $libro, $autor;
    
    function __construct(Libro $libro,Autor $autor) {
        $this->libro=$libro;
        $this->autor=$autor;
    }
    function getLibro() {
        return $this->libro;
    }

    function getAutor() {
        return $this->autor;
    }

    function setLibro($libro) {
        $this->libro = $libro;
    }

    function setAutor($autor) {
        $this->autor = $autor;
    }


}
