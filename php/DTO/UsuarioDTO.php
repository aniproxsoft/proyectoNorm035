<?php
require_once "EmpleadoDTO.php";
class UsuarioDTO extends EmpleadoDTO{
//Variables

	private $usuario_id;
	private $rol_id;
	private $nombre_rol;
    private $password;
    private $flag;
    private $menu_user;


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
    public function setRol_id($rol_id)
    {
        return $this->rol_id=$rol_id;
    }

     public function getNombre_rol()
    {
        return $this->nombre_rol;
    }
    public function setNombre_rol($nombre_rol)
    {
        return $this->nombre_rol=$nombre_rol;
    }
     public function getPassword()
    {
        return $this->password;
    }
    public function setPassword($password)
    {
        return $this->password=$password;
    }
     public function getFlag()
    {
        return $this->flag;
    }
    public function setFlag($flag)
    {
        return $this->flag=$flag;
    }


    public function setMenu_user($empleado){
       
            $this->menu_user='
                                <a class="btn btn-secondary dropdown-toggle" href="#" role="button"
                                id="dropdownMenuButton"  data-toggle="dropdown" aria-haspopup="true"
                                aria-expand="true">'.$empleado.'
                                    
                                </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="../info_sesion/mi_info.php">Mi info</a>
                                <a class="dropdown-item" href="../info_sesion/cerrar_sesion">Cerrar Sesión</a>
                            
                            </div>
                        
                        ';
        

    }
    public function getMenu_user(){
        return $this->menu_user;
    }




}


?>
