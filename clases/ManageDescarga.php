<?php

class ManageDescarga {
    private $bd = null;
    private $tabla = "descarga";
    
    function __construct(DataBase $bd) {
        $this->bd = $bd;
    }
    
    function get($IDDescarga){
        $parametros = array();
        $parametros["id_descarga"]=$IDDescarga;
        $this->bd->select($this->tabla, "*", "id_descarga = :id_descarga",$parametros );
        $row = $this->bd->getRow();
        $descarga = new Descarga();
        $descarga->set($row);
        return $descarga;
    }
    
    function deleteDescargas($parametros){
        return $this->bd->delete($this->tabla, $parametros);
    }
    
    function count($condicion="1=1", $parametros=array()){
        return $this->bd->count($this->tabla, $condicion, $parametros);
    }
    function delete($ID){
        $parametros=array();
        $parametros["id_descarga"]=$ID;
        return $this->bd->delete($this->tabla, $parametros);
    }
   
    
    function erase(Descarga $descarga){
        return $this->delete($descarga->getID());
    }
    
    function set(Descarga $descarga){
        //update de todos los campos menos el ID, devuelve el num de filas modificadas 
        //$parametrosSet=$city->getGenerico();
        /*foreach ($city as $key => $value) {
            $parametrosSet[$key] = $value;
        }*/
        $parametrosWhere=array();
        $parametrosWhere["id_descarga"]=$descarga->getID();
        return $this->bd->update($this->tabla, $descarga->getGenerico(), $parametrosWhere);
        
    }
    
    function insert(Descarga $descarga){
        return $this->bd->insert($this->tabla, $descarga->getGenerico());
    }
    
    function getList($pagina=1,$nrpp=Contants::NRPP){
        $registroInicial=($pagina-1)*$nrpp;
        $this->bd->select($this->tabla, "*", "1=1", array(),"id_descarga","$registroInicial,$nrpp");
        $r=array();
        /*El 1,10 del ultimo parametro es el limite de registros por pagina*/
        
        while($row = $this->bd->getRow()){
            $descarga = new Descarga();
            $descarga->set($row);
            $r[]=$descarga;
        }
        return $r;
    }
    
    
    function getValueSelect(){
        //$table, $proyeccion="*", $parametros=array(), $orden="1", $limite=""
        $this->bd->query($this->tabla, "id_descarga", array());
        $array =array();
        while ($row=  $this->bd->getRow()){
            $array[$row[0]]=$row[1];
        }
        return $array;
    }

}

?>