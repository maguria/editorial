<?php

require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageUsuario($bd);
$id= Request::get("id_usuario");

if($forze===null){
    $r=$gestor->delete($id);
}
else{
    $r = $gestor->forzarDelete($id);
}

$bd->close();
header('Location:usuarios.php?opUsuario=delete&rUsuario='.$r);
