
function guardar(){
	var num_empleado=document.getElementById("num_empleado").value;

	if(num_empleado>0 && num_empleado.length>=6){
		window.fetch("../../php/controller/CtrlNumEmpleados.php?num_empleado=" + encodeURIComponent(num_empleado)+"&opcion=nuevo").then(respuesta => {
      	if (respuesta.ok){
        	return respuesta.json();
      	} else {
        	throw new Error(respuesta.statusText);
      	}
    		}).then(res => llenaFormGuardar(res))
        	.catch(e => alert(e));
	}else{
		document.getElementById("error").style.display="none";
		document.getElementById("existe").style.display="none";
		document.getElementById("requiredNumero").style.display="block";
	}
	
}

function llenaFormGuardar(res){
	if(res['msg']=="El numero de empleado ya existe."){
		document.getElementById("requiredNumero").style.display="none";
		document.getElementById("error").style.display="none";
		document.getElementById("existe").style.display="block";
	}else if(res['flag']==0){
		document.getElementById("requiredNumero").style.display="none";
		document.getElementById("existe").style.display="none";
		document.getElementById("error").style.display="block";
	}else if (res['flag']==1) {
		alert(res['msg']);
		location.href="../../vistas/adm/permisos.php";
	}
	
	
}



function eliminar(num_empleado){
	var opcion=confirm('¿Estas seguro?');
	
    if (opcion == true) {
        window.fetch("../../php/controller/CtrlNumEmpleados.php?num_empleado=" + encodeURIComponent(num_empleado)+"&opcion=eliminar").then(respuesta => {
      		if (respuesta.ok){
        		return respuesta.json();
      		} else {
        		throw new Error(respuesta.statusText);
      		}
    	}).then(res => llenaFormEliminar(res))
        .catch(e => alert(e));
	} 
	
}

function llenaFormEliminar(res){
	alert(res['msg']);
	location.href="../../vistas/adm/permisos.php";
	
	
	
}

function bloquear(num_empleado){
	var opcion=confirm('¿Quiere bloquear el acceso al usuario?');
	if(opcion==true){
		window.fetch("../../php/controller/CtrlNumEmpleados.php?num_empleado=" + encodeURIComponent(num_empleado)+"&opcion=bloquear").then(respuesta => {
      	if (respuesta.ok){
        	return respuesta.json();
      	} else {
        	throw new Error(respuesta.statusText);
      	}
    	}).then(res => llenaFormBloquear(res))
        .catch(e => alert(e));
	}
	
}

function llenaFormBloquear(res){
	alert(res['msg']);
	location.href="../../vistas/adm/permisos.php";
	
	
	
}



function desbloquear(num_empleado){
	var opcion=confirm('¿Desea desbloquear el usuario?');
	if(opcion==true){
		window.fetch("../../php/controller/CtrlNumEmpleados.php?num_empleado=" + encodeURIComponent(num_empleado)+"&opcion=desbloquear").then(respuesta => {
      	if (respuesta.ok){
        	return respuesta.json();
      	} else {
        	throw new Error(respuesta.statusText);
      	}
    	}).then(res => llenaFormDesbloquear(res))
        .catch(e => alert(e));

	}
}

function llenaFormDesbloquear(res){
	alert(res['msg']);
	location.href="../../vistas/adm/permisos.php";
	
	
	
}


