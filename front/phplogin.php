<?php

require '../clases/AutoCarga.php';
$bd = new DataBase();
$log=  Request::post("login");
$pas= Request::post("password");
$gestor = new ManageUsuario($bd);

$rid=$gestor->getUsuarioTrue($log,$pas);
if($rid==1){
$sesion=new Session();
$sesion->set("usuario",$log);
}
else{
    $r=-1;
}
header('Location:index.php?r='.$r);
