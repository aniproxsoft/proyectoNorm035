<?php
class UsuarioDTO {
//Variables

	private $usuario_id;
	private $rol_id;
	private $nombre_rol;


	public function __construct()
    {
    }

     //Getters and Setters
    public function getUsuario_id()
    {
        return $this->usuario_id;
    }
    public function setUsuario_id($usuario_id)
    {
        return $this->usuario_id=$usuario_id;
    }


     public function getRol_id()
    {
        return $this->rol_id;
    }
    public function setUsuario_id($rol_id)
    {
        return $this->rol_id=$rol_id;
    }

     public function getUsuario_id()
    {
        return $this->usuario_id;
    }
    public function setUsuario_id($nombre_rol)
    {
        return $this->nombre_rol=$nombre_rol;
    }






}


?>
