<?php
    require '../clases/AutoCarga.php';
   
 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form action="phpInsertAutor.php" method="POST">
            Nombre<sup>*</sup> <input required  type="text" name="nombre" value="" /><br />
            Apellidos<sup>*</sup> <input required  type="text" name="apellidos" value="" /><br />
            Fecha de Nacimiento<sup>*</sup><input required  type="text" name="fechaNacimiento" value="" /><br />
            <input type="submit" value="Insertar" />
        </form>
    </body>
</html>
