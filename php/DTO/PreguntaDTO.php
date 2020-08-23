<?php
require_once ("../../php/conexion/ClassConnection.php");
class PreguntaDTO {
//Variables
    private $db;
    private $conexion;
	private $pregunta_id;
	private $seccion_id;
	private $pregunta_desc;
    private $nombre_seccion;
    private $secciones;
    private $preguntas;

	public function __construct()
    {
        
        $this->db      = new connectionDB();
        $this->conexion = $this->db->get_connection();
        $this->conexion->exec("set names utf8");
        $this->pregunta_desc= array();
        $this->pregunta_desc2= array();
        $this->pregunta_desc3= array();
        $this->pregunta_desc4= array();
        
    }
    // Función que hace una consulta de la base de datos de las preguntas de la sección 1 de la Guía 1
    public function get_preguntas1(){
        $consulta= $this->conexion->prepare("CALL sp_get_preguntasI()");
        $consulta->execute();
        while($filas=$consulta->fetch()){
            $this->pregunta_desc[]=$filas;
            
        }
        return $this->pregunta_desc;
    }
    // Función que hace una consulta de la base de datos de las preguntas de la sección 2 de la Guía 1

     public function get_preguntas2(){
        $consulta= $this->conexion->prepare("CALL sp_get_preguntas2()");
        $consulta->execute();
        while($filas=$consulta->fetch()){
            $this->pregunta_desc2[]=$filas;
            
        }
        return $this->pregunta_desc2;
    }
    // Función hace una consulta de la base de datos de las preguntas de la sección 3 de la Guía 1

    public function get_preguntas3(){
        $consulta= $this->conexion->prepare("CALL sp_get_preguntas3()");
        $consulta->execute();
        while($filas=$consulta->fetch()){
            $this->pregunta_desc3[]=$filas;
            
        }
        return $this->pregunta_desc3;
    }
    // Función que hace una consulta de la base de datos de las preguntas de la sección 4 de la Guía 1

    public function get_preguntas4(){
        $consulta= $this->conexion->prepare("CALL sp_get_preguntas4()");
        $consulta->execute();
        while($filas=$consulta->fetch()){
            $this->pregunta_desc4[]=$filas;
            
        }
        return $this->pregunta_desc4;
    }


    //Guia de referencia 2
    //Consulta en la base de datos las secciones de la guia 2
     public function get_secciones_guia_2(){
        $consulta= $this->conexion->prepare("CALL sp_get_secciones_guia_2()");
        $consulta->execute();
        while($filas=$consulta->fetch()){
            $this->secciones[]=$filas;

            
        }
        
         return $this->secciones;
    } 



    //Preguntas de la guia 2
    //Consulta en la base de datos las preguntas de la Guía 2 según la sección
    public function get_preguntas_guia_2($opc){
        
        $consulta= $this->conexion->prepare("CALL sp_get_preguntas_guia_2(?)");
        $consulta->bindParam(1,$opc);
        $consulta->execute();
        while($filas=$consulta->fetch()){
            $this->preguntas[]=$filas;
            
        }
        
        return $this->preguntas;
    }

    //Guia de referencia 3
    // Consulta en la base de datos las secciones de la Guia 3
    public function get_secciones_guia_3(){
        $consulta= $this->conexion->prepare("CALL sp_get_secciones_guia_3()");
        $consulta->execute();
        while($filas=$consulta->fetch()){
            $this->secciones[]=$filas;

            
        }
        
         return $this->secciones;
    } 

    //Preguntas de la guia 3
    // Consulta en la Base de datos las preguntas de las secciones de la Guía 3 Según la sección
    public function get_preguntas_guia_3($opc){
        
        $consulta= $this->conexion->prepare("CALL sp_get_preguntas_guia_3(?)");
        $consulta->bindParam(1,$opc);
        $consulta->execute();
        while($filas=$consulta->fetch()){
            $this->preguntas[]=$filas;
            
        }
        
        return $this->preguntas;
    }

   
     //Getters and Setters
    public function getPregunta_id()
    {
        return $this->pregunta_id;
    }
    public function setPregunta_id($pregunta_id)
    {
        return $this->pregunta_id=$pregunta_id;
    }


     public function getSeccion_id()
    {
        return $this->seccion_id;
    }
    public function setSeccion_id($seccion_id)
    {
        return $this->seccion_id=$seccion_id;
    }

     public function getPregunta_desc()
    {
        return $this->pregunta_desc;
    }
    public function setPregunta_desc($pregunta_desc)
    {
        return $this->pregunta_desc=$pregunta_desc;
    }

    public function getNombre_seccion()
    {
        return $this->nombre_seccion;
    }
    public function setNombre_seccion($nombre_seccion)
    {
        return $this->nombre_seccion=$nombre_seccion;
    }








}


?>
