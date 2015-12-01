<?php
require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageAutor($bd);
$autor=new Autor();

$autor->read();
$pkID=  Request::post('pkid_autor');
$r=$gestor->set($autor, $pkID);

$bd->close();
header('Location:autores.php?opAutor=edit&rAutor='.$r);
