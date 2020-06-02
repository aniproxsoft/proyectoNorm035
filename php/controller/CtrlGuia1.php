	<?php
	require_once ("../../php/DTO/PreguntaDTO.php");
	require_once ("../../vistas/emp/guia1.php");
	
	
	

	$pregunta= new PreguntaDTO();
	$matrizPreguntas= $pregunta->get_preguntas1();  	
	$matrizPreguntas2= $pregunta->get_preguntas2();
	$matrizPreguntas3= $pregunta->get_preguntas3();
	$matrizPreguntas4= $pregunta->get_preguntas4();


	
	?>
	