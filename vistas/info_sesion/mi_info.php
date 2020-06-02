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

        <div class="card">
          <h4 class="card-header"><strong><?php echo $usuario->getNombre_completo()?></strong></h4>              
          <div class="card-body">
            <form>              
              <div class="row">
                <div class="col-md-3"> 
                  <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" disabled="true" class="form-control" id="nombre" name="nombre" value="<?php echo $usuario->getNombre_empleado()?>">
                  </div>
                </div>
                <div class="col-md-3"> 
                  <div class="form-group">
                    <label for="apellidos">Apellidos</label>
                    <input type="text" disabled="true" class="form-control" id="apellidos" name="apellidos" value="<?php echo $usuario->getApellidos()?>">
                  </div>
                </div>
                <div class="col-md-3"> 
                  <div class="form-group">
                    <label for="num_empleado">Numero de empleado</label>
                    <input type="text" disabled="true" class="form-control" id="num_empleado" name="num_empleado" value="<?php echo $usuario->getNum_empleado()?>">
                  </div>
                </div>
                <div class="col-md-3"> 
                  <div class="form-group">
                    <label for="sexo">Sexo</label>
                    <input type="text" disabled="true" class="form-control" id="sexo" name="sexo" value="<?php echo $usuario->getSexo_completo()?>">
                  </div>
                </div>
                <div class="col-md-3"> 
                  <div class="form-group">
                    <label for="nivel_estudios">Nivel de estudios</label>
                    <input type="text" disabled="true" class="form-control" id="nivel_estudios" name="nivel_estudios" value="<?php echo $usuario->getNombre_estudios().' - '.$usuario->getEstatus_estudios()?>">
                  </div>
                </div>
                <div class="col-md-3"> 
                  <div class="form-group">
                    <label for="division">División</label>
                    <input type="text" disabled="true" class="form-control" id="division" name="division" value="<?php echo $usuario->getNombre_division()?>">
                  </div>
                </div>
                <div class="col-md-3"> 
                  <div class="form-group">
                    <label for="rol">Rol de usuario</label>
                    <input type="text" disabled="true" class="form-control" id="rol" name="rol" value="<?php echo $usuario->getNombre_rol()?>">
                  </div>
                </div>
                 
                 
                 
                 
                 
                
              </div>                  
              <hr>
              <a style="color:white" title="Volver a inicio" class="btn btn-primary" href="<?php if($usuario->getRol_id()==1){
                                    echo '../adm/adm_index.php';
                                }elseif ($usuario->getRol_id()==2 or $usuario->getRol_id()==3) {
                                    echo '../emp/emp_index.php';
                                }?>" role="button">Regresar a inicio</a>  
            </form>
          </div>
        </div>
      </div> <!-- /container -->

    </main>
        
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
