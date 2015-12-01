<?php

class ManageUsuario {
    private $bd = null;
    private $tabla = "usuario";
    
    function __construct(DataBase $bd) {
        $this->bd = $bd;
    }
    
    function get($IDUsuario){
        $parametros = array();
        $parametros["id_usuario"]=$IDUsuario;
        $this->bd->select($this->tabla, "*", "id_usuario = :id_usuario",$parametros );
        $row = $this->bd->getRow();
        $usuario = new Usuario();
        $usuario->set($row);
        return $usuario;
    }
    
    function getIdByName($nombre){
        $parametros=array();
        $parametros["nombre"]=$nombre;
        $this->bd->select($this->tabla, "id_usuario", "nombre = :nombre", $parametros);
        $fila=$this->bd->getRow();
        return $fila[0];  
    }
    function count($condicion="1=1", $parametros=array()){
        return $this->bd->count($this->tabla, $condicion, $parametros);
    }
    
    function delete($IDUsuario){
        $parametros=array();
        $parametros["id_usuario"]=$IDUsuario;
        return $this->bd->delete($this->tabla, $parametros);
    }
    
    
     function forzarDelete($id_usuario){
        $parametros=array();
        $parametros["id_usuario"]=$id_usuario;
        $gestor=new ManageDescarga($this->bd);
        $gestor->deleteDescargas($parametros);
        return $this->bd->delete($this->tabla, $parametros); 
    }
   
    
    function erase(Usuario $usuario){
        return $this->delete($usuario->getID());
    }
    
    function set(Usuario $usuario){
        //update de todos los campos menos el ID, devuelve el num de filas modificadas 
        //$parametrosSet=$city->getGenerico();
        /*foreach ($city as $key => $value) {
            $parametrosSet[$key] = $value;
        }*/
        $parametrosWhere=array();
        $parametrosWhere["id_usuario"]=$usuario->getID();
        return $this->bd->update($this->tabla, $usuario->getGenerico(), $parametrosWhere);
        
    }
    
    function insert(Usuario $usuario){
        //inserta un objeto City y devuelve el ID
        return $this->bd->insert($this->tabla, $usuario->getGenerico());
    }
    
    function getList($pagina=1,$nrpp=Contants::NRPP){
        $registroInicial=($pagina-1)*$nrpp;
        $this->bd->select($this->tabla, "*", "1=1", array(), "nombre,apellidos","$registroInicial,$nrpp");
        $r=array();
        /*El 1,10 del ultimo parametro es el limite de registros por pagina*/
        
        while($row = $this->bd->getRow()){
            $usuario = new Usuario();
            $usuario->set($row);
            $r[]=$usuario;
        }
        return $r;
    }
    
    
    
    function getUsuarioTrue($login,$password){
        $parametros=array();
        $parametros["login"]=$login;
        $parametros["password"]=$password;
        $this->bd->select($this->tabla,"count(*)","login=:login and password=:password",$parametros,"nombre,apellidos");
        $fila= $this->bd->getRow();
        return $fila[0];
        
        
        
    }
 
    //Funcion para sacar todos los usuarios de un libro
       function getListUserbyISBN($ISBN,$pagina=1,$nrpp=Contants::NRPP){
           
        $parametros=array();
        $parametros["isbn"]=$ISBN;
        $registroInicial=($pagina-1)*$nrpp;
        $this->bd->select($this->tabla, "*", "isbn=:isbn", $parametros, "nombre, apellidos","$registroInicial,$nrpp");
        $r=array();
        /*El 1,10 del ultimo parametro es el limite de registros por pagina*/
        
        while($row = $this->bd->getRow()){
            $usuario = new Usuario();
            $usuario->set($row);
            $r[]=$usuario;
        }
        return $r;
    }
    
    
    function getValueSelect(){
        //$table, $proyeccion="*", $parametros=array(), $orden="1", $limite=""
        $this->bd->query($this->tabla, "id_usuario,nombre", array(), "nombre");
        $array =array();
        while ($row=  $this->bd->getRow()){
            $array[$row[0]]=$row[1];
        }
        return $array;
    }

}

?>