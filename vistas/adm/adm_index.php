<?php

include '../../php/DTO/UsuarioDTO.php';

session_start();
// error_reporting(0);
$sesion  = $_SESSION['usuario'];
$usuario = unserialize($sesion);
if (!isset($sesion)) {
    header("Location:../../vistas/iniciar_sesion/iniciar_sesion.html");
    die();
}else if(isset($sesion)){
    if(!($usuario->getRol_id()==1)){
        header("Location:../../vistas/iniciar_sesion/acceso_denegado.php");
    }
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
                            <a class="nav-link active" href="adm_index.php">
                                Inicio
                            </a>
                        </li>
                         <li class="nav-item">
                            <a class="nav-link" href="empleados.php">Empleados</a>
                        </li>
                    
                        <li class="nav-item" >
                            <a class="nav-link" href="permisos.php">Permisos de usuario</a>
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
                <div class="card-body-norma">
                    <center>
                        <img alt="Generic placeholder image" class="rounded mx-auto d-block" height="180" src="../../resources/img/utn_256.png" width="180">
                        </img>
                        <h4>
                            UNIVERSIDAD TECNOLÓGICA DE NEZAHUALCÓYOTL
                        </h4>
                        <h4 class="card-title">
                            Organismo Público Descentralizado del Gobierno del Estado de México.
                            <br/>
                            <br/>
                            <span>
                                <strong>
                                    <h2>
                                        Guía de Referencia I
                                    </h2>
                                </strong>
                                <br/>
                                Norma Oficial Mexicana NOM-035-STPS-2018, Factores de riesgo psicosocial en el trabajo.
                            </span>
                            <br/>
                        </h4>
                        <p>
                            <strong>
                                Cuestionario para identificara los trabajadores que fueron sujetos a acontecimientos traumaticos severos y que requieran valoración clínica.
                            </strong>
                        </p>
                        <br/>
                        <!--<button class="btn btn-primary" data-target="#realizarGuiaModal" data-toggle="modal" type="button">
                            Realizar Guía
                        </button>-->
                        <br/>
                        <br/>
                        <span>
                            Para mayores detalles véase
                            <a href="https://www.dof.gob.mx/nota_detalle.php?codigo=5541828&fecha=23/10/2018">
                                https://www.dof.gob.mx/nota_detalle.php?codigo=5541828&fecha;=23/10/2018
                            </a>
                        </span>
                        <br/>
                    </center>
                </div>
                <!-- /container -->
            </hr>
        </main>
        
        <div>
            
        </div>
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
        <script src="../../resources/js/jquery-3.3.1.min.js">
        </script>
        <script src="../../resources/bootstrap/js/bootstrap.min.js">
        </script>
    </body>
</html>
