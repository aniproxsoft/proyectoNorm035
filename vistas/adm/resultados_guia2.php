 <?php
    require_once '../../php/controller/CtrlEmpleados.php';
     require_once '../../php/controller/ctrlResultados.php';
     include '../../php/DTO/UsuarioDTO.php';
header("Content-Type: text/html;charset=utf-8");
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
    $ctrlEmpleados= new CtrlEmpleados();
    $ctrlResultados= new ctrlResultados();

    $num_empleado=base64_decode(filter_input(INPUT_GET, "num"));
   
    $empleado=$ctrlEmpleados->getEmpleadoSeleccionado($num_empleado);
    $global=$ctrlResultados->getResultadosGlobalGuia2($num_empleado);
    $categorias=$ctrlResultados->getResultadosCategoriaGuia2($num_empleado);
    $dominios=$ctrlResultados->getResultadosDominioGuia2($num_empleado);

  ?>
  <!DOCTYPE doctype html>
  <html lang="en">
  <?php?>
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
                            <a class="nav-link" href="adm_index.php">
                                Inicio
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="empleados.php">Empleados</a>
                        </li>
                    
                        <li class="nav-item">
                            <a class="nav-link" href="permisos.php">Permisos de usuario</a>
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
              <h4 class="card-header"><strong>Calificaciones de la Guía de Referencia II de <?php echo $empleado[0]['nombre_completo']?></strong></h4>              
              <div class="card-body">    
               
                <a class="btn btn-primary bt-sm" 
                <?php echo '<a href="respuestas_guia2.php?num='. base64_encode ($empleado[0]['num_empleado']).'"'  ?>
                title="Ver Respuestas" role="button"><i
                class="fas fa-eye" aria-hidden="true"></i></a>
            
                <hr>        
                <table class="table table-hover" id="total">
                  <thead class="thead-light">
                    <tr>
                      <th width="33%" scope="col">Resultado del cuestionario</th>
                      <th width="20%" scope="col">Resultado</th>                
                      <th width="20%" scope="col">Puntaje</th>
                    </tr>
                  </thead>
                    <?php foreach($global as $registro) { ?>
                      <tbody>
                        <td scope="row"><?php echo $registro['seccion_desc'] ?></td>
                        <td scope="row">
                          <strong>
                            <a id="res" href="" style="<?php switch ($registro['resultado']) {
                              case 'Alto':
                                echo 'color:#fcc404;';
                              break;
                              case 'Muy Alto':
                                echo 'color:#fc0404;';
                              break;
                              case 'Medio':
                                echo 'color:#BFD404;';
                              break;
                              case 'Bajo':
                               echo 'color: #50B550;';
                              break;
                              case 'Nulo o despreciable':
                                echo 'color: #00CCF4;';
                              break;
                            } ?>" 
                              onclick="verSugerencia(<?php echo "'".$registro['resultado']."'" ?>)" data-target="#sugerenciaModal" data-toggle="modal" title="Ver sugerencias"><?php echo $registro['resultado'] ?>
                            </a>
                          </strong>
                        </td>
                        <td scope="row"><?php echo $registro['puntaje'] ?></td>
                      </tbody>
                    <?php } ?>                  
            </table><br>
            <table class="table table-hover" id="categoria">
                  <thead class="thead-light">
                    <tr>
                      <th width="33%" scope="col">Calificación de la Categoria</th>
                      <th width="20%" scope="col">Resultado</th>                
                      <th width="20%" scope="col">Puntaje</th>
                    </tr>
                  </thead>
                  <?php foreach($categorias as $registro) { ?>
                      <tbody>
                        <td scope="row"><?php echo $registro['seccion_desc'] ?></td>
                        <td scope="row">
                          <strong>
                            <a id="res" href="" style="<?php switch ($registro['resultado']) {
                              case 'Alto':
                                echo 'color:#fcc404';
                              break;
                              case 'Muy Alto':
                                echo 'color:#fc0404';
                              break;
                              case 'Medio':
                                echo 'color:#BFD404';
                              break;
                              case 'Bajo':
                               echo 'color: #50B550';
                              break;
                              case 'Nulo o despreciable':
                                echo 'color: #00CCF4';
                              break;
                            } ?>" 
                              onclick="verSugerencia(<?php echo "'".$registro['resultado']."'" ?>)" data-target="#sugerenciaModal" data-toggle="modal" title="Ver sugerencias"><?php echo $registro['resultado'] ?>
                            </a>
                          </strong>
                        </td>
                        <td scope="row"><?php echo $registro['puntaje'] ?></td>
                      </tbody>
                  <?php } ?>  
            </table>
            <table class="table table-hover" id="dominio">
                  <thead class="thead-light">
                    <tr>
                      <th width="33%" scope="col">Resultado del Dominio</th>
                      <th width="20%" scope="col">Resultado</th>                
                      <th width="20%" scope="col">Puntaje</th>
                    </tr>
                  </thead>
                  <?php foreach($dominios as $registro) { ?>
                      <tbody>
                        <td scope="row"><?php echo $registro['seccion_desc'] ?></td>
                        <td scope="row">
                          <strong>
                            <a id="res" href="" style="<?php switch ($registro['resultado']) {
                              case 'Alto':
                                echo 'color:#fcc404';
                              break;
                              case 'Muy Alto':
                                echo 'color:#fc0404';
                              break;
                              case 'Medio':
                                echo 'color:#BFD404';
                              break;
                              case 'Bajo':
                               echo 'color: #50B550';
                              break;
                              case 'Nulo o despreciable':
                                echo 'color: #00CCF4';
                              break;
                            } ?>" 
                              onclick="verSugerencia(<?php echo "'".$registro['resultado']."'" ?>)" data-target="#sugerenciaModal" data-toggle="modal" title="Ver sugerencias"><?php echo $registro['resultado'] ?>
                            </a>
                          </strong>
                        </td>
                        <td scope="row"><?php echo $registro['puntaje'] ?></td>
                      </tbody>
                  <?php } ?>  
            </table>
          </div>
        </div>
       </div>
       <!-- Modal -->
        <div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="sugerenciaModal" role="dialog" tabindex="-1">
            
                <input name="opc" type="hidden" value="2">
                </input>
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                                
                            </h5>
                            <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                                <span aria-hidden="true">
                                    ×
                                </span>
                            </button>
                        </div>
                        <div class="modal-body" id="cuerpoModal">
                        </div> 
                        <div class="modal-footer">
                            <button class="btn btn-primary" data-dismiss="modal" onclick="clear()" type="button">
                                Aceptar
                            </button>
                            
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
            function verSugerencia(res){
              
              $('#titulo').remove();
              $('#desc').remove();

              window.fetch("../../php/controller/CtrlCriterios.php"
                ).then(respuesta => {
                if (respuesta.ok){
                  return respuesta.json();
                } else {
                  throw new Error(respuesta.statusText);
                }
              }).then(respuesta => getCriterio(respuesta,res)).catch(e => alert(e));
             }
            

            function getCriterio(respuesta,res){
              let titulo="";
              let desc="";
               switch(res){
                case 'Muy Alto':
                  titulo=respuesta[0]["criterio_nombre"];
                  desc=respuesta[0]["criterio_desc"];
                break;
                case 'Alto':
                  titulo=respuesta[1]["criterio_nombre"];
                  desc=respuesta[1]["criterio_desc"];
                break;
                case 'Medio':
                  titulo=respuesta[2]["criterio_nombre"];
                  desc=respuesta[2]["criterio_desc"];
                break;
                case 'Bajo':
                  titulo=respuesta[3]["criterio_nombre"];
                  desc=respuesta[3]["criterio_desc"];
                break;
                case 'Nulo o despreciable':
                  titulo=respuesta[4]["criterio_nombre"];
                  desc=respuesta[4]["criterio_desc"];
                break;
              }
              
              $('#exampleModalLabel').append("<div id='titulo'>"+titulo+'</div>');
              $('#cuerpoModal').append("<div id='desc'>"+desc+"</div>");

              
            }
            function clear(){
              $('#titulo').remove();
              $('#desc').remove();
            }
            
          </script>
      </body>
  </html>
