<?php
include '../../php/DTO/UsuarioDTO.php';
session_start();
// error_reporting(0);
$sesion  = $_SESSION['usuario'];
$usuario = unserialize($sesion);
if (!isset($sesion)) {
    header("Location:../../vistas/iniciar_sesion/iniciar_sesion.html");
    die();
}

?>
<!DOCTYPE doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
            <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
                <meta content="" name="description">
                    <meta content="" name="author">
                        <link href="favicon.ico" rel="icon">
                            <title>
                                NOM-035 | Aplicación para evaluar los factores de riesgo psicosociales en el trabajo.
                            </title>
                            <!-- Bootstrap core CSS -->
                            <link href="../../resources/bootstrap/css/bootstrap.css" rel="stylesheet">
                                <!-- Custom styles for this template -->
                                <link href="../../resources/bootstrap/css/jumbotron.css" rel="stylesheet">
                                    <link href="../../resources/bootstrap/css/sticky-footer-navbar.css" rel="stylesheet">
                                    </link>
                                </link>
                            </link>
                        </link>
                    </meta>
                </meta>
            </meta>
        </meta>
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
                <a class="navbar-brand" href="#">
                    NOM-035
                </a>
                <button aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler" data-target="#navbarsExampleDefault" data-toggle="collapse" type="button">
                    <span class="navbar-toggler-icon">
                    </span>
                </button>
                <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" 
                                href="<?php if($usuario->getRol_id()==1){
                                    echo '../adm/adm_index.php';
                                }elseif ($usuario->getRol_id()==2 or $usuario->getRol_id()==3) {
                                    echo '../emp/emp_index.php';
                                }?>">
                                Inicio
                            </a>
                        </li>
                    </ul>
                    <div class="btn-group">
                       <?php $usuario->setMenu_user($usuario->getNombre_empleado());
                       echo $usuario->getMenu_user();?>
                   </div>
                </div>
            </nav>
        </header>
        <main role="main">
            <hr>
                <div class="container-norma">
                    <div class="cards">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                </div>
                                <div class="col-md-4">
                                    <img alt="" class="mb-4 rounded mx-auto d-block" height="128" src="../../resources/img/denegado.png" width="128">
                                        <center>
                                            <h2 class="h3 mb-3 font-weight-normal">
                                                !Lo Sentimos!
                                                <br/>
                                                Acceso Denegado
                                            </h2>
                                        </center>
                                    </img>
                                </div>
                                <div class="col-md-4">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /container -->
            </hr>
        </main>
        <br/>
        <br/>
        <br/>
        <footer class="footer">
            <div class="container">
                <p>
                    © 2020 NOM-035, Inc. | WebApp Desarrollada con PHP| Autor: UTN
                    <a href="#" style="color: white;">
                        Privacy
                    </a>
                    ·
                    <a href="#" style="color: white;">
                        Terms
                    </a>
                </p>
            </div>
        </footer>
        <!-- Bootstrap core JavaScript
    ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js">
        </script>
        <script src="../../resources/bootstrap/js/bootstrap.min.js">
        </script>
        <script type="text/javascript">
            function solo_numeros(e){
                var keynum = window.event ? window.event.keyCode : e.which;
                 if ((keynum == 8) || (keynum == 46))
                    return true;
                
                    return /\d/.test(String.fromCharCode(keynum));
                }
        </script>
    </body>
</html>
