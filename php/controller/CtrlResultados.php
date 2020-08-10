<?php
require_once "../../php/conexion/ClassConnection.php";
class CtrlResultados {
 	private $db       = null;
 	private $conexion = null;
 	private $categorias= array();
 	private $global= array();
 	private $dominio= array();
 	private $crieterios= array();

 	public function __construct(){}

 	public function getResultadosGlobalGuia2($num_empleado){
 		try {
 			$this->db       = new connectionDB();
 			$this->conexion = $this->db->get_connection();
			$statement = $this->conexion->prepare("CALL sp_get_resultados_guia_2(?,1)");
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

 	public function getResultadosCategoriaGuia2($num_empleado){
 		try {
 			$this->db       = new connectionDB();
 			$this->conexion = $this->db->get_connection();
			$statement = $this->conexion->prepare("CALL sp_get_resultados_guia_2(?,2)");
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

	public function getResultadosDominioGuia2($num_empleado){
 		try {
 			$this->db       = new connectionDB();
 			$this->conexion = $this->db->get_connection();
			$statement = $this->conexion->prepare("CALL sp_get_resultados_guia_2(?,3)");
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
			$statement = $this->conexion->prepare("CALL sp_get_criterios(?)");
			$valor=1;
			$statement->bindParam(1,$valor);
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