<?php
require_once "../../php/conexion/ClassConnection.php";

$db       = new connectionDB();
$conexion = $db->get_connection();

$empleados=array();

$opcion='all';




try {
$statement = $conexion->prepare("CALL sp_get_employees(?)");
$statement->bindParam(1,$opcion);
$statement->execute();


while($row=$statement->fetch(PDO::FETCH_ASSOC)){
  
      $empleados[] = $row;
 
}



}catch(PDOException $e){
	echo 'Error conectando con la base de datos: ' . $e->getMessage();
}


$statement->closeCursor(); // opcional en MySQL, dependiendo del controlador de base de datos puede ser obligatorio
$statement = null; // obligado para cerrar la conexión
$db = null;
$conexion=null;
?>








