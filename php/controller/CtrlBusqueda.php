<?php
	require_once ("../../php/DTO/EmpleadoDTO.php");
	
	
	$emp= new EmpleadoDTO();
	$opc=filter_input(INPUT_GET, "opc");
	$search = filter_input(INPUT_GET, "search");
	
	
	$usuarios= $emp->get_busqueda_empleados($opc,$search);  

	echo json_encode($usuarios);	
?>