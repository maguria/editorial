<?php
    require '../clases/AutoCarga.php';
    $bd = new DataBase();
    $u=  Request::post("usuarios");
    $gestorUsuario=new ManageUsuario($bd);

    
    $page=  Request::get('page');
    if($page===null || $page===""){
        $page=1;
    }
    $registrosUsuario=$gestorUsuario->count();
    
    $paginasUsuario=ceil($registrosUsuario /  Contants::NRPP);
    
    $usuarios=$gestorUsuario->getList($page);
    
    $usu=new Usuario();
    
    $opUsuario=Request::get("opUsuario");
    $rUsuario = Request::get("rUsuario");
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
            <div class="cabecera"><h1 class="titulo">Editorial ¡Qué locura!</h1><h3 class="subtitulo">Usuarios</h3></div>
            <img src="book.jpg" />
        <div class="apartado">
         <?php
       
        if($opUsuario!=null){
            echo "<h3>La operacion $opUsuario ha dado como resultado $rUsuario</h3>";
        }
        ?>
                     <table border="1">
                        <th colspan="7">
                            <h2>Usuarios</h2>
                        </th>
                        <tr>
            <?php
            $gusu=$usu->getGenerico();
    
            foreach($gusu as $key=>$value){
                ?>
                                <th class="thdos">
                                    <?php echo $key;?>
                                </th>
                                <?php
                 }
                 ?>
                                    <th class="thdos">Acciones</th>
                        </tr>
                        <?php
            foreach ($usuarios as $indice => $usuario) {
                
                ?>
                            <tr>
                                <td>
                                    <?php echo $usuario->getID()?>
                                </td>
                                <td>
                                    <?php echo $usuario->getNombre(); ?>
                                </td>
                                <td>
                                    <?php echo $usuario->getApellidos(); ?>
                                </td>
                                <td>
                                    <?php echo $usuario->getLogin(); ?>
                                </td>
                                <td>
                                    <?php echo $usuario->getPassword(); ?>
                                </td>

                                <td>
                                    <?php echo "<a  href='phpdeleteusuario.php?f=forzar&id_usuario={$usuario->getID()}'><input type='button' name='borrar' value='Borrar' class='inserta'></a>"; ?></td>
                                
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
                                        <a href="?page=<?php echo min($page+1,$paginasUsuario); ?>">
                                            <input type="button" name="siguiente" value="Siguiente" />
                                        </a>
                                        <a href="?page=<?php echo $paginasUsuario; ?>">
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