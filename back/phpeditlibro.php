<?php
require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageLibro($bd);
$libro=new Libro();

$libro->read();
$pkisbn=  Request::post('pkisbn');
$r=$gestor->set($libro, $pkisbn);

$bd->close();
header('Location:libros.php?opLibro=edit&rLibro='.$r);
