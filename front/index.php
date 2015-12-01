<?php
 require '../clases/AutoCarga.php';
 $sesion=new Session();

    $bd = new DataBase();
    $gestorUsuario= new ManageUsuario($bd);
    $gestorDescarga=new ManageDescarga($bd);
    $gestorAutor=new ManageAutor($bd);
    $gestorLibro=new ManageLibro($bd);
    $registrosLibro=$gestorLibro->count();
    $lib=new Libro();
    $au=new Autor();
    $log=$sesion->get("usuario");
    $iddescarga=$gestorUsuario->getIdByName($log);
    
    var_dump($iddescarga);
    
    $page=  Request::get('page');
    if($page===null || $page===""){
        $page=1;
    }
    $paginasLibro=ceil($registrosLibro /  Contants::NRPP);
    
    
    $opUsuario = Request::get("opUsuario");
    $rUsuario = Request::get("rUsuario");
    
    $opDescarga=  Request::get("opDescarga");
    $rDescarga=  Request::get("rDescarga");
    
    $r=  Request::get("r");
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
            <img src="book.jpg" />
            <div class="izquierda">
                <form method="POST">
                    <input type="submit" name="registrarse" value="Registrarse" />
                    <input type="submit" name="identificarse" value="Identificarse" />
                </form>
                
                <?php
                
                
                $reg=  Request::post("registrarse");
                if($reg){
                ?>
                    <form method="POST" action="phpinsertusuario.php">
                        Nombre:<sup>*</sup>
                        <input required type="text" name="nombre" />
                        <br/> Apellidos:
                        <sup>*</sup>
                        <input required type="text" name="apellidos" />
                        <br/> Login:
                        <sup>*</sup>
                        <input required type="text" name="login" />
                        <br/> Password:
                        <sup>*</sup>
                        <input required type="password" name="password" />
                        <br/>
                        <input type="submit" name="alta" value="Alta" />
                    </form>
                    <?php
                }
                if($opUsuario!=null && $rUsuario!=-1){
                    echo "<p>Se ha dado de alta satisfactoriamente.</p><p>Por favor, identifíquese para acceder</p>";
                }
                
                
                $identificarse=  Request::post("identificarse");
                if($identificarse){
                    
                ?>
                        <form method="POST" action="phplogin.php">
                            Login:<sup>*</sup>
                            <input required type="text" name="login" />
                            <br/> Password:
                            <sup>*</sup>
                            <input required type="password" name="password" />
                            <br/>
                            <input type="submit" name="iden" value="Iniciar sesión" />
                        </form>
                        <?php
                }
                if($sesion->get("usuario")){
                    echo "Sesión iniciada <b>".$sesion->get("usuario")."</b>";
                    
                    if($opDescarga!=null & $rDescarga!=-1){
                        echo "<h3>La descarga se ha realizado correctamente</h3>";
                    }
                    
                 
                ?>
                            <form method="POST" action="phplogout.php">
                                <input type="submit" name="cerrar" value="Cerrar sesión" />
                            </form>
            </div>
            <div class="libros">
                <form method="POST">
                    <h3>Buscar por titulo</h3> Introduzca el título del libro a buscar:
                    <input type="text" name="porTitulo" />
                    <input type="submit" name="verporTitulo" value="Buscar" />
                </form>
                <?php
                
                $buscaLibro=  Request::post("verporTitulo");
                if($buscaLibro){
                $portitulo=  Request::post("porTitulo");
                
                
                //$libros=$gestorLibro->getLibroAutorPorTitulo($portitulo);
                  $libroAutor=$gestorLibro->getListConNombreAutor($portitulo);
                ?>
                    <table border="1" class="tablaclara">
                        <tr>
                            <th colspan="7">
                                <p>Libros encontrados</p>
                            </th>
                        </tr>
                        <tr>
                            <th>Título</th>
                            <th>Género</th>
                            <th>Descripción</th>
                            <th>Número de páginas</th>
                            <th colspan="2">Autor</th>
                            <th>Acción
                                <th>
                        </tr>

                        <?php
                
                
                foreach ($libroAutor as $indice => $la) {          
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
                                        <input type='button' name='insertdescarga' value='Descargar' class="insertadescarga">
                                    </a>
                                </td>

                            </tr>

                            <?php
                          
                }
                }
                 ?>
                    </table>
                   <form method="POST">
                            <h3>Buscar por autor</h3> Introduzca el primer apellido del autor:
                            <input type="text" name="porAutor" />
                            <input type="submit" name="verporAutor" value="Buscar" />
                        </form>
                        <?php
                $buscaLibroAutor=  Request::post("verporAutor");
                if($buscaLibroAutor){
                $porAutor=  Request::post("porAutor");
                $librosPorAutor=$gestorLibro->getListBookByAutor($porAutor);               
                
                ?>
                            <table border="1" class="tablaclara">
                                <tr>
                                    <th colspan="7">
                                       <p>Libros encontrados</p>
                                    </th>
                                </tr>
                                <tr>
                                    <th>Título</th>
                                    <th>Género</th>
                                    <th>Descripción</th>
                                    <th>Número de páginas</th>
                                    <th>Acción
                                        <th>
                                </tr>

                                <?php
               foreach ($librosPorAutor as $indice => $la) {    
                   
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
                                            <a class='pide' href='phpinsertdescarga.php?id_usuario=<?php echo $iddescarga; ?>&isbn=<?php echo $la["libro"]->getISBN(); ?>'>
                                                <input type='button' name='insertadescarga' value='Descargar' class="insertadescarga">
                                            </a>
                                        </td>
                                    </tr>

                                    <?php
                          }
                }
                 ?>
                            </table>
                <form method="POST" action="vertodoslibros.php">
                    <input type="submit" name="enviar" value="Ver todos nuestros libros" class="ver"/>
                </form>

            </div>
            <?php
                }
                else if($r==-1){
                    echo "Datos incorrectos. Vuelva a intentarlo o regístrese";
                }
                 ?>

        </div>
    </body>

    </html>
