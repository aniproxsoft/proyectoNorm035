<?php 
require_once ("../../php/conexion/ClassConnection.php");
$db       = new connectionDB();
$conexion = $db->get_connection();
$conexion->exec("set names utf8");

	$arreglo =  array();
	array_push($arreglo, "Registro Correcto");

	$json = filter_input(INPUT_GET, "json");
	$opcion = filter_input(INPUT_GET, "opcion");
	

	if ($opcion==1){
		$consulta= $conexion->prepare("CALL sp_insert_respuestas(?)");
		$consulta->bindParam(1,$json);
    	$consulta->execute();
    	$consulta->closeCursor(); 
		$consulta= null; 
		$db = null;
		$conexion=null;
	}elseif ($opcion==2) {
		$consulta= $conexion->prepare("CALL sp_insert_empleado(?)");
		$consulta->bindParam(1,$json);
    	$consulta->execute();
    	$consulta->closeCursor(); 
		$consulta= null; 
		$db = null;
		$conexion=null;
	}elseif ($opcion==3) {
		$consulta= $conexion->prepare("CALL sp_insert_respuestas_guia_2(?)");
		$consulta->bindParam(1,$json);
    	$consulta->execute();
    	$consulta->closeCursor(); 
		$consulta= null; 
		$db = null;
		$conexion=null;
	}elseif ($opcion==4){
		$consulta= $conexion->prepare("CALL sp_insert_respuestas_guia_3(?)");
		$consulta->bindParam(1,$json);
    	$consulta->execute();
    	$consulta->closeCursor(); 
		$consulta= null; 
		$db = null;
		$conexion=null;
	}

	
	echo json_encode($arreglo);
		



 ?>

