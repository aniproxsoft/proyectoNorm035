<?php
	require_once '../../php/controller/ctrlResultados3.php';
	$ctrlResultados3= new ctrlResultados3();
	$criterios=$ctrlResultados3->getCriterios();

	echo json_encode($criterios);

?>