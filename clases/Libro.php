<?php

class Libro {
    private $isbn, $id_autor, $titulo, $genero,$paginas,$descripcion;
    
    function __construct($isbn=null, $id_autor=null, $titulo=null, $genero=null, $paginas=null, $descripcion=null) {
        $this->isbn = $isbn;
        $this->id_autor = $id_autor;
        $this->titulo = $titulo;
        $this->genero = $genero;
        $this->paginas = $paginas;
        $this->descripcion = $descripcion;
    }

        function getISBN() {
        return $this->isbn;
    }

    function getID() {
        return $this->id_autor;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getGenero() {
        return $this->genero;
    }

    function getPaginas() {
        return $this->paginas;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function setISBN($ISBN) {
        $this->isbn = $ISBN;
    }

    function setID($ID) {
        $this->id_autor = $ID;
    }

    function setTitulo($Titulo) {
        $this->titulo = $Titulo;
    }

    function setGenero($Genero) {
        $this->genero = $Genero;
    }

    function setPaginas($Paginas) {
        $this->paginas = $Paginas;
    }

    function setDescripcion($Descripcion) {
        $this->descripcion = $Descripcion;
    }

    
    function set($valores, $inicio=0){
        $i=0;
        foreach ($this as $indice => $valor) {
            $this->$indice=$valores[$i+$inicio];
            $i++;
        }
    }
    
    function getGenerico(){
        $array = array();
        foreach ($this as $indice => $valor) {
            $array[$indice]=$valor;
        }
        return $array;
    }
    
    public function __toString() {
        $r ="";
        foreach ($this as $key => $valor) {
            $r .= "$valor ";
        }
        return $r;
    }
    
    //Con este método, del tirón, leo el objeto entero. Lee todos los parámetros, y ya los tiene preparados
    function read(){
        foreach ($this as $key=> $valor) {
            $this->$key= Request::req($key);
        }
    }
}


