<?php

class EmpleadoDTO {
//Variables


    private $num_empleado;
    private $nombre_empleado;
    private $apellidos;
    private $nombre_completo;
    private $edad;
    private $sexo;
    private $sexo_completo;
    private $nivel_estudios_id;
    private $nombre_estudios;
    private $estatus_estudios;
    private $division_id;
    private $nombre_division;
    private $status;
    private $acceso;
    private $status_guia;

	


	public function __construct()
    {
    }

     //Getters and Setters
    public function getNum_empleado()
    {
        return $this->num_empleado;
    }
    public function setNum_empleado($num_empleado)
    {
        return $this->num_empleado=$num_empleado;
    }

    public function getNombre_empleado()
    {
        return $this->nombre_empleado;
    }
    public function setNombre_empleado($nombre_empleado)
    {
        return $this->nombre_empleado=$nombre_empleado;
    }

    public function getApellidos()
    {
        return $this->apellidos;
    }
    public function setApellidos($apellidos)
    {
        return $this->apellidos=$apellidos;
    }

    public function getNombre_completo()
    {
        return $this->nombre_completo;
    }
    public function setNombre_completo($nombre_completo)
    {
        return $this->nombre_completo=$nombre_completo;
    }


    public function getEdad()
    {
        return $this->edad;
    }
    public function setEdad($edad)
    {
        return $this->edad=$edad;
    }


    public function getSexo()
    {
        return $this->sexo;
    }
    public function setSexo($sexo)
    {
        return $this->sexo=$sexo;
    }


    public function getSexo_completo()
    {
        return $this->sexo_completo;
    }
    public function setSexo_completo($sexo_completo)
    {
        return $this->sexo_completo=$sexo_completo;
    }

    public function getNivel_estudios_id()
    {
        return $this->nivel_estudios_id;
    }
    public function setNivel_estudios_id($nivel_estudios_id)
    {
        return $this->nivel_estudios_id=$nivel_estudios_id;
    }

    public function getNombre_estudios()
    {
        return $this->nombre_estudios;
    }
    public function setNombre_estudios($nombre_estudios)
    {
        return $this->nombre_estudios=$nombre_estudios;
    }

    public function getEstatus_estudios()
    {
        return $this->estatus_estudios;
    }
    public function setEstatus_estudios($estatus_estudios)
    {
        return $this->estatus_estudios=$estatus_estudios;
    }


    public function getDivision_id()
    {
        return $this->division_id;
    }
    public function setDivision_id($division_id)
    {
        return $this->division_id=$division_id;
    }

    public function getNombre_division()
    {
        return $this->nombre_division;
    }
    public function setNombre_division($nombre_division)
    {
        return $this->nombre_division=$nombre_division;
    }
    public function getStatus()
    {
        return $this->status;
    }
    public function setStatus($status)
    {
        return $this->status=$status;
    }
    public function getAcceso()
    {
        return $this->acceso;
    }
    public function setAcceso($acceso)
    {
        return $this->acceso=$acceso;
    }
    public function getStatusGuia()
    {
        return $this->status_guia;
    }
    public function setStatusGuia($status_guia)
    {
        return $this->status_guia=$status_guia;
    }

}


?>
