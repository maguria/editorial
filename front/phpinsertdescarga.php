<?php

require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageDescarga($bd);
$descarga=new Descarga();
$descarga->read();
$rDescarga = $gestor->insert($descarga);
$bd->close();

header('Location:index.php?opDescarga=insert&rDescarga='.$rDescarga);


