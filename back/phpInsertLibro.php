<?php

require '../clases/AutoCarga.php';
$bd = new DataBase();

$gestor = new ManageLibro($bd);
$libro=new Libro();


$libro->read();
$rLibro = $gestor->insert($libro);
$bd->close();
header('Location:libros.php?opLibro=insert&rLibro='.$rLibro);


