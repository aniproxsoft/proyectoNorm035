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
$resultadoGuia=$ctrlEmpleados->getResultadoGuia($num_empleado);
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
          <h4 class="card-header"><strong>Resultados de la Guía 1 de <?php echo $empleado[0]['nombre_completo']?></strong></h4>              
          <div class="card-body">
                         
               <table class="table table-hover">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Sección / Pregunta</th>
                    <th scope="col">Respuestas</th>
                  </tr>
                </thead>
              <?php foreach($resultadoGuia as $registro) { ?>
                <tbody>
                  
                  <td scope="row"><?php echo $registro['pregunta'] ?></td>
                  <td scope="row"><?php echo $registro['respuesta'] ?></td>
                    
              <?php } ?>      
                </tbody>
              </table>

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
