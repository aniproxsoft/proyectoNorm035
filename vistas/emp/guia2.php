  <!DOCTYPE doctype html>
  <html lang="en">

  <?php
    require_once ("../../php/controller/CtrlGuia2.php");
    require_once ("../../php/DTO/PreguntaDTO.php");
    include '../../php/controller/CtrlEmpleados.php';
    include '../../php/DTO/UsuarioDTO.php';
    $ctrlEmpleados= new CtrlEmpleados();
    $listaNivelesEstudios= $ctrlEmpleados->getNivelEstudios();
    $divisiones=$ctrlEmpleados->getDivisiones();
    $listaPuestos=$ctrlEmpleados->getPuestos();
    session_start();
    // error_reporting(0);
    $sesion  = $_SESSION['usuario'];
    $usuario = unserialize($sesion);
    if (!isset($sesion)) {
        header("Location:../../index.html");
        die();
    }else if(isset($sesion)){

        if($usuario->getStatus()!=2){
          header("Location:../../vistas/iniciar_sesion/acceso_denegado.php");

        }
    }

  ?>
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
                              <link href="../../resources/bootstrap/css/bootstrap.css" rel="stylesheet"></link>
                                  <!-- Custom styles for this template -->
                                  <link href="../../resources/bootstrap/css/jumbotron.css" rel="stylesheet"></link>
                                      <link href="../../resources/bootstrap/css/sticky-footer-navbar.css" rel="stylesheet">
                                      </link></link>
                                      <link href="../../resources/css/jquery-ui.css" rel="stylesheet"></link>
                                      <link href="../../resources/css/norma.css" rel="stylesheet"></link>
                              
                      </meta>
                  </meta>
              </meta>
          </meta>
      </head>
      <body>
        
        <input type="hidden" name="usuario" id="usuario" value="<?php echo $usuario->getNum_empleado()?>">
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
                              <!--<a class="nav-link active" href="emp_index.php">
                                Inicio
                              </a>-->
                          </li>
                      </ul>
                    <!--  <a class="btn btn-primary" href="../../vistas/iniciar_sesion/iniciar_sesion.html">
                          Ingresar </a>-->
                  </div>
              </nav>
          </header>
          <main role="main">     
        
       <main role="main">
         
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
                                        Guía de Referencia II
                                    </h2>
                                </strong>
                                <br/>
                                Norma Oficial Mexicana NOM-035-STPS-2018, Factores de Riesgo Psicosocial en el Trabajo.
                            </span>
                            <br/>
                        </h4>
                        <p>
                            <strong>
                                CUESTIONARIO PARA IDENTIFICAR LOS FACTORES DE RIESGO PSICOSOCIAL EN LOS CENTROS
                                DE TRABAJO.
                            </strong>
                        </p>
                        
                    </center>
                </div>
                <!-- /container -->
            </hr>
        </main>
      <hr>
     <center>
        <h3>Contesta la Guía que se le indica</h3>
      </center>
      <form id="formulario">
        <div class="container-norma"  id="contenedor" name="con1" style="display: block;"> 
          <div class="card">            
            <div id="tab" class="card-body">
              <center id="contestar">
              <button  class="btn-primary btn" onclick="contestar()">Contestar</button>
              </center>         
            </div>
          </div>
        </div>
         <!-- /container -->
         <!-- Button trigger modal -->
          

          <!-- Modal -->
          <div class="modal fade" id="seccionModal" tabindex="-1" role="dialog" 
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body" id="seccion_desc">
                  
                </div>
                <div class="modal-footer" id="botones_modal">
                  
                </div>
              </div>
            </div>
          </div>
        <br>
        
        
         </form>
        <br/>
        <br/>
          <br/>
          <br/>
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
                      <a href="#" style="color: white; ">
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
          <script src="../../resources/bootstrap/js/bootstrap.min.js"></script>
          <script src="../../resources/js/jquery-ui.js"></script>
          <script src="../../resources/js/guia2.js"></script>
          <script>
          </script>
      </body>
  </html>
