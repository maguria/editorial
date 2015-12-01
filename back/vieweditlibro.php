 <?php
    require '../clases/AutoCarga.php';
    $bd = new DataBase();
    $gestor = new ManageLibro($bd);
    $isbn = Request::get("isbn");
    $libro = $gestor->get($isbn);
 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <form method="POST" action="phpeditlibro.php">
            ISBN: <input type="text" name="isbn" value="<?php echo $libro->getISBN(); ?>"/><br/>
            Id_Autor: <input type="text" name="id_autor" value="<?php echo $libro->getID(); ?>"/><br/>
            Título: <input type="text" name="titulo" value="<?php echo $libro->getTitulo(); ?>" /><br/>
            Genero: <input type="text" name="genero" value="<?php echo $libro->getGenero(); ?>" /><br/>
            Páginas: <input type="text" name="paginas" value="<?php echo $libro->getPaginas(); ?>" /><br/>
            Descripción: <input type="text" name="descripcion" value="<?php echo $libro->getDescripcion(); ?>" /><br/>
         
            
            <input type="hidden" name="pkisbn" value="<?php echo $libro->getISBN(); ?>" /><br/>
            <input type="submit" value="Editar"/>
        </form>
    </body>
</html>
<?php
$bd->close();
?>