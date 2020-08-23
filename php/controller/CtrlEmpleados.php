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
	//Consulta en la Base de datos los Niveles de estudios que puede tener un empleado
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

 	//Consulta en la Base de Datos las Divisiones de la Universidad
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

 	//Consulta en la Base de Datos los Puestos que puede tener un Empleado

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

 	//Consulta todos los empleados de la base de datos 
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
	// Consulta en la base de datos los empleados sin el administrador y los que ya contestaron al menos una Guía
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
	//Consulta la información de un solo empleado (El que el administrador eligió)
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
	// Consulta en la base de datos si es que los empleados ya realizaron las guias o no y si es que tienen el acceso permitido o no
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
	//Consulta los resultados de la Guía 1 de un solo empleado
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
	//Consulta los resultados de la Guía 2 de un solo empleado

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
	//Consulta en la base de datos el resultado de la Guía 3 de un solo empleado
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
	//Obtiene de la Base de datos lass Guías que un empleado ya realizó
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
	//Obtiene el resultado  de la calificación total de la Guía 2 en la base de datos
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
	//Obtiene el resultado  de la calificación por categoria de la Guía 2 en la base de datos

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
	//Obtiene el resultado  de la calificación por Dominio de la Guía 2 en la base de datos
	

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
	//Obtiene el resultado  de la calificación total de la Guía 3 en la base de datos

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
	//Obtiene el resultado  de la calificación por Categoria de la Guía 3 en la base de datos

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
	//Obtiene el resultado  de la calificación por Dominio de la Guía 3 en la base de datos

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
	//Consulta de la base de datos las sugerencias a tomar por cada resultado de la Guía2
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








