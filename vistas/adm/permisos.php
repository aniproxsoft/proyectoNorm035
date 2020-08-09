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
$empleados=$ctrlEmpleados->getNumEmpleados();
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
                            <a class="nav-link" href="empleados.php">Empleados</a>
                        </li>
                    
                        <li class="nav-item" >
                            <a class="nav-link active" href="permisos.php">Permisos de usuario</a>
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
       <main role="main">     
      <hr>
      <div class="container-norma" style="background-color: white"> 
        <hr>
        <div class="card">
          
          <h4 class="card-header"><strong>Listado de Usuarios</strong></h4>              
          <hr>
          <div class="card-body">     
            <div class="row">
                <div class="col-md-1">
                     <div class="form-group">
                        <a class="btn btn-primary " data-target="#nuevoModal" data-toggle="modal"href="nuevo_empleado.php"
                        title="Crear nuevo numero de empleado" role="button"><i
                        class="fas fa-plus" aria-hidden="true"></i></a>
                     </div>
                </div>
                <div class="col-md-4"> 
                  <div class="form-group">
                    
                    <input type="text" placeholder="Buscar" class="form-control" id="search" name="search" value="">
                    
                  </div>
                </div>
                <div class="col-md-1"> 
                    <div class="form-group">
                        <button class="btn btn-primary " onclick="buscarUser()" href="" 
                        title="Buscar" role="button"><i
                        class="fas fa-search" aria-hidden="true"></i></button>
                    </div>
                </div> 
            </div>     
            
            
            <hr>
            <div id="forma"  style="position: relative;height: 450px;overflow: auto;">        
                <table class="table table-hover " id="tabla">
                    <thead style="overflow-y: auto; height: 100px; " class="thead-light">
                
                <tr>
                  <th width="25%" scope="col">Numero de empleado</th>
                  <th width="25%" scope="col">Guías</th>                
                  <th width="25%" scope="col">Acceso</th>
                  <th width="25%" scope="col">Operaciones</th>
                </tr>
              </thead>
              <tbody>
                 <?php for ($i=0; $i < count($empleados) ; $i++) { 

                  echo "<tr>
                 

                  <td>".$empleados[$i]['num_empleado']."</td>
                  <td>".$empleados[$i]['guia']."</td>
                  <td>".$empleados[$i]['acceso']."</td>                  
                  <td>
                   <a href='#' onclick='eliminar(".$empleados[$i]['num_empleado'].")' class='btn btn-success btn-sm' role='button' title='Eliminar el registro.'><i class='fas fa-trash' aria-hidden='true'></i></a>
                    <a href='#'' onclick='bloquear(".$empleados[$i]['num_empleado'].")' class='btn btn-success btn-sm' role='button' title='Bloquear el acceso a la Guía para este usuario.'><i class='fas fa-lock' aria-hidden='true'></i></a>  
                    <a href='#' onclick='desbloquear(".$empleados[$i]['num_empleado'].")' class='btn btn-success btn-sm' role='button' title='Permitir el acceso a la Guía para este usuario.'><i class='fas fa-unlock' aria-hidden='true'></i></a>
                  </td>

                </tr> ";
                
                } ?>
                
                                               
              </tbody>
            </table>
             </div>
          </div>
        </div>
        <br>
      </div> <!-- /container -->
      <!-- Modal -->
        <div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="nuevoModal" role="dialog" tabindex="-1">
            
                <input name="opc" type="hidden" value="2">
                </input>
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                                Acceder a la Guía
                            </h5>
                            <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                                <span aria-hidden="true">
                                    ×
                                </span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <label class="sr-only" for="username">
                                Numero de empleado
                            </label>
                            <input autofocus="" class="form-control" id="num_empleado" maxlength="8" minlength="6" name="num_empleado" onkeypress="return solo_numeros(event);" placeholder="Numero de empleado" required="true" type="text">
                            </input>
                            <span id="error" style="display: none;" class="text-danger">Ocurrio un error</span>
                            <span id="existe" style="display: none;" class="text-danger">El numero de empleado ya existe</span>
                            <span id="requiredNumero" style="display: none;" class="text-danger">Campo requerido mínimo 6 digitos máximo 8</span>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-dismiss="modal" type="button">
                                Cancelar
                            </button>
                            <button class="btn btn-primary" onclick="guardar()" >
                                Guardar
                            </button>
                        </div>
                    </div>
                </div>
            
        </div>

  


    
        
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
        <script src="../../resources/js/num-empleados.js">
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
        <script src="../../resources/js/busqueda.js"></script>

    </body>
</html>
