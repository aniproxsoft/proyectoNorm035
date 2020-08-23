<?php 
require_once ("../../php/conexion/ClassConnection.php");
$db       = new connectionDB();
$conexion = $db->get_connection();
$conexion->exec("set names utf8");

	
	$respuesta= array();
	//Se obtiene el parametro de opcion y el numero del empleado el cual se va a modificar.
	$num_empleado = filter_input(INPUT_GET, "num_empleado")."";
	$opcion = filter_input(INPUT_GET, "opcion");
	//Según la opción se va a otorgar permiso, bloquear o eliminar un empleado seleccionado por el administrador.
	$consulta= $conexion->prepare("CALL sp_update_num_empleado(?,?)");
	$consulta->bindParam(1,$num_empleado);
	$consulta->bindParam(2,$opcion);
    $consulta->execute();

    while($row=$consulta->fetch(PDO::FETCH_ASSOC)){
      	$respuesta[] = $row;
	}
    $consulta->closeCursor(); 
	$consulta= null; 
	$db = null;
	$conexion=null;

	$arreglo=array("flag"=> $respuesta[0]['flag'], "msg"=>$respuesta[0]['msg']);
	

	
	echo json_encode($arreglo);
		



 ?>

