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
        <form action="phpInsertLibro.php" method="POST">
            ISBN<sup>*</sup> <input required  type="text" name="isbn" value="" /><br />
            IDAutor<sup>*</sup> <input required  type="text" name="id_autor" value="" /><br />
            Titulo<sup>*</sup><input required  type="text" name="titulo" value="" /><br />
            Género<sup>*</sup><input required  type="text" name="genero" value="" /><br />
            Nº Páginas<sup>*</sup><input required  type="number" name="paginas" value="" /><br />
            Descripción<sup>*</sup><input required  type="text" name="descripcion" value="" /><br />
            <input type="submit" value="Insertar" />
        </form>
    </body>
</html>