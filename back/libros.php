<?php
    require '../clases/AutoCarga.php';
    $bd = new DataBase();
    $gestorLibro=new ManageLibro($bd);
    $li=  Request::post("libros");
    
    $page=  Request::get('page');
    if($page===null || $page===""){
        $page=1;
    }

    $registrosLibro=$gestorLibro->count();

    $paginasLibro=ceil($registrosLibro /  Contants::NRPP);

    $libros=$gestorLibro->getList($page);
    
    $lib=new Libro();
    $opLibro = Request::get("opLibro");
    $rLibro = Request::get("rLibro");

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
            <div class="cabecera"><h1 class="titulo">Editorial ¡Qué locura!</h1><h3 class="subtitulo">Libros</h3></div>
            <img src="book.jpg" />
        <div class="apartado">
          <?php
            if($opLibro!=null){
              echo "<h3>La operacion $opLibro ha dado como resultado $rLibro</h3>";
             }
            ?>
                     <table border="1">
                        <th colspan="8">
                            <h2>Libros</h2>
                        </th>
                        <tr>
                            <?php
            $g=$lib->getGenerico();
    
            foreach($g as $key=>$value){
                ?>
                                <th class="thdos">
                                    <?php echo $key;?>
                                </th>
                                <?php
            }
            ?>
                                    <th colspan="2" class="thdos">Acciones</th>
                        </tr>
                        <?php
            foreach ($libros as $indice => $libro) {
                
                ?>
                            <tr>
                                <td>
                                    <?php echo $libro->getISBN();?>
                                </td>
                                <td>
                                    <?php echo $libro->getID(); ?>
                                </td>
                                <td>
                                    <?php echo $libro->getTitulo();?>
                                </td>
                                <td>
                                    <?php echo $libro->getGenero();?>
                                </td>
                                <td>
                                    <?php echo $libro->getPaginas(); ?>
                                </td>
                                <td>
                                    <?php echo $libro->getDescripcion();?>
                                </td>

                                <td>
                                    <?php echo "<a class='borrar' href='phpdeletelibro.php?isbn={$libro->getISBN()}'><input type='button' name='borrar' value='Borrar' class='inserta'></a>"; ?></td>
                                <td>
                                    <?php echo "<a href='vieweditlibro.php?isbn={$libro->getISBN()}'><input type='button' name='editar' value='Editar' class='inserta'></a>"; ?></td>
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
                                            <a href="?page=<?php echo min($page+1,$paginasLibro); ?>">
                                                <input type="button" name="siguiente" value="Siguiente" />
                                            </a>
                                            <a href="?page=<?php echo $paginasLibro; ?>">
                                                <input type="button" name="ultima" value="Última página" />
                                            </a>
                                            <a href="index.php" class="volver2"><input type="button" name="volver" value="Volver a la página principal"/></a>
                                        </td>
                                    </tr>
          
                    </table>
                    <form action="viewInsertLibro.php" method="POST">
                        <input type="submit" name="insertaLibro" value="Insertar nuevo libro" class="inserta">
                    </form>
          
            </div>
           
        </div>
    </body>
</html>
<?php
$bd->close();
?>