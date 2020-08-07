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
$empleados=$ctrlEmpleados->getEmpleadosSinAdmin();
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

        

     
       <br>
      
      
        <div class="container-norma" style="background-color: white"> 
        <hr>
        <div class="card">
          
          <h4 class="card-header"><strong>Empleados</strong></h4>              
          <hr>
          <div class="card-body">     
            <div class="row">
                
                <div class="col-md-4"> 
                  <div class="form-group">
                    
                    <input type="text" placeholder="Buscar" class="form-control" id="search" name="search" value="">
                    
                  </div>
                </div>
                <div class="col-md-1"> 
                    <div class="form-group">
                        <button class="btn btn-primary " onclick="buscarEmpleado()" 
                        title="Buscar" role="button"><i
                        class="fas fa-search" aria-hidden="true"></i></button>
                    </div>
                </div> 
            </div>     
            
            
            <hr>
        <div id="tab" style="position: relative;height: 600px;overflow: auto;">
        <div id="renglones">
            <?php for ($i=0; $i < count($empleados) ; $i++) { 

            echo "<div class='row' style='color: black'>
          
          <div class='col-md-9'>
            <h4>".$empleados[$i]['nombre_completo']."</h4>
            <h5 class='card-title'><strong>".$empleados[$i]['num_empleado']." </strong> </h5>
            <h6 class='card-title'><strong>".$empleados[$i]['nombre_rol']." </strong> </h6>
            <h6 class='card-title'><strong>División: </strong> <span>".$empleados[$i]['nombre_division']."</span></h6>                
            <p>Sexo: ".$empleados[$i]['sexo_completo']."</p>";

            if ($empleados[$i]['status_guia']=="El Trabajador REQUIERE de Valoración Clínica") {
                echo "<h5 class='card-title' style='color: red'><strong>".$empleados[$i]['status_guia']." </strong> </h5>";
            } elseif ($empleados[$i]['status_guia']=="El Tabajador No Requiere de Valoración Clínica") {
                echo "<h5 class='card-title' style='color: green'><strong>".$empleados[$i]['status_guia']." </strong> </h5>";
            }
            
                
            
            
           echo "            
          </div>
          <div class='col-md-3'>
            <div>
                <a href='detalle_emp.php?num=". base64_encode ($empleados[$i]['num_empleado'])."' class='btn btn-primary ' style='width:20%'
                                    role='button' title='Ver el detalle'><i
                                        class='fas fa-eye' aria-hidden='true'></i></a> <!--<a href='#'
                                    onclick=''
                                    class='btn btn-primary ' style='width:20%' role='button'
                                    title='Eliminar el registro.'><i class='fas fa-trash'
                                        aria-hidden='true'></i></a>-->
            </div>
            
          </div>
        </div>  <hr>";

        } ?>
            
        </div>
        
        
       
              
    		  </div></div></div>
      </div> <!-- /container -->


    
        
        <br/><br/>
        <br/><br/>
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
        <script src="../../resources/js/busqueda.js"></script>
    </body>
</html>
