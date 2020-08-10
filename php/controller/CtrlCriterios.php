<?php
	require_once "../../php/conexion/ClassConnection.php";

 	$criterios=null;
 	$db       = null;
 	$conexion = null;


 	try {
 			$db       = new connectionDB();
 			$conexion = $db->get_connection();
			$statement = $conexion->prepare("CALL sp_get_criterios()");
			$statement->execute();

			while($row=$statement->fetch(PDO::FETCH_ASSOC)){
      			
      			$criterios[] = $row;
			}
			$statement->closeCursor();
			$statement = null; // obligado para cerrar la conexión
			$db = null;
			$conexion=null;

		}catch(PDOException $e){
			echo 'Error conectando con la base de datos: ' . $e->getMessage();
		}

	
	echo json_encode($criterios);
	

?>