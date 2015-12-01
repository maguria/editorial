<?php

class ManageLibro {
    private $bd = null;
    private $tabla = "libro";
    
    function __construct(DataBase $bd) {
        $this->bd = $bd;
    }
    
    function get($ISBN){
        $parametros = array();
        $parametros["isbn"]=$ISBN;
        $this->bd->select($this->tabla, "*", "isbn = :isbn",$parametros );
        $row = $this->bd->getRow();
        $libro = new Libro();
        $libro->set($row);
        return $libro;
    }
    
    function count($condicion="1=1", $parametros=array()){
        return $this->bd->count($this->tabla, $condicion, $parametros);
    }
    
    function delete($ISBN){
        $parametros=array();
        $parametros["isbn"]=$ISBN;
        return $this->bd->delete($this->tabla, $parametros);
    }
   function deleteLibros($parametros){
        return $this->bd->delete($this->tabla, $parametros);
    }
    
     function forzarDelete($isbn){
        $parametros=array();
        $parametros["isbn"]=$isbn;
        $gestorDescarga=new ManageDescarga($this->bd);
        $gestorDescarga->deleteDescargas($parametros);
        return $this->bd->delete($this->tabla, $parametros); 
    }
    function erase(Libro $libro){
        return $this->delete($libro->getISBN());
    }
    
    function set(Libro $libro){
        //update de todos los campos menos el ID, devuelve el num de filas modificadas 
        //$parametrosSet=$city->getGenerico();
        /*foreach ($city as $key => $value) {
            $parametrosSet[$key] = $value;
        }*/
        $parametrosWhere=array();
        $parametrosWhere["isbn"]=$libro->getISBN();
        return $this->bd->update($this->tabla, $libro->getGenerico(), $parametrosWhere);
        
    }
    
    function insert(Libro $libro){
        //inserta un objeto City y devuelve el ID
        return $this->bd->insert($this->tabla, $libro->getGenerico(), FALSE);
    }
    
   /* function getList($pagina=1,$nrpp=Contants::NRPP){
        $registroInicial=($pagina-1)*$nrpp;
        $this->bd->select($this->tabla, "*", "1=1", array(), "titulo","$registroInicial,$nrpp");
        $r=array();
        /*El 1,10 del ultimo parametro es el limite de registros por pagina*/
        
       /* while($row = $this->bd->getRow()){
            $libro = new Libro();
            $libro->set($row);
            $r[]=$libro;
        }
        return $r;
    }*/
    
    function getList($pagina=1,$orden="",$nrpp=Contants::NRPP){
        
        $ordenPredeterminado="$orden, titulo";
        if($orden==="" || $orden===null){
             $ordenPredeterminado="titulo";
        }
      
        $registroInicial=($pagina-1)*$nrpp;
        $this->bd->select($this->tabla, "*", "1=1", array(), $ordenPredeterminado,"$registroInicial,$nrpp");
        $r=array();
        /*El 1,10 del ultimo parametro es el limite de registros por pagina*/
        
        while($row = $this->bd->getRow()){
            $libro = new Libro();
            $libro->set($row);
            $r[]=$libro;
        }
        return $r;
    }
    
    /*function getByTitulo($titulo){
        
        $parametros=array();
        $parametros["titulo"]=$titulo;
        $this->bd->select($this->tabla, "*", "titulo=:titulo", $parametros);
        $r=array();
        while($row = $this->bd->getRow()){
            $libro = new Libro();
            $libro->set($row);
            $r[]=$libro;
        }
        return $r;
    }*/
    
    function getListConNombreAutor($titulo){
        
        $parametros=array();
        $parametros["titulo"]="%".$titulo."%";
        $sql="select li.*, au.* from libro li inner join autor au on li.id_autor=au.id_autor where li.titulo LIKE :titulo";
        
        $this->bd->send($sql, $parametros);
        $r=array();
        $contador=0;
        
        while($row = $this->bd->getRow()){
            $libro = new Libro();
            $libro->set($row);
            $autor=new Autor();
            $autor->set($row,6);
            
            $r[$contador]["libro"]=$libro;
            $r[$contador]["autor"]=$autor;
            $contador++;
        }
        return $r;
        
    }
    
    function getListInnerAutor(){
        
        $parametros=array();
        $sql="select li.*, au.* from libro li inner join autor au on li.id_autor=au.id_autor"; 
        $this->bd->send($sql, $parametros);
        $r=array();
        $contador=0;
        
        while($row = $this->bd->getRow()){
            $libro = new Libro();
            $libro->set($row);
            $autor=new Autor();
            $autor->set($row,6);
            
            $r[$contador]["libro"]=$libro;
            $r[$contador]["autor"]=$autor;
            $contador++;
        }
        return $r;
        
    }
    
    function getListBookByAutor($apellido){
        
        $parametros=array();
        $parametros["apellidos"]="%".$apellido."%";
        $sql="select li.*, au.* from libro li inner join autor au on li.id_autor=au.id_autor where au.apellidos LIKE :apellidos";
        
        $this->bd->send($sql, $parametros);
        $r=array();
        $contador=0;
        
        while($row = $this->bd->getRow()){
            $libro = new Libro();
            $libro->set($row);
            $autor=new Autor();
            $autor->set($row,6);
            
            $r[$contador]["libro"]=$libro;
            $r[$contador]["autor"]=$autor;
            $contador++;
        }
        return $r;
        
    }
    
    function getValueSelect(){
        //$table, $proyeccion="*", $parametros=array(), $orden="1", $limite=""
        $this->bd->query($this->tabla, "isbn,titulo", array(), "titulo");
        $array =array();
        while ($row=  $this->bd->getRow()){
            $array[$row[0]]=$row[1];
        }
        return $array;
    }

}

?>