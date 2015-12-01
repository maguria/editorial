<?php

class ManageAutor {
    private $bd = null;
    private $tabla = "autor";
    
    function __construct(DataBase $bd) {
        $this->bd = $bd;
    }
    
    function get($ID){
        $parametros = array();
        $parametros["id_autor"]=$ID;
        $this->bd->select($this->tabla, "*", "id_autor = :id_autor",$parametros );
        $row = $this->bd->getRow();
        $autor = new Autor();
        $autor->set($row);
        return $autor;
    }
    
    function delete($ID){
        $parametros=array();
        $parametros["id_autor"]=$ID;
        return $this->bd->delete($this->tabla, $parametros);
    }
   
     function forzarDelete($idautor){
        $parametros=array();
        $parametros["id_autor"]=$idautor;
        $gestorLibro=new ManageLibro($this->bd);
        $gestorLibro->deleteLibros($parametros);
        return $this->bd->delete($this->tabla, $parametros); 
    }
    
    function erase(Autor $autor){
        return $this->delete($autor->getID());
    }
    
    function set(Autor $autor){
        //update de todos los campos menos el ID, devuelve el num de filas modificadas 
        
        $parametrosWhere=array();
        $parametrosWhere["id_autor"]=$autor->getID();
        return $this->bd->update($this->tabla, $autor->getGenerico(), $parametrosWhere);
        
    }
    
    function insert(Autor $autor){
        //inserta un objeto City y devuelve el ID
        return $this->bd->insert($this->tabla, $autor->getGenerico());
    }
    
   /* function getList($pagina=1,$nrpp=Contants::NRPP){
        $registroInicial=($pagina-1)*$nrpp;
        $this->bd->select($this->tabla, "*", "1=1", array(), "nombre,apellidos","$registroInicial,$nrpp");
        $r=array();
        /*El 1,10 del ultimo parametro es el limite de registros por pagina*/
        
       /* while($row = $this->bd->getRow()){
            $autor = new Autor();
            $autor->set($row);
            $r[]=$autor;
        }
        return $r;
    }*/
    
    function count($condicion="1=1", $parametros=array()){
        return $this->bd->count($this->tabla, $condicion, $parametros);
    }
    
    function getList($pagina=1,$orden="",$nrpp=Contants::NRPP){
        
        $ordenPredeterminado="$orden, nombre,apellidos";
        if($orden==="" || $orden===null){
             $ordenPredeterminado="nombre,apellidos";
        }
      
        $registroInicial=($pagina-1)*$nrpp;
        $this->bd->select($this->tabla, "*", "1=1", array(), $ordenPredeterminado,"$registroInicial,$nrpp");
        $r=array();
        /*El 1,10 del ultimo parametro es el limite de registros por pagina*/
        
        while($row = $this->bd->getRow()){
            $autor = new Autor();
            $autor->set($row);
            $r[]=$autor;
        }
        return $r;
    }
    
    
    function getValueSelect(){
        //$table, $proyeccion="*", $parametros=array(), $orden="1", $limite=""
        $this->bd->query($this->tabla, "id_autor, nombre", array(), "nombre");
        $array =array();
        while ($row=  $this->bd->getRow()){
            $array[$row[0]]=$row[1];
        }
        return $array;
    }

}

?>