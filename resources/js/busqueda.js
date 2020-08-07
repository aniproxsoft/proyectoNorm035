function buscarEmpleado(){

	var search= document.getElementById("search").value;
	window.fetch("../../php/controller/CtrlBusqueda.php?opc=1&search="+search
   	).then(respuesta => {
    if (respuesta.ok){
    	return respuesta.json();
    } else {
        throw new Error(respuesta.statusText);
   }
   }).then(respuesta => llenaTablaEmp(respuesta)).catch(e => alert(e));
	
}

function buscarUser(){
	var search= document.getElementById("search").value;
	var search= document.getElementById("search").value;
	window.fetch("../../php/controller/CtrlBusqueda.php?opc=2&search="+search
   	).then(respuesta => {
    if (respuesta.ok){
    	return respuesta.json();
    } else {
        throw new Error(respuesta.statusText);
   }
   }).then(respuesta => llenaTablaUser(respuesta)).catch(e => alert(e));
}

function llenaTablaEmp(respuesta){
	if(respuesta.length>0){
			$('#renglones').remove();
	
			let formulario="<div id='renglones'>";
	
			for (var i = 0; i < respuesta.length; i++){

				formulario+="<div class='row' style='color: black'>"+
        			"<div class='col-md-9'>"+
            		"<h4>"+respuesta[i]['nombre_completo']+"</h4>"+
            		"<h5 class='card-title'><strong>"+respuesta[i]['num_empleado']+" </strong> </h5>"+
            		"<h6 class='card-title'><strong>"+respuesta[i]['nombre_rol']+" </strong> </h6>"+
            		"<h6 class='card-title'><strong>División: </strong> <span>"+respuesta[i]['nombre_division']+"</span></h6>"+                
            		"<p>Sexo: "+respuesta[i]['sexo_completo']+"</p>"
					+"</div><div class='col-md-3'><div><a href='detalle_emp.php?num="+btoa(respuesta[i]['num_empleado'])+"' class='btn btn-primary ' style='width:20%'"+
									"role='button' title='Ver el detalle'><i class='fas fa-eye' aria-hidden='true'></i></a> <!--<a href='#'"+
									"onclick=''"+
									"class='btn btn-primary ' style='width:20%' role='button'"+
									"title='Eliminar el registro.'><i class='fas fa-trash'"+
									"aria-hidden='true'></i></a>--></div> </div> </div>  <hr>";
               
	}
	$('#tab').append(formulario+"</div>"); 
	}else{
		$('#renglones').remove();
	
			let formulario="<div id='renglones'><h4><strong>No se encontraron coicidencias.</strong></h4></div>";
			$('#tab').append(formulario); 
	}
	

}
function llenaTablaUser(respuesta){
	$('#tabla').remove();
	
	let formulario="<table class='table table-hover ' id='tabla'>"+
	"<thead style='overflow-y: auto; height: 100px; ' class='thead-light'> <tr><th width='25%' scope='col'>Numero de empleado</th>"+
    "<th width='25%' scope='col'>Guía</th>"+              
    "<th width='25%' scope='col'>Acceso</th>"+
    "<th width='25%' scope='col'>Operaciones</th>"+
    "</tr>"+
    "</thead>"+
    "<tbody>";
    for (var i = 0; i < respuesta.length; i++){
    	formulario+="<tr><td>"+respuesta[i]['num_empleado']+"</td>"+
        "<td>"+respuesta[i]['guia']+"</td>"+
        "<td>"+respuesta[i]['acceso']+"</td>"+                  
        "<td>"+
        "<a href='#' onclick='eliminar("+respuesta[i]['num_empleado']+")' class='btn btn-success btn-sm' role='button' title='Eliminar el registro.'><i class='fas fa-trash' aria-hidden='true'></i></a>"+
        "<a href='#'' onclick='bloquear("+respuesta[i]['num_empleado']+")' class='btn btn-success btn-sm' role='button' title='Bloquear el acceso a la Guía para este usuario.'><i class='fas fa-lock' aria-hidden='true'></i></a> "+ 
        "<a href='#' onclick='desbloquear("+respuesta[i]['num_empleado']+")' class='btn btn-success btn-sm' role='button' title='Permitir el acceso a la Guía para este usuario.'><i class='fas fa-unlock' aria-hidden='true'></i></a>"+
        "</td>"+
      	"</tr> ";
    }


	$('#forma').append(formulario+"</table>"); 



}