alert("Una vez contestada una pregunta NO PODRÁS CAMBIAR LA RESPUESTA");
resp_array=[];
var json_res;
var status=0;
function contestar(){
	$("#seccionModal").modal({backdrop: 'static', keyboard: false});
}
$("#seccionModal").modal({backdrop: 'static', keyboard: false});
var secciones;
window.fetch("../../php/controller/CtrlGuia3.php?opcion=seccion"
   ).then(respuesta => {
   if (respuesta.ok){
     return respuesta.json();
   } else {
     throw new Error(respuesta.statusText);
   }
 }).then(respuesta => getSeccion(respuesta,0)).catch(e => alert(e));
             
function getSeccion(respuesta,valor){
	switch(valor+1){
		case 1:
			muestraModalSeccion(respuesta,valor);

		break;
		case 2:
			
			if(resp_array.length==5){
				muestraModalSeccion(respuesta,valor);
				contestar();

			}else{
				alert("Contesta todas las preguntas");
			}
		break;
		case 3:
			if(resp_array.length==8){
				muestraModalSeccion(respuesta,valor);
				contestar();

			}else{
				alert("Contesta todas las preguntas");
			}
		break;
		case 4:
			if(resp_array.length==12){
				muestraModalSeccion(respuesta,valor);
				contestar();

			}else{
				alert("Contesta todas las preguntas");
			}
		break;

		case 5:
			if(resp_array.length==16){
				muestraModalSeccion(respuesta,valor);
				contestar();

			}else{
				alert("Contesta todas las preguntas");
			}
		break;
		case 6:
			if(resp_array.length==22){
				muestraModalSeccion(respuesta,valor);
				contestar();

			}else{
				alert("Contesta todas las preguntas");
			}
		break;
		case 7:
			if(resp_array.length==28){
				muestraModalSeccion(respuesta,valor);
				contestar();

			}else{
				alert("Contesta todas las preguntas");
			}
		break;
		case 8:
			if(resp_array.length==30){
				muestraModalSeccion(respuesta,valor);
				contestar();

			}else{
				alert("Contesta todas las preguntas");
			}
		break;
		case 9:
			if(resp_array.length==36){
				muestraModalSeccion(respuesta,valor);
				contestar();

			}else{
				alert("Contesta todas las preguntas");
			}
		break;
		case 10:
			if(resp_array.length==41){
				muestraModalSeccion(respuesta,valor);
				contestar();

			}else{
				alert("Contesta todas las preguntas");
			}
		break;
		case 11:
			if(resp_array.length==46){
				muestraModalSeccion(respuesta,valor);
				contestar();

			}else{
				alert("Contesta todas las preguntas");
			}
		break;
		case 12:
			if(resp_array.length==56){
				muestraModalSeccion(respuesta,valor);
				contestar();

			}else{
				alert("Contesta todas las preguntas");
			}
		break;
		case 13:
			if(resp_array.length==64){
				muestraModalSeccion(respuesta,valor);
				contestar();

			}else{
				alert("Contesta todas las preguntas");
			}
		break;
		case 14:
			if(status=1 && resp_array.length==68){
				muestraModalSeccion(respuesta,valor);
				contestar();

			}else if(status=1 && resp_array.length<68){
				alert("Contesta todas las preguntas");
			}else if(status=0){
				muestraModalSeccion(respuesta,valor);
				contestar();
			}
		break;
		
	}
	
		  
	

    
   	  
}

function muestraModalSeccion(respuesta,valor){
	$('#titulo').remove();
    $('#desc').remove();
    $('#botones').remove();
	let desc="";
    let titulo="";
    let botones="";
	if(valor==12 || valor==13){
		validarSeccion(respuesta,valor);
	}else{
		botones="<a style='margin-left:20px' href='#tabla' class='btn btn-primary'"+
    	" onclick='getPreguntas("+(valor+1)+",0)' data-dismiss='modal'>Aceptar</a>";
    	secciones=respuesta;
    	desc=secciones[valor]["nombre_seccion"];
    	titulo="Seccion "+secciones[valor]["seccion_id"];
    	$('#exampleModalLabel').append("<div id='titulo'>"+titulo+'</div>');
    	$('#seccion_desc').append("<div id='desc'>"+desc+"</div>");
    	$('#botones_modal').append("<div id='botones'>"+botones+"</div>"); 
	}
}

function getPreguntas(seccion,status){
	this.status=status;
	document.getElementById("contestar").style.display="none";
	document.getElementById("contenedor").style.display="block";
	bajar();
	window.fetch("../../php/controller/CtrlGuia3.php?opcion=pregunta&id="+seccion
   ).then(respuesta => {
   if (respuesta.ok){
     return respuesta.json();
   } else {
                  throw new Error(respuesta.statusText);
   }
 }).then(respuesta => llenaPreguntas(respuesta,seccion)).catch(e => alert(e));
	
}

function llenaPreguntas(respuesta,seccion){
	$('#preguntas').remove();
	
	let formulario="<table id='tabla' class='table table-hover'> <thead class='thead-light'><tr><th scope='col'>Num</th><th scope='col'>Pregunta</th><th scope='col'>Respuestas</th></tr></thead>";
	
	for (var i = 0; i < respuesta.length; i++){

		formulario+="<tbody><tr>"+"<td style='width:5%'>"+respuesta[i]["pregunta_id"]+"</td>"+
                 "<td style='width:50%'>"+respuesta[i]["pregunta_desc"]+"</td>"+
                    "<td>"+
                      "<div >"+
                        "<label  ><input class='form-control'  type='radio' onclick='armarJson("+respuesta[i]["pregunta_id"]+")' id='siempre"+respuesta[i]["pregunta_id"]+"' value='SIEMPRE'  name='respuesta"+respuesta[i]["pregunta_id"]+"'>Siempre</label>"+
                        "<label >"+
                        "<label  style='margin-left: 10px;'><input class='form-control'  type='radio' onclick='armarJson("+respuesta[i]["pregunta_id"]+")' id='casiSiempre"+respuesta[i]["pregunta_id"]+"' value='CASI SIEMPRE' name='respuesta"+respuesta[i]["pregunta_id"]+"' >Casi siempre</label>"+
                        "<label >"+
                        "<label  style='margin-left: 10px;'><input class='form-control'  type='radio' onclick='armarJson("+respuesta[i]["pregunta_id"]+")' id='algunasVeces"+respuesta[i]["pregunta_id"]+"' value='ALGUNAS VECES' name='respuesta"+respuesta[i]["pregunta_id"]+"'>Algunas veces</label>"+
                        "<label >"+
                        "<label  style='margin-left: 10px;'><input class='form-control'  type='radio' onclick='armarJson("+respuesta[i]["pregunta_id"]+")' id='casiNunca"+respuesta[i]["pregunta_id"]+"' name='respuesta"+respuesta[i]["pregunta_id"]+"' value='CASI NUNCA' >Casi nunca</label>"+
                        "<label >"+
                        "<label  style='margin-left: 10px;'><input class='form-control'  type='radio' onclick='armarJson("+respuesta[i]["pregunta_id"]+")' id='nunca"+respuesta[i]["pregunta_id"]+"' name='respuesta"+respuesta[i]["pregunta_id"]+"' value='NUNCA' >Nunca</label>"+
                        "<label >"+
                      "</div>"+
                    "</td></tr></tbody>";
               
	}
	if(seccion==14){
		formulario+="</table>"+
		"<hr><div id='boton'><button id='botonGuardar' type='button' class='btn btn-primary'"+ 
		"style='float: right;' "+
 		"data-target='#seccionModal' onclick='guardar()' >Guardar</button></div>";
	}else{
		formulario+="</table>"+
		"<hr><div id='boton'><button  id='botonSiguiente' type='button' class='btn btn-primary'"+ 
		"style='float: right;' "+
 		"data-target='#seccionModal' onclick='siguiente("+(seccion+1)+")' >Siguiente</button></div>";
	}
	
	 $('#tab').append("<div id='preguntas'>"+formulario+"</div>"); 
	
}

function bajar(){
	
	$('html, body').animate({scrollTop: 400}, 'slow');
}


function siguiente(valor){



window.fetch("../../php/controller/CtrlGuia3.php?opcion=seccion"
   ).then(respuesta => {
   if (respuesta.ok){
     return respuesta.json();
   } else {
     throw new Error(respuesta.statusText);
   }
 }).then(respuesta => getSeccion(respuesta,(valor-1)).catch(e => alert(e)));
}

function validarSeccion(respuesta,valor){

			$('#titulo').remove();
    		$('#desc').remove();
    		$('#botones').remove();
			let desc="";
    		let titulo="";
    		let botones="";
    		botones="<a style='margin-left:20px' href='#tabla' class='btn btn-primary'"+
    		" onclick='getModal2("+(valor+1)+")' >Aceptar</a>";
    		secciones=respuesta;
    		desc=secciones[valor]["nombre_seccion"];
    		titulo="Seccion "+secciones[valor]["seccion_id"];
    		$('#exampleModalLabel').append("<div id='titulo'>"+titulo+'</div>');
    		$('#seccion_desc').append("<div id='desc'>"+desc+"</div>");
    		$('#botones_modal').append("<div id='botones'>"+botones+"</div>"); 
			
}

function getModal2(valor){
	status=0;
	$('#titulo').remove();
    $('#desc').remove();
    $('#botones').remove();
	let desc="";
    let titulo="";
    let botones="";

	switch(valor){
		case 13:
			botones="<button type='button' class='btn btn-secondary' onclick='getModal2("+(valor+1)+")'>No"+
    		"</button><a style='margin-left:20px' href='#tabla' class='btn btn-primary'"+
    		" onclick='getPreguntas("+valor+",1)' data-dismiss='modal' >Si</a>";
    		
    		desc="¿En mi trabajo debo brindar servicio a clientes o usuarios?";
    		titulo="Seccion "+valor;
    		$('#exampleModalLabel').append("<div id='titulo'>"+titulo+'</div>');
    		$('#seccion_desc').append("<div id='desc'>"+desc+"</div>");
    		$('#botones_modal').append("<div id='botones'>"+botones+"</div>");
		break;
		case 14:
			botones="<button type='button' class='btn btn-secondary' data-dismiss='modal' onclick='respuestaNo(0)'>No"+
    		"</button><a style='margin-left:20px' href='#tabla' class='btn btn-primary'"+
    		" onclick='getPreguntas("+valor+",1)' data-dismiss='modal' >Si</a>";
    		
    		desc="¿Soy jefe de otros trabajadores?";
    		titulo="Seccion "+valor;
    		$('#exampleModalLabel').append("<div id='titulo'>"+titulo+'</div>');
    		$('#seccion_desc').append("<div id='desc'>"+desc+"</div>");
    		$('#botones_modal').append("<div id='botones'>"+botones+"</div>");
		break;

	}
}

function armarJson(pregunta_id){
	document.getElementById("siempre"+pregunta_id).disabled=true;
	document.getElementById("casiSiempre"+pregunta_id).disabled=true;
	document.getElementById("algunasVeces"+pregunta_id).disabled=true;
	document.getElementById("casiNunca"+pregunta_id).disabled=true;
	document.getElementById("nunca"+pregunta_id).disabled=true;

	var resp=$('input[name=respuesta'+pregunta_id+']:checked', '#formulario').val();
   	var usuario= document.getElementById("usuario").value;

   	resp_array.push({pregunta_id,resp,usuario});
   	
   	
                
}

function respuestaNo(status){
	$('#botonSiguiente').remove();
	$('#boton').append("<button id='botonGuardar' type='button' class='btn btn-primary'"+ 
		"style='float: right;' "+
 		"data-target='#seccionModal' onclick='guardar()' >Guardar</button>");
	this.status=status;
	$('html, body').animate({scrollTop: 2000}, 'slow');


}



function guardar(){
	if (status==1) {
		if (validaPreguntas()) {
			mostrarLoading();
			json_res=JSON.stringify(resp_array);
			console.log(json_res);
			mandarJson();
			
		}else{
			alert("Contesta todas las preguntas");
		}
	}else{
		mostrarLoading();
		json_res=JSON.stringify(resp_array);
		console.log(json_res);
		mandarJson();

	}
	
}


function mandarJson(){




	window.fetch("../../php/controller/CtrlRespuestas.php?json=" + encodeURIComponent(json_res)
   +"&opcion=4").then(respuesta => {
   if (respuesta.ok){
     return respuesta.json();
   } else {
     throw new Error(respuesta.statusText);
   }
 }).then(respuesta => recibeRespuesta(respuesta).catch(e => alert(e)));
}





function recibeRespuesta(respuesta){
	alert(respuesta);
	window.location="../../index.html";

}




function validaPreguntas(){
	var respuestas=0;
	for (var i = 64; i < resp_array.length; i++) {
		switch(resp_array[i]["pregunta_id"]){
			case 69:
				respuestas=respuestas+1;
			break;
			case 70:
				respuestas=respuestas+1;
			break;
			case 71:
				respuestas=respuestas+1;
			break;
			case 72:
				respuestas=respuestas+1;
			break;
		}
	}
	if (respuestas==4) {
		return true;
	}else{
		return false;
	}
}

function mostrarLoading(){


	$('#botonGuardar').remove();
	$('#boton').append(
  	"<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>"+
  	"<span class='sr-only'>Loading...</span>"+
	"</button>"+
	"<button style='float: right;' class='btn btn-primary' type='button' disabled>"+
  	"<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>"+
  	"Cargando..."+
	"</button>");
	
}




	
	
