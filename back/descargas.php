<?php
    require '../clases/AutoCarga.php';
    $bd = new DataBase();
    
    $gestorDescarga=new ManageDescarga($bd);
    
    $page=  Request::get('page');
    if($page===null || $page===""){
        $page=1;
    }
   
    $registrosDescarga=$gestorDescarga->count();
   
    $paginasDescarga=ceil($registrosDescarga /  Contants::NRPP);
   
  
    $descargas=$gestorDescarga->getList($page);
   
    $desc=new Descarga();  
    $d=  Request::post("descargas");
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/main.css" />
        <title></title>
    </head>
    <body>
        <div class="englobaapartado">
            <div class="cabecera"><h1 class="titulo">Editorial ¡Qué locura!</h1><h3 class="subtitulo">Descargas</h3></div>
            <img src="book.jpg" />
         <div class="apartado">
         
                    <table border="1">
                        <th colspan="4">
                            <h2>Descargas</h2>
                        </th>
                        <tr>
                 <?php
                        $gdesc=$desc->getGenerico();
    
                        foreach($gdesc as $key=>$value){
                 ?>
                                <th class="thdos">
                                    <?php echo $key;?>
                                </th>
                                <?php
                    }
                ?>
                                <th class="thdos">Acciones</th>

             <?php
                        foreach ($descargas as $indice => $descarga) {
                            
                ?>
                                        <tr>
                                            <td>
                                                <?php echo $descarga->getID();?>
                                            </td>
                                            <td>
                                                <?php echo $descarga->getIDUsuario(); ?>
                                            </td>
                                            <td>
                                                <?php echo $descarga->getISBN(); ?>
                                            </td>
                                            <td>
                                                <?php echo "<a class='borrar' href='phpdeletedescarga.php?id_descarga={$descarga->getID()}'><input type='button' name='borrar' value='Borrar' class='inserta'></a>"; ?></td>
                                            
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
                                                    <a href="?page=<?php echo min($page+1,$paginasDescarga); ?>">
                                                        <input type="button" name="siguiente" value="Siguiente" />
                                                    </a>
                                                    <a href="?page=<?php echo $paginasDescarga; ?>">
                                                        <input type="button" name="ultima" value="Última página" />
                                                    </a>
                                                    <a href="index.php" class="volver2"><input type="button" name="volver" value="Volver a la página principal"/></a>
                                                </td>
                                            </tr>
   
                    </table>

            </div>
            
        </div>
    </body>
</html>
<?php
$bd->close();
?>
