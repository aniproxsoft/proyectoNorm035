<?php
include '../../php/DTO/UsuarioDTO.php';
session_start();
// error_reporting(0);
$sesion  = $_SESSION['usuario'];
$usuario = unserialize($sesion);
if (!isset($sesion)) {
    header("Location:../../vistas/iniciar_sesion/iniciar_sesion.html");
    die();
}else if(isset($sesion)){
    if(!($usuario->getRol_id()==2) and !($usuario->getRol_id()==3)){
        header("Location:../../vistas/iniciar_sesion/acceso_denegado.php");
    }
}
?>


