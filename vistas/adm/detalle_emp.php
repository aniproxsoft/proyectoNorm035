<?php

include '../../php/DTO/UsuarioDTO.php';
require_once '../../php/controller/CtrlEmpleados.php';
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

$num_empleado=base64_decode(filter_input(INPUT_GET, "num"));
$empleado=$ctrlEmpleados->getEmpleadoSeleccionado($num_empleado);
$guiasResueltas=$ctrlEmpleados->getGuiasResueltas($num_empleado);

?>

<!DOCTYPE doctype html>
<html lang="utf-8">
    <head>
       <meta http-equiv="Content-type" content="text/html; charset=utf-8" />

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
                                    <link href="../../resources/font/all.css" rel="stylesheet">
                                    <link href="../../resources/css/norma.css" rel="stylesheet">
                           
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
                   <div class="btn-group">
                       <?php $usuario->setMenu_user($usuario->getNombre_empleado());
                       echo $usuario->getMenu_user();?>
                   </div>
                    
                </div>
            </nav>
        </header>

        

     
       <br><br>
      
       <div class="container-norma"> 
     

        <div class="card" id="datos_emp">
          <h4 class="card-header"><strong>Datos del empleado</strong></h4>              
          <div class="card-body">
                         
              <div class="row">
                <div class="col-md-3"> 
                  <div class="form-group">
                    <label for="num_empleado">Numero de empleado</label>
                    <strong><output style="color: black" class="form-text"><?php echo $empleado[0]['num_empleado']?></output></strong> 
                  </div>
                </div>
                 <div class="col-md-3"> 
                  <div class="form-group">
                    <label for="nivel_estudios">Puesto *</label><br/>
                    <output style="color: black"  class="form-text" id="puesto" name="puesto" ><?php echo $empleado[0]['nombre_rol']?></output>
                  </div>
                </div>
                 
                <div class="col-md-3"> 
                  <div class="form-group">
                    <label for="nombre">Nombre *</label>
                    <output style="color: black"  class="form-text" id="nombre" name="nombre"><?php echo $empleado[0]['nombre_empleado']?></output> 
                  </div>
                </div>
                <div class="col-md-3"> 
                  <div class="form-group">
                    <label for="apellidos">Apellidos *</label>
                    <output style="color: black" class="form-text" id="apellidos" name="apellidos" ><?php echo $empleado[0]['apellidos']?></output>
                    
                  </div>
                </div>
                <div class="col-md-3"> 
                  <div class="form-group">
                    <label for="apellidos">Edad *</label>
                    <output style="color: black" class="form-text" id="edad" name="edad" ><?php echo $empleado[0]['edad']?> años</output>
                    
                  </div>
                </div>
                
                <div class="col-md-3"> 
                  <div class="form-group" >
                      
                      <label for="sexo">Sexo *</label><br/>
                      
                      <output style="color: black" class="form-text" id="sexo" name="sexo" ><?php echo $empleado[0]['sexo_completo']?></output>
                      
                   
                    
                   
                  </div>
                </div>
                <div class="col-md-3"> 
                  <div class="form-group">
                    <label for="nivel_estudios">Nivel de estudios *</label><br/>
                     <output style="color: black" class="form-text" id="nivel" name="nivel" ><?php echo $empleado[0]['nombre_estudios']?></output>
                   
                   
                    
                  </div>
                </div>
                <div class="col-md-3"> 
                  <div class="form-group">
                    <label>Estatus del nivel de estudios*</label>
                    <br/>
                    <output style="color: black" class="form-text" id="estudios" name="estudios" ><?php echo $empleado[0]['estatus_estudios']?></output>
                  </div>
                </div>
                
                <div class="col-md-3"> 
                  <div class="form-group">
                    <label for="division">División *</label>
                    <output style="color: black" class="form-text" id="division" name="division" ><?php echo $empleado[0]['nombre_division']?></output>
                    
                  </div>
                </div>
                <div class="col-md-3"> 
                  <div class="form-group">
                    <label for="fecha_puesto">Antiguedad del puesto *</label>
                 <output style="color: black" class="form-text" id="antiguedad" name="antiguedad" ><?php echo $empleado[0]['antiguedad_puesto']?></output>

                  </div>
                </div>
                <div class="col-md-3"> 
                  <div class="form-group">
                    <label for="fecha_antiguedad">Antiguedad en la institución *</label>
                 <output style="color: black" class="form-text" id="utn" name="utn" ><?php echo $empleado[0]['antiguedad_utn']?></output>
                </div>

              </div>                  
              


              
           </div>
           <hr>
              <strong>Guias Realizadas</strong>
              <br>
              <?php
                $url="";
                foreach($guiasResueltas as $guia){
                  switch ($guia['guia_id']) {
                    case 1:
                        $url="resultados_guia1.php?num=". base64_encode ($empleado[0]['num_empleado']);
                      break;
                    
                    case 2:
                      $url="resultados_guia2.php?num=". base64_encode ($empleado[0]['num_empleado']);
                      break;
                    case 3:
                      $url="resultados_guia3.php?num=". base64_encode ($empleado[0]['num_empleado']);
                    break;
                  }
                  
                    
                  
                  echo "<a href='".$url."' class='form-text' style='color: blue'
                                     title='Ver el detalle'>".$guia['guia_nombre']."</a>";
                }

              ?>

             
          </div>
        </div>
      </div> <!-- /container -->
<br>

    
        
        <br/>
        <footer class="footer">
            <div class="container">
                <p>
                    © 2020 NOM-035, Inc. | WebApp Desarrollada con PHP| Autor: UTN
                    <a href="#" style="color: white;">
                        Privacy
                    </a>
                    
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
