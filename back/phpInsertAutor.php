<?php

require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageAutor($bd);
$autor=new Autor();


$autor->read();
$rAutor = $gestor->insert($autor);
$bd->close();
header('Location:autores.php?opAutor=insert&rAutor='.$rAutor);
