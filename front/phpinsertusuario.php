<?php

require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageUsuario($bd);
$usuario=new Usuario();

$usuario->read();
$rUsuario = $gestor->insert($usuario);
$bd->close();
header('Location:index.php?opUsuario=insert&rUsuario='.$rUsuario);


