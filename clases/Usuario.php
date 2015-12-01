<?php

class Usuario {
    private $id_usuario, $nombre, $apellidos,$login,$password;
    
    function __construct($id_usuario=null, $nombre=null, $apellidos=null, $login=null, $password=null) {
        $this->id_usuario = $id_usuario;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->login = $login;
        $this->password = $password;
    }

    

    function getID() {
        return $this->id_usuario;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getApellidos() {
        return $this->apellidos;
    }

    function getLogin() {
        return $this->login;
    }

    function getPassword() {
        return $this->password;
    }

    function setID($IDUsuario) {
        $this->id_usuario = $IDUsuario;
    }

    function setNombre($Nombre) {
        $this->nombre = $Nombre;
    }

    function setApellidos($Apellidos) {
        $this->apellidos = $Apellidos;
    }

    function setLogin($Login) {
        $this->login = $Login;
    }

    function setPassword($Password) {
        $this->password = $Password;
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