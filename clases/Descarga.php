<?php

class Descarga {
    private $id_descarga, $id_usuario,$isbn;
    
    
    function __construct($id_descarga=null, $id_usuario=null, $isbn=null) {
        $this->id_descarga = $id_descarga;
        $this->id_usuario = $id_usuario;
        $this->isbn = $isbn;
    }

        function getID() {
        return $this->id_descarga;
    }

    function getIDUsuario() {
        return $this->id_usuario;
    }

    function getISBN() {
        return $this->isbn;
    }

    function setID($ID) {
        $this->id_descarga = $ID;
    }

    function setIDUsuario($IDUsuario) {
        $this->id_usuario = $IDUsuario;
    }

    function setISBN($ISBN) {
        $this->isbn = $ISBN;
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
