  <!DOCTYPE doctype html>
  <?php  


    include '../../php/DTO/UsuarioDTO.php';
     include '../../php/controller/CtrlEmpleados.php';
   
    session_start();
    // error_reporting(0);
    $sesion  = $_SESSION['usuario'];
    $usuario = unserialize($sesion);
    //Se valida si hay sesión o no
    if (!isset($sesion)) {
        header("Location:../../index.html");
        die();
    }else if(isset($sesion)){

        if($usuario->getStatus()!=3){
          header("Location:../../vistas/iniciar_sesion/acceso_denegado.php");

        }
    }

  ?>
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
                                        Guía de Referencia IV
                                    </h2>
                                </strong>
                                <br/>
                                Norma Oficial Mexicana NOM-035-STPS-2018, Factores de Riesgo Psicosocial en el Trabajo.
                            </span>
                            <br/>
                        </h4>
                        <p>
                            
                        </p>
                        
                    </center>
                </div>
                <!-- /container -->
            </hr>
        </main>
         
        <div class="container-norma"> 

        <div class="card" id="datos_emp">
          <h4 class="card-header"><strong>Guia IV</strong></h4>              
          <div class="card-body">
                         <center><div style="width: 60%"><h4>En este espacio se mostrarán las políticas de la institución para la identificación, análisis y prevención de los Factores de riesgo psicosocial en el trabajo.</h4></div></center>
          </div></div> </div><br/><br/><br/><br/><br/>
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
          <script src="../../resources/bootstrap/js/bootstrap.min.js"></script>
          <script src="../../resources/js/jquery-ui.js"></script>
         

         
      </body>
  </html>
