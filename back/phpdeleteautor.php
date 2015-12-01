<?php
require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageAutor($bd);
$id_autor= Request::get("id_autor");
$forze=  Request::get("f");

 $r = $gestor->forzarDelete($id_autor);

$bd->close();
header('Location:autores.php?opAutor=delete&rAutor='.$r);