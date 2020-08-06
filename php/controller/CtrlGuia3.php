<?php
	require_once ("../../php/DTO/PreguntaDTO.php");
	
	
	$pregunta= new PreguntaDTO();
	if (filter_input(INPUT_GET, "id")!=null) {
		$id=filter_input(INPUT_GET, "id");
	}
	
	$secciones= $pregunta->get_secciones_guia_3();  
	$opcion = filter_input(INPUT_GET, "opcion");
	switch ($opcion) {
		case 'seccion':
			echo json_encode($secciones);
			break;

		case 'pregunta':
			$preguntas=$pregunta->get_preguntas_guia_3($id);
			echo json_encode($preguntas);
		
		default:
			# code...
			break;
	}	
	
?>