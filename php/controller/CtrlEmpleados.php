<?php
require_once "../../php/conexion/ClassConnection.php";
class CtrlEmpleados {
 	private $db       = null;
 	private $conexion = null;
 	private $empleados=array();
 	private $niveles_estudio=array();
 	private $divisiones=array();
 	private $puestos=array();
 	private $resultadosguia=array();
 	private $guiasResultas=array();
 	private $categorias= array();
 	private $global= array();
 	private $dominio= array();

	public function __construct(){

	}

	public function getNivelEstudios(){
 		try {
 			$this->db       = new connectionDB();
 			$this->conexion = $this->db->get_connection();
        	$statement= $this->conexion->prepare("CALL sp_get_nivel_estudios()");
        	$statement->execute();
        	while($row=$statement->fetch(PDO::FETCH_ASSOC)){
  
      			$this->niveles_estudio[] = $row;
 
			}

			$statement->closeCursor(); // opcional en MySQL, dependiendo del controlador de base de datos puede ser obligatorio
			$statement = null; // obligado para cerrar la conexión
			$db = null;
			$conexion=null;
        	return $this->niveles_estudio;
    	}catch(PDOException $e){
			echo 'Error conectando con la base de datos: ' . $e->getMessage();
		}
 	}


 	public function getDivisiones(){
 		try {
 			$this->db       = new connectionDB();
 			$this->conexion = $this->db->get_connection();
        	$statement= $this->conexion->prepare("CALL sp_get_divisiones()");
        	$statement->execute();
        	while($row=$statement->fetch(PDO::FETCH_ASSOC)){
  
      			$this->divisiones[] = $row;
 
			}

			$statement->closeCursor(); // opcional en MySQL, dependiendo del controlador de base de datos puede ser obligatorio
			$statement = null; // obligado para cerrar la conexión
			$db = null;
			$conexion=null;
        	return $this->divisiones;
    	}catch(PDOException $e){
			echo 'Error conectando con la base de datos: ' . $e->getMessage();
		}
 	}

  	public function getPuestos(){
 		try {
 			$this->db       = new connectionDB();
 			$this->conexion = $this->db->get_connection();
        	$statement= $this->conexion->prepare("CALL sp_get_puestos()");
        	$statement->execute();
        	while($row=$statement->fetch(PDO::FETCH_ASSOC)){
  
      			$this->puestos[] = $row;
 
			}

			$statement->closeCursor(); 
			$statement = null; // obligado para cerrar la conexión
			$db = null;
			$conexion=null;
        	return $this->puestos;
    	}catch(PDOException $e){
			echo 'Error conectando con la base de datos: ' . $e->getMessage();
		}
 	}

	public function getEmpleados(){
 		try {
 			$this->db       = new connectionDB();
 			$this->conexion = $this->db->get_connection();
 			$opcion='all';
			$statement = $this->conexion->prepare("CALL sp_get_employees(?)");
			$statement->bindParam(1,$opcion);
			$statement->execute();

			while($row=$statement->fetch(PDO::FETCH_ASSOC)){
      			
      			$this->empleados[] = $row;
			}
			$statement->closeCursor();
			$statement = null; // obligado para cerrar la conexión
			$db = null;
			$conexion=null;
		}catch(PDOException $e){
			echo 'Error conectando con la base de datos: ' . $e->getMessage();
		}
		
		return $this->empleados;

	}
	public function getEmpleadosSinAdmin(){
 		try {
 			$this->db       = new connectionDB();
 			$this->conexion = $this->db->get_connection();
 			$opcion='some';
			$statement = $this->conexion->prepare("CALL sp_get_employees(?)");
			$statement->bindParam(1,$opcion);
			$statement->execute();

			while($row=$statement->fetch(PDO::FETCH_ASSOC)){
      			
      			$this->empleados[] = $row;
			}
			$statement->closeCursor();
			$statement = null; // obligado para cerrar la conexión
			$db = null;
			$conexion=null;
		}catch(PDOException $e){
			echo 'Error conectando con la base de datos: ' . $e->getMessage();
		}
		
		return $this->empleados;

	}
	public function getEmpleadoSeleccionado($num_empleado){
 		try {
 			$this->db       = new connectionDB();
 			$this->conexion = $this->db->get_connection();
 			$opcion='one';
			$statement = $this->conexion->prepare("CALL sp_get_employee_select(?,?)");
			$statement->bindParam(1,$opcion);
			$statement->bindParam(2,$num_empleado);
			$statement->execute();

			while($row=$statement->fetch(PDO::FETCH_ASSOC)){
      			
      			$this->empleados[] = $row;
			}
			$statement->closeCursor();
			$statement = null; // obligado para cerrar la conexión
			$db = null;
			$conexion=null;
		}catch(PDOException $e){
			echo 'Error conectando con la base de datos: ' . $e->getMessage();
		}
		
		return $this->empleados;

	}
	public function getNumEmpleados(){
 		try {
 			$this->db       = new connectionDB();
 			$this->conexion = $this->db->get_connection();
 			$statement = $this->conexion->prepare("CALL sp_get_num_eployees()");
			$statement->execute();

			while($row=$statement->fetch(PDO::FETCH_ASSOC)){
      			
      			$this->empleados[] = $row;
			}
			$statement->closeCursor();
			$statement = null; // obligado para cerrar la conexión
			$db = null;
			$conexion=null;
		}catch(PDOException $e){
			echo 'Error conectando con la base de datos: ' . $e->getMessage();
		}
		
		return $this->empleados;

	}

	public function getResultadoGuia($num_empleado){
 		try {
 			$this->db       = new connectionDB();
 			$this->conexion = $this->db->get_connection();
			$statement = $this->conexion->prepare("CALL sp_get_guiaResuelta(?)");
			$statement->bindParam(1,$num_empleado);
			$statement->execute();

			while($row=$statement->fetch(PDO::FETCH_ASSOC)){
      			
      			$this->resultadosguia[] = $row;
			}
			$statement->closeCursor();
			$statement = null; // obligado para cerrar la conexión
			$db = null;
			$conexion=null;
		}catch(PDOException $e){
			echo 'Error conectando con la base de datos: ' . $e->getMessage();
		}
		
		return $this->resultadosguia;

	}

	public function getResultadoGuia2($num_empleado){
 		try {
 			$this->db       = new connectionDB();
 			$this->conexion = $this->db->get_connection();
			$statement = $this->conexion->prepare("CALL sp_get_respuestas_guia_2(?)");
			$statement->bindParam(1,$num_empleado);
			$statement->execute();

			while($row=$statement->fetch(PDO::FETCH_ASSOC)){
      			
      			$this->resultadosguia[] = $row;
			}
			$statement->closeCursor();
			$statement = null; // obligado para cerrar la conexión
			$db = null;
			$conexion=null;
		}catch(PDOException $e){
			echo 'Error conectando con la base de datos: ' . $e->getMessage();
		}
		
		return $this->resultadosguia;

	}
	public function getResultadoGuia3($num_empleado){
 		try {
 			$this->db       = new connectionDB();
 			$this->conexion = $this->db->get_connection();
			$statement = $this->conexion->prepare("CALL sp_get_respuestas_guia_3(?)");
			$statement->bindParam(1,$num_empleado);
			$statement->execute();

			while($row=$statement->fetch(PDO::FETCH_ASSOC)){
      			
      			$this->resultadosguia[] = $row;
			}
			$statement->closeCursor();
			$statement = null; // obligado para cerrar la conexión
			$db = null;
			$conexion=null;
		}catch(PDOException $e){
			echo 'Error conectando con la base de datos: ' . $e->getMessage();
		}
		
		return $this->resultadosguia;

	}

	public function getGuiasResueltas($num_empleado){
 		try {
 			$this->db       = new connectionDB();
 			$this->conexion = $this->db->get_connection();
			$statement = $this->conexion->prepare("CALL sp_get_guias_contestadas(?)");
			$statement->bindParam(1,$num_empleado);
			$statement->execute();

			while($row=$statement->fetch(PDO::FETCH_ASSOC)){
      			
      			$this->guiasResultas[] = $row;
			}
			$statement->closeCursor();
			$statement = null; // obligado para cerrar la conexión
			$db = null;
			$conexion=null;
		}catch(PDOException $e){
			echo 'Error conectando con la base de datos: ' . $e->getMessage();
		}
		
		return $this->guiasResultas;

	}
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








