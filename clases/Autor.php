<?php

class Autor {
    private $id_autor, $nombre, $apellidos, $fechaNacimiento;
    
    //1º constructor -> null
    function __construct($id_autor=null, $nombre=null, $apellidos=null, $fechaNacimiento=null) {
        $this->id_autor = $id_autor;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->fechaNacimiento = $fechaNacimiento;
    }

        //2º Métodos get y set de la clase
    public function getID() {
        return $this->id_autor;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getApellidos() {
        return $this->apellidos;
    }

    public function getFechaNacimiento() {
        return $this->fechaNacimiento;
    }


    public function setID($ID) {
        $this->id_autor = $ID;
    }

    public function setNombre($Nombre) {
        $this->nombre = $Nombre;
    }

    public function setApellidos($Apellidos) {
        $this->apellidos = $Apellidos;
    }

    public function setFechaNacimiento($FechaNacimiento) {
        $this->fechaNacimiento = $FechaNacimiento;
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


