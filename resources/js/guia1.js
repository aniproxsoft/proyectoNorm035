alert("Una vez contestada una pregunta NO PODRÁS CAMBIAR LA RESPUESTA");
var resp_array = new Array();
var empleado_array= new Array();
                
function solo_numeros(e){
  var keynum = window.event ? window.event.keyCode : e.which;
  if ((keynum == 8) || (keynum == 46))
    return true;
    return /\d/.test(String.fromCharCode(keynum));
  }

function llevar_json(){
  var nombre=document.getElementById("nombre").value;
  var apellidos=document.getElementById("apellidos").value;
  var edad=document.getElementById("edad").value;
  var nivel_estudios=document.getElementById("nivel_estudios").value;
  var puesto=document.getElementById("puesto").value;
  var division=document.getElementById("division").value;
  var antiguedad_puesto= document.getElementById("fecha_puesto").value;
  var fecha_antiguedad=document.getElementById("fecha_antiguedad").value;
  var fechaActual= new Date();
  var flag=0;


  if(nombre=="" || !(nombre.length>2 && nombre.length<=80)){
   
    location.href="#datos_emp";
    document.getElementById("required_nombre").style.display="block";
    document.getElementById("max_nombre").style.display="block";
    document.getElementById("nombre").className += " error_valid";
    flag++;
  }else{
    document.getElementById("nombre").className = "form-control";
    document.getElementById("required_nombre").style.display="none";
    document.getElementById("max_nombre").style.display="none";
  }


  if(apellidos=="" || !(apellidos.length>2 && apellidos.length<=80)){
   
    location.href="#datos_emp";
    document.getElementById("required_apellidos").style.display="block";
    document.getElementById("max_apellidos").style.display="block";
    document.getElementById("apellidos").className += " error_valid";
    flag++;
  }else{
    document.getElementById("apellidos").className = "form-control";
    document.getElementById("required_apellidos").style.display="none";
    document.getElementById("max_apellidos").style.display="none";
  }


  if(edad=="" || !(edad>=18 && edad<=80)){
   
    location.href="#datos_emp";
    document.getElementById("required_edad").style.display="block";
    document.getElementById("max_edad").style.display="block";
    document.getElementById("edad").className += " error_valid";
    flag++;
  }else{
    document.getElementById("edad").className = "form-control";
    document.getElementById("required_edad").style.display="none";
    document.getElementById("max_edad").style.display="none";
  }

  var sexo="";
  
  if(document.getElementById("sexo1").checked){
    sexo=document.getElementById("sexo1").value;
    document.getElementById("required_sexo").style.display="none";
    
  }else if(document.getElementById("sexo2").checked){
    document.getElementById("required_sexo").style.display="none";
    sexo=document.getElementById("sexo2").value;
    
  }else if(!(document.getElementById("sexo1").checked && document.getElementById("sexo2").checked)){
    location.href="#datos_emp";
    document.getElementById("required_sexo").style.display="block";

    flag++;
  }

  if(nivel_estudios==0){
    
    document.getElementById("required_nivel").style.display="block";
    flag++;
  }else{
    document.getElementById("required_nivel").style.display="none";
   
  }

  var estatus_estudios="";
  
  if(document.getElementById("estatus_estudios1").checked){
    estatus_estudios=document.getElementById("estatus_estudios1").value;
    document.getElementById("required_estatus_nivel").style.display="none";
    
  }else if(document.getElementById("estatus_estudios2").checked){
    document.getElementById("required_estatus_nivel").style.display="none";
    estatus_estudios=document.getElementById("estatus_estudios2").value;
    
  }else if(!(document.getElementById("estatus_estudios1").checked && document.getElementById("estatus_estudios2").checked)){
    location.href="#datos_emp";
    document.getElementById("required_estatus_nivel").style.display="block";

    flag++;
  }


  if(antiguedad_puesto==""){
        document.getElementById("required_fecpuesto").style.display="block";

  }else{
    document.getElementById("required_fecpuesto").style.display="none";
  }
  if(fecha_antiguedad==""){
        document.getElementById("required_antiguedad").style.display="block";

  }else{
    document.getElementById("required_antiguedad").style.display="none";

  }

  if(antiguedad_puesto!=""){

    if(validaFehas(formatearFecha(fechaActual),antiguedad_puesto)){
      document.getElementById("max_fecpuesto").style.display="block";
       flag++;
    }else{
      document.getElementById("max_fecpuesto").style.display="none";
    }
  }
  if(fecha_antiguedad!=""){

    if(validaFehas(formatearFecha(fechaActual),fecha_antiguedad)){
      document.getElementById("max_antiguedad").style.display="block";
       flag++;
    }else{
      document.getElementById("max_antiguedad").style.display="none";
    }
  }



  if(puesto==0){
    
    document.getElementById("required_puesto").style.display="block";
   flag++;
  }else{
    document.getElementById("required_puesto").style.display="none";
    
  }
  if(division==0){
    
    document.getElementById("required_division").style.display="block";
   flag++;
  }else{
    document.getElementById("required_division").style.display="none";
    
  }



  if(flag==0){
    empleado_array.push({usuario,puesto,nombre,apellidos,edad,
      sexo,nivel_estudios,division,estatus_estudios,fecha_antiguedad,antiguedad_puesto});

    var json_res=JSON.stringify(empleado_array);
    console.log(json_res);
    window.fetch("../../php/controller/CtrlRespuestas.php?json=" + encodeURIComponent(json_res)+"&opcion=2").then(respuesta => {
      if (respuesta.ok){
        return respuesta.json();
      } else {
        throw new Error(respuesta.statusText);
      }
    }).then(res => insertaRespuestas(res))
        .catch(e => alert(e));
  }else{
    alert("LLENA CORRECTAMENTE LOS CAMPOS");
    
  }
}

function insertaRespuestas(res){
  
  var json_res=JSON.stringify(resp_array);
    
    window.fetch("../../php/controller/CtrlRespuestas.php?json=" + encodeURIComponent(json_res)+"&opcion=1").then(respuesta => {
      if (respuesta.ok){
        return respuesta.json();
      } else {
        throw new Error(respuesta.statusText);
      }
    }).then(res => llenaForm(res))
        .catch(e => alert(e));
  
 }

 function llenaForm(res){
  alert(res);
  location.href="../../vistas/info_sesion/cerrar_sesion.php";
 }


 function validaFehas(fechaActual,fecha){
    var valueStart=fechaActual.split("-");
    var valueEnd=fecha.split("-");
    var dateStart=new Date(valueStart[2],(valueStart[1]-1),valueStart[0]);
    var dateEnd=new Date(valueEnd[2],(valueEnd[1]-1),valueEnd[0]);
    if(dateStart>dateEnd){
      return 0;
    }
    return 1;

 }

function formatearFecha(fechaActual){
  return fechaActual.getDate()+"-"+
  (fechaActual.getMonth()+1)+"-"+fechaActual.getFullYear();
}



