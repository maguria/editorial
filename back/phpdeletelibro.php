<?php
require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageLibro($bd);
$isbn= Request::get("isbn");
$r = $gestor->forzarDelete($isbn);


$bd->close();
header('Location:libros.php?opLibro=delete&rLibro='.$r);