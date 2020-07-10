<?php
	require_once '../../php/controller/ctrlResultados.php';
	$ctrlResultados= new ctrlResultados();
	$criterios=$ctrlResultados->getCriterios();

	echo json_encode($criterios);

?>