<?php
require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageDescarga($bd);
$id= Request::get("id_descarga");
$rDescarga=$gestor->delete($id);


$bd->close();
header('Location:descargas.php?opDescarga=delete&rLibro='.$rDescarga);