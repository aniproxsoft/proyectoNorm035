<?php
require_once "../../php/conexion/ClassConnection.php";
class CtrlResultados {
 	private $db       = null;
 	private $conexion = null;
 	private $categorias=null;
 	private $global=null;
 	private $dominio=null;
 	private $crieterios=null;

 	public function __construct(){}

 	public function getResultadosGlobalGuia3($num_empleado){
 		try {
 			$this->db       = new connectionDB();
 			$this->conexion = $this->db->get_connection();
			$statement = $this->conexion->prepare("CALL sp_get_resultados_guia_3(?,1)");
			$statement->bindParam(1,$num_empleado);
			$statement->execute();

			while($row=$statement->fetch(PDO::FETCH_ASSOC)){
      			
      			$this->global[] = $row;
			}
			$statement->closeCursor();
			$statement = null; // obligado para cerrar la conexión
			$db = null;
			$conexion=null;
		}catch(PDOException $e){
			echo 'Error conectando con la base de datos: ' . $e->getMessage();
		}
		
		return $this->global;

	}

 	public function getResultadosCategoriaGuia3($num_empleado){
 		try {
 			$this->db       = new connectionDB();
 			$this->conexion = $this->db->get_connection();
			$statement = $this->conexion->prepare("CALL sp_get_resultados_guia_3(?,2)");
			$statement->bindParam(1,$num_empleado);
			$statement->execute();

			while($row=$statement->fetch(PDO::FETCH_ASSOC)){
      			
      			$this->categorias[] = $row;
			}
			$statement->closeCursor();
			$statement = null; // obligado para cerrar la conexión
			$db = null;
			$conexion=null;
		}catch(PDOException $e){
			echo 'Error conectando con la base de datos: ' . $e->getMessage();
		}
		
		return $this->categorias;

	}

	public function getResultadosDominioGuia3($num_empleado){
 		try {
 			$this->db       = new connectionDB();
 			$this->conexion = $this->db->get_connection();
			$statement = $this->conexion->prepare("CALL sp_get_resultados_guia_3(?,3)");
			$statement->bindParam(1,$num_empleado);
			$statement->execute();

			while($row=$statement->fetch(PDO::FETCH_ASSOC)){
      			
      			$this->dominio[] = $row;
			}
			$statement->closeCursor();
			$statement = null; // obligado para cerrar la conexión
			$db = null;
			$conexion=null;
		}catch(PDOException $e){
			echo 'Error conectando con la base de datos: ' . $e->getMessage();
		}
		
		return $this->dominio;

	}

	public function getCriterios(){
 		try {
 			$this->db       = new connectionDB();
 			$this->conexion = $this->db->get_connection();
			$statement = $this->conexion->prepare("CALL sp_get_criterios_guia3()");
			$statement->execute();

			while($row=$statement->fetch(PDO::FETCH_ASSOC)){
      			
      			$this->criterios[] = $row;
			}
			$statement->closeCursor();
			$statement = null; // obligado para cerrar la conexión
			$db = null;
			$conexion=null;
		}catch(PDOException $e){
			echo 'Error conectando con la base de datos: ' . $e->getMessage();
		}
		
		return $this->criterios;

	}
}
?>