  <!DOCTYPE doctype html>
  <html lang="en">
  <?php  

    require_once ("../../php/controller/CtrlGuia1.php");
    include '../../php/DTO/UsuarioDTO.php';
     include '../../php/controller/CtrlEmpleados.php';
    $ctrlEmpleados= new CtrlEmpleados();
    $listaNivelesEstudios= $ctrlEmpleados->getNivelEstudios();
    $divisiones=$ctrlEmpleados->getDivisiones();
    $listaPuestos=$ctrlEmpleados->getPuestos();
    session_start();
    // error_reporting(0);
    $sesion  = $_SESSION['usuario'];
    $usuario = unserialize($sesion);
    //Se valida si hay sesión o no
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
                                        Guía de Referencia I
                                    </h2>
                                </strong>
                                <br/>
                                Norma Oficial Mexicana NOM-035-STPS-2018, Factores de Riesgo Psicosocial en el Trabajo.
                            </span>
                            <br/>
                        </h4>
                        <p>
                            <strong>
                                Cuestionario para identificara los trabajadores que fueron sujetos a acontecimientos traumaticos severos y que requieran valoración clínica.
                            </strong>
                        </p>
                        
                    </center>
                </div>
                <!-- /container -->
            </hr>
        </main>
         
        <div class="container-norma"> 

        <div class="card" id="datos_emp">
          <h4 class="card-header"><strong>Datos del empleado<?php echo $usuario->getNombre_completo()?></strong></h4>              
          <div class="card-body">
                         
              <div class="row">
                <div class="col-md-3"> 
                  <div class="form-group">
                    <label for="num_empleado">Numero de empleado</label>
                    <input type="text" disabled="true" class="form-control" id="num_empleado" name="num_empleado" value="<?php echo $usuario->getNum_empleado()?>">
                  </div>
                </div>
                 <div class="col-md-3"> 
                  <div class="form-group">
                    <label for="nivel_estudios">Puesto *</label><br/>
                    <select class="form-control" id="puesto" name="puesto" >
                      <option value="0">Selecciona una opción</option>
                         <?php  
                         foreach($listaPuestos as $puesto) {
                          echo '<option value="'.$puesto['rol_id'].'" >'.$puesto['nombre_rol'].'</option>';
                         }
                         ?>  

                    </select>
                    <span id="required_puesto" style="display: none;" class="text-danger">Debe seleccionar una opción</span>
                   
                   
                    
                  </div>
                </div>
                 
                <div class="col-md-3"> 
                  <div class="form-group">
                    <label for="nombre">Nombre *</label>
                    <input type="text"  class="form-control" id="nombre" name="nombre" value="<?php echo $usuario->getNombre_empleado()?>">
                    <span id="required_nombre" style="display: none;" class="text-danger">Campo Requerido. </span>
                    <span id="max_nombre"  style="display: none;" class="text-danger">Minimo 3 caracteres Máximo 40</span>
                  </div>
                </div>
                <div class="col-md-3"> 
                  <div class="form-group">
                    <label for="apellidos">Apellidos *</label>
                    <input type="text"  min="3" max="80"  class="form-control" id="apellidos" name="apellidos" value="<?php echo $usuario->getApellidos()?>">
                    <span id="required_apellidos"  style="display: none;" class="text-danger">Campo Requerido. </span>
                    <span id="max_apellidos"  style="display: none;" class="text-danger">Minimo 3 caracteres Máximo 40</span>
                  </div>
                </div>
                <div class="col-md-3"> 
                  <div class="form-group">
                    <label for="apellidos">Edad *</label>
                    <input type="text"  onkeypress="return solo_numeros(event)" min="1" max="3"  class="form-control" id="edad" name="edad" value="<?php echo $usuario->getEdad()?>">
                    <span id="required_edad"  style="display: none;" class="text-danger">Campo Requerido. </span>
                    <span id="max_edad"  style="display: none;" class="text-danger">Minimo 18 años Máximo 80 años</span>
                  </div>
                </div>
                
                <div class="col-md-3"> 
                  <div class="form-group" >
                      
                      <label for="sexo">Sexo *</label><br/>
                      
                      <div class="fsexo">
                        <label for="sexo">Masculino</label>
                        <input type="radio"  name="sexo" id="sexo1" value="M" >
                        <label for="sexo">Femenino</label>
                        <input type="radio" name="sexo" id="sexo2" value="F" >
                        <span id="required_sexo" style="display: none;" class="text-danger">Debe seleccionar uno</span>
                      </div>
                      
                   
                    
                   
                  </div>
                </div>
                <div class="col-md-3"> 
                  <div class="form-group">
                    <label for="nivel_estudios">Nivel de estudios *</label><br/>
                    <select class="form-control" id="nivel_estudios" name="nivel_estudios" >
                      <option value="0">Selecciona una opción</option>
                         <?php  
                         foreach($listaNivelesEstudios as $nivel) {
                          echo '<option value="'.$nivel['nivel_estudios_id'].'" >'.$nivel['nombre_estudios'].'</option>';
                         }
                         ?>  

                    </select>
                    <span id="required_nivel" style="display: none;" class="text-danger">Debe seleccionar una opción</span>
                   
                   
                    
                  </div>
                </div>
                <div class="col-md-3"> 
                  <div class="form-group">
                    <label>Estatus del nivel de estudios*</label>
                    <br/>
                    <label for="estatus_estudios">Terminada</label>
                    <input  type="radio"  name="estatus_estudios" id="estatus_estudios1" value="1" >
                    <label for="estatus_estudios">Incompleta</label>
                    <input  type="radio" name="estatus_estudios" id="estatus_estudios2" value="0" >
                    <span id="required_estatus_nivel"  style="display: none;" class="text-danger">Debe seleccionar al menos uno</span>
                   
                  </div>
                </div>
                
                <div class="col-md-3"> 
                  <div class="form-group">
                    <label for="division">División *</label>
                    <select class="form-control" id="division" name="division" >
                          <option value="0">Selecciona una opción</option>
                         <?php  
                         foreach($divisiones as $division) {
                          echo '<option value="'.$division['division_id'].'" >'.$division['nombre_division'].'</option>';
                         }
                         ?>  
                         

                    </select>
                    <span id="required_division"  style="display: none;" class="text-danger">Debe seleccionar una opción</span>
                    
                  </div>
                </div>
                <div class="col-md-3"> 
                  <div class="form-group">
                    <label for="fecha_puesto">Antiguedad del puesto *</label>
                 <input
                     type="text" class="form-control"
                    name="fecha_puesto" id="fecha_puesto" placeholder="Fecha en que inicio el puesto"
                    ><span id="required_fecpuesto"  style="display: none;" class="text-danger">Campo Requerido. </span>
                    <span id="max_fecpuesto"  style="display: none;" class="text-danger">La fecha no debe ser mayor o igual a la actual</span>
                    

                  </div>
                </div>
                <div class="col-md-3"> 
                  <div class="form-group">
                    <label for="fecha_antiguedad">Antiguedad en la institución *</label>
                 <input
                     type="text" class="form-control"
                    name="fecha_antiguedad" id="fecha_antiguedad" placeholder="Fecha en que inicio el puesto"
                    ><span id="required_antiguedad"  style="display: none;" class="text-danger">Campo Requerido</span>
                    <span id="max_antiguedad"  style="display: none;" class="text-danger">La fecha no debe ser mayor o igual a la actual</span>
                    
                  </div>
                </div>

              </div>                  
              <hr>


              <strong >Los campos marcados con un * son requeridos</strong>
           
          </div>
        </div>
      </div> <!-- /container -->
      <hr>
      <center>
        <h3>Contesta la Guía que se le indica</h3>
      </center>
      
        <div class="container"  id="1" name="con1" style="display: block;"> 

          <div class="card">
            <h4 class="card-header bg-dark"><strong>I.- Acontecimiento traumático severo</strong></h4>              
            <div class="card-body">
              <table class="table table-hover">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Sección / Pregunta</th>
                    <th scope="col">Respuestas</th>
                  </tr>
                </thead>
                <?php 
                foreach($matrizPreguntas as $registro) { 
                 
                    ?>
                <tbody>
                 
                  <tr>
                  <td scope="row">
                    <?php echo $registro['pregunta_desc'];?>
                  </td>
                    <td>
                       <button type="button" name="botonsi" id="botonsi<?php  echo $registro['pregunta_id'];?>" class="btn btn-primary btn-sm"  onclick="llevarDatos(<?php echo $registro['pregunta_id']?> ,<?php echo '1' ?>); "> Si</button> 
                        <button type="button" name="botonno" id="botonno<?php  echo $registro['pregunta_id'];   ?>" class="btn btn-primary btn-sm" onclick="llevarDatos(<?php echo $registro['pregunta_id']?> ,<?php echo '0' ?>)"> No</button> 
                      
                    </td>
                    <?php  } ?>
                           
                </tbody>
              </table>
              
            </div>
          </div>
        </div> <!-- /container -->

       <br/> 

        <div class="container" id="2" name="con2" style="display: none;"> 

          <div class="card">
            <h4 class="card-header bg-dark"><strong>II.- Recuerdos persistentes sobre el acontecimiento(durante el ultimo mes):</strong></h4>              
            <div class="card-body">
              <table class="table table-hover">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Sección / Pregunta</th>
                    <th scope="col">Respuestas</th>
                  </tr>
                </thead>
                 <?php foreach($matrizPreguntas2 as $registro) {
                       $idDocument=$registro['pregunta_id'];
                   
                                     ?>
                <tbody>
                  <tr>
                  <td scope="row"><?php echo $registro['pregunta_desc'] ?></td>
                    <td>


                       <button type="button" name="botonsi" id="botonsi<?php  echo $registro['pregunta_id'];   ?>" class="btn btn-primary btn-sm"  onclick="llevarDatos(<?php echo $registro['pregunta_id']?> ,<?php echo '1' ?>); "> Si</button> 
                        <button type="button" name="botonno" id="botonno<?php  echo $registro['pregunta_id'];   ?>" class="btn btn-primary btn-sm" onclick="llevarDatos(<?php echo $registro['pregunta_id']?> ,<?php echo '0' ?>)"> No</button>
                    </td>
                    
                     <?php } ?>      
                </tbody>
              </table>
              
            </div>
          </div>
        </div> <!-- /container -->
        <br/>
        <div class="container" id="3" name="con3" style="display: none;">  

          <div class="card">
            <h4 class="card-header bg-dark"><strong>III.- Esfuerzo por evitar circustancias parecidas o asociadas al acontecimiento (durante el último mes):
            </strong></h4>              
            <div class="card-body">
              <table class="table table-hover">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Sección / Pregunta</th>
                    <th scope="col">Respuestas</th>
                  </tr>
                </thead>
                <?php foreach($matrizPreguntas3 as $registro) {
                              $idDocument=$registro['pregunta_id'];
                        ?>
                <tbody>
                  <tr>
                  <td scope="row"><?php echo  $registro['pregunta_desc']?></td>
                    <td>
                      <button type="button" name="botonsi" id="botonsi<?php  echo $registro['pregunta_id'];    ?>" class="btn btn-primary btn-sm"  onclick="llevarDatos(<?php echo $registro['pregunta_id']?> ,<?php echo '1' ?>); "> Si</button> 
                        <button type="button" name="botonno" id="botonno<?php  echo $registro['pregunta_id'];  ?>" class="btn btn-primary btn-sm" onclick="llevarDatos(<?php echo $registro['pregunta_id']?> ,<?php echo '0' ?>)"> No</button>
                    </td>
                    
                <?php  } ?>      
                </tbody>
              </table>
              
            </div>
          </div>
        </div> <!-- /container -->

        <br/>
        <div class="container" id="4" name="con4" style="display: none;"> 

          <div class="card">
            <h4 class="card-header bg-dark"><strong>IV.- Afectación (durante el último mes):</strong></h4>              
            <div class="card-body">
              <table class="table table-hover">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Sección / Pregunta</th>
                    <th scope="col">Respuestas</th>
                  </tr>
                </thead>
                <?php foreach($matrizPreguntas4 as $registro) {
                                $idDocument=$registro['pregunta_id'];
                       ?>
                <tbody>
                  <tr>
                  <td scope="row"><?php echo $registro['pregunta_desc']?></td>
                    <td>
                     <button type="button" name="botonsi" id="botonsi<?php  echo $registro['pregunta_id'];   ?>" class="btn btn-primary btn-sm"  onclick="llevarDatos(<?php echo $registro['pregunta_id']?> ,<?php echo '1' ?>); "> Si</button> 
                        <button type="button" name="botonno" id="botonno<?php  echo $registro['pregunta_id']; ?>" class="btn btn-primary btn-sm" onclick="llevarDatos(<?php echo $registro['pregunta_id']?> ,<?php echo '0' ?>)"> No</button>
                    </td>
                    
                     <?php } ?>      
                </tbody>
              </table>
            </div>
          </div>
        </div> <!-- /container -->
        
        <div class="container"  id="grac" name="gra" style="display: none;"> 
        
          <div class="card">            
            <div class="card-body">
              <h4 class="card-header bg-dark" style="">¡Gracias por participar!, No es necesario seguir respondiendo las demás secciones.</h4>
              <img alt="" class="mb-4 rounded mx-auto d-block" height="200" src="../../resources/img/gracias.png" width="180">
              
              
            </div>
          </div>
        </div> <!-- /container -->
        <br/>
        <center>
          
            <button c type="button" style="display: none" name="aceptar" id="aceptar" class="btn btn-primary" onclick="llevar_json()" style="width: 88" > Aceptar</button> 
        
        </center>
        
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
          <script src="../../resources/js/guia1.js"></script>

          <script>
               var usuario =<?php echo $usuario->getNum_empleado() ?>;
              $(function() {
                $("#fecha_puesto").datepicker({
                  dateFormat : 'dd-mm-yy',
                  
                });
              });
               $(function() {
                $("#fecha_antiguedad").datepicker({
                  dateFormat : 'dd-mm-yy'
                });
              });

              function llevarDatos(pregunta_id,resp){
                    var id=pregunta_id+"";
                    document.getElementById("botonsi"+id).disabled=true;
                    document.getElementById("botonno"+id).disabled=true;
                    
                   
                    resp_array.push({pregunta_id,resp,usuario});

                    if (resp==1 && pregunta_id==1) {
                      document.getElementById("2").style.display="block";
                      document.getElementById("1").style.display="none";
                      document.getElementById("3").style.display="block";
                      document.getElementById("4").style.display="block";
                    }else if(pregunta_id==1 && resp==0){
                      document.getElementById("grac").style.display="block";
                      document.getElementById("1").style.display="none";
                    }

                    if(resp==1){
                      document.getElementById("botonsi"+id).style.background="#038C65";
                    }else if(resp==0){
                      document.getElementById("botonno"+id).style.background="#038C65";
                    }


                    if(resp_array[0]["resp"]==1&&resp_array.length==15){
                        document.getElementById("aceptar").style.display="block";

                        
                    }else if (resp_array[0]["resp"]==0) {
                      document.getElementById("aceptar").style.display="block";

                    }

                   
                  }
          </script>
      </body>
  </html>
