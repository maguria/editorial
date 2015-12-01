 <?php
    require '../clases/AutoCarga.php';
    $bd = new DataBase();
    $gestor = new ManageAutor($bd);
    $id_autor = Request::get("id_autor");
    $autor = $gestor->get($id_autor);
 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <form method="POST" action="phpeditautor.php">
            Id_Autor: <input type="text" name="id_autor" value="<?php echo $autor->getID(); ?>"/><br/>
            Nombre: <input type="text" name="nombre" value="<?php echo $autor->getNombre(); ?>" /><br/>
            Apellidos: <input type="text" name="apellidos" value="<?php echo $autor->getApellidos(); ?>" /><br/>
            Fecha de Nacimiento: <input type="text" name="fechaNacimiento" value="<?php echo $autor->getFechaNacimiento(); ?>" /><br/>
            <input type="hidden" name="pkid_autor" value="<?php echo $autor->getID(); ?>" /><br/>
            <input type="submit" value="Editar"/>
        </form>
    </body>
</html>
<?php
$bd->close();
?>