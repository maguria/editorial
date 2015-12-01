<?php
    require '../clases/AutoCarga.php';
    $sesion=new Session();
    $bd = new DataBase();
    $gestorAutor = new ManageAutor($bd);
    $gestorLibro=new ManageLibro($bd);
    $gestorUsuario=new ManageUsuario($bd);
    
    $registrosLibro=$gestorLibro->count();
    $lib=new Libro();
    $au=new Autor();
    
    $page=  Request::get('page');
    if($page===null || $page===""){
        $page=1;
    }
    $paginasLibro=ceil($registrosLibro /  Contants::NRPP);
    
    $ver=Request::post("enviar");
    
    $libros=$gestorLibro->getListInnerAutor();
    ?>
<html>
    <head>
        <meta charset="UTF-8">
         <link rel="stylesheet" href="../css/main.css" />
        <title></title>
    </head>
    <body>
        <div class="englobafront">
            <div class="cabecera">
                <h1 class="titulo">Editorial ¡Qué locura!</h1>

            </div>
            <div class="apartado tabla">
            <table border="1">
                                <tr>
                                    <th colspan="7">
                                <p>Nuestros libros</p>
                                </th>
                                </tr>
                                <tr>
                                    <th>Título</th>
                                    <th>Género</th>
                                    <th>Descripción</th>
                                    <th>Número de páginas</th>
                                    <th colspan="2">Autor</th>
                                    <th>Acción <th>
                                </tr>

                                <?php
                                $iddescarga=$gestorUsuario->getIdByName($sesion->get("usuario"));
                                    foreach ($libros as $indice => $la) {    
                   
                                 ?>
                                    <tr>
                                        <td>
                                            <?php echo $la["libro"]->getTitulo(); ?>
                                        </td>
                                        <td>
                                            <?php echo $la["libro"]->getGenero(); ?>
                                        </td>
                                        <td>
                                            <?php echo $la["libro"]->getDescripcion(); ?>
                                        </td>
                                        <td>
                                            <?php echo $la["libro"]->getPaginas(); ?>
                                        </td>
                                        <td>
                                            <?php echo $la["autor"]->getNombre();?>
                                        </td>
                                        <td>
                                         <?php echo $la["autor"]->getApellidos(); ?>
                                        </td>

                                        <td>
                                            <a class='pide' href='phpinsertdescarga.php?id_usuario=<?php echo $iddescarga; ?>&isbn=<?php echo $la["libro"]->getISBN(); ?>'>
                                                <input type='button' name='insertadescarga' value='Descargar' class="insertadescarga">
                                            </a>
                                        </td>
                                    </tr>
                     
                                    <?php
                                    }
                
                             ?>
                                     <tr>
                                    <td colspan="7" class="pagina">
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
                                    </td>
                                </tr>
                            </table>
                <div class="volver"><a href="index.php"><input type="button" name="volver" value="Volver a la página principal"/></a></div>
            </div>
    </body>
</html>
