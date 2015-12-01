<?php
    require '../clases/AutoCarga.php';
    $bd = new DataBase();
    $gestorAutor = new ManageAutor($bd);
    $page=  Request::get('page');
    if($page===null || $page===""){
        $page=1;
    }
    $registrosAutor=$gestorAutor->count();
    $paginasAutor=ceil($registrosAutor /  Contants::NRPP); //ceil devuelve el primer entero >= que el numero que tengo
    
    $autores = $gestorAutor->getList($page);
    
    $aut=new Autor();  
    
    $opAutor = Request::get("opAutor");
    $rAutor = Request::get("rAutor");
    ?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/main.css" />
         <script src="../js/scripts.js"></script>
        <title></title>
    </head>
    <body>
        <div class="englobaapartado">
            <div class="cabecera"><h1 class="titulo">Editorial ¡Qué locura!</h1><h3 class="subtitulo">Autores</h3></div>
            <img src="book.jpg" />
        <?php
                    if($opAutor!=null){
                         echo "<h3>La operacion $opAutor ha dado como resultado $rAutor</h3>";
                    }
                ?>
                    <div class="apartado">
                    <table border="1">
                        <th colspan="7">
                            <h2>Autores</h2>
                        </th>
                        <tr>
                <?php
                $gen=$aut->getGenerico();
    
                foreach($gen as $key=>$value){
                 ?>
                                <th class="thdos">
                                    <?php echo $key;?>
                                </th>
                <?php
                    }
                ?>
                                    <th colspan="3" class="thdos">Acciones</th>
                        </tr>
                <?php
                foreach ($autores as $indice => $autor) {
                
                ?>
                            <tr>
                                <td>
                                    <?php echo $autor->getID();?>
                                </td>
                                <td>
                                    <?php echo $autor->getNombre();?>
                                </td>
                                <td>
                                    <?php echo $autor->getApellidos(); ?>
                                </td>
                                <td>
                                    <?php echo $autor->getFechaNacimiento()?>
                                </td>


                                <td>
                                    <?php echo "<a class='borrar' href='phpdeleteautor.php?f=forzar&id_autor={$autor->getID()}'><input type='button' name='borrar' value='Borrar' class='inserta'></a>"; ?></td>
                                <td>
                                    <?php echo " <a href='vieweditautor.php?id_autor={$autor->getID()}'><input type='button' name='editar' value='Editar' class='inserta'></a>"; ?></td>

                                <?php
                                }
                                ?>
                                    <tr>
                                        <td colspan="8" class="pagina">
                                            <a href='?page=1'>
                                                <input type="button" name="primera" value="Primera página" />
                                            </a>
                                            <a href="?page=<?php echo max(1, $page-1); ?>">
                                                <input type="button" name="anterior" value="Anterior" />
                                            </a>
                                            <a href="?page=<?php echo min($page+1,$paginasAutor); ?>">
                                                <input type="button" name="siguiente" value="Siguiente" />
                                            </a>
                                            <a href="?page=<?php echo $paginasAutor; ?>">
                                                <input type="button" name="ultima" value="Última página" />
                                            </a>
                                            <a href="index.php" class="volver2"><input type="button" name="volver" value="Volver a la página principal"/></a>
                                        </td>
                                    </tr>
                 

                    </table>
                    <form action="viewInsertAutor.php" method="POST">
                        <input type="submit" name="insertaAutor" value="Insertar nuevo autor" class="inserta">
                    </form>
                    </div>
          
        </div>
    </body>
</html>
<?php
$bd->close();
?>