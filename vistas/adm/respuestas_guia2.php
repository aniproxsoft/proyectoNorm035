  <?php
    require_once '../../php/controller/CtrlEmpleados.php';
    $ctrlEmpleados= new CtrlEmpleados();

    $num_empleado=base64_decode(filter_input(INPUT_GET, "num"));
    $empleado=$ctrlEmpleados->getEmpleadoSeleccionado($num_empleado);
    $resultadoGuia=$ctrlEmpleados->getResultadoGuia2($num_empleado);
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
                              <link href="../../resources/bootstrap/css/bootstrap.css" rel="stylesheet"></link>
                                  <!-- Custom styles for this template -->
                                  <link href="../../resources/bootstrap/css/jumbotron.css" rel="stylesheet"></link>
                                      <link href="../../resources/bootstrap/css/sticky-footer-navbar.css" rel="stylesheet">
                                      </link></link>
                                      <link href="../../resources/css/jquery-ui.css" rel="stylesheet"></link>
                                      <link href="../../resources/css/norma.css" rel="stylesheet"></link>
                                       <link href="../../resources/font/all.css" rel="stylesheet">
                              
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
          <br>
          <div class="container-norma"  id="contenedor" name="con1" style="display: block;">      
            <div class="card">
              <h4 class="card-header"><strong>Respuestas de la Guía de Referencia II de <?php echo $empleado[0]['nombre_completo']?></strong></h4>              
              <div class="card-body">    
                <div  style="position: relative;height: 450px;overflow: auto;">        
                  <table class="table table-hover " id="respuestas">
                    <thead style="overflow-y: auto; height: 100px; " class="thead-light">
                      <tr>
                        <th style="position: sticky; top: 0; " width="25%" scope="col">Numero</th>
                        <th style="position: sticky; top: 0; " width="25%" scope="col">Pregunta</th> <th style="position: sticky; top: 0; " width="25%" scope="col">Respuesta</th>
                        <th style="position: sticky; top: 0; " width="25%" scope="col">Valor</th>
                      </tr>
                    </thead>
                 
                    <?php foreach($resultadoGuia as $registro) { ?>
                      <tbody>
                        <td scope="row"><?php echo $registro['pregunta_id'] ?></td>
                        <td scope="row"><?php echo $registro['pregunta_desc'] ?></td>
                        <td scope="row"><?php echo $registro['respuesta'] ?></td>
                        <td scope="row"><?php if(is_null($registro['valor_respuesta'])){echo " - ";}else {echo $registro['valor_respuesta'];}?></td>
                      </tbody>
                    <?php } ?>
                 
                  </table>
            </div>
          </div>
        </div>
       </div>
         
                
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
          

          <script>
          </script>
      </body>
  </html>
