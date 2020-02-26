<?php
require_once "../conexion/ClassConnection.php";
require_once "../DTO/UsuarioDTO.php";
$db       = new connectionDB();
$conexion = $db->get_connection();
$conexion->exec("set names utf8");

$usuario = new UsuarioDTO();

$num_empleado=$_POST['num_empleado'];
$password=$_POST['password'];
try {
$statement = $conexion->prepare("CALL sp_autentification(?,?)");
$statement->bindParam(1,$num_empleado);
$statement->bindParam(2,$password);
$statement->execute();

$respuesta = array();

while($row=$statement->fetch(PDO::FETCH_ASSOC)){
  
      $respuesta[] = $row;
 
}

$usuario->setFlag($respuesta[0]["flag"]);
$usuario->setNum_empleado($respuesta[0]["num_empleado"]);
$usuario->setNombre_empleado($respuesta[0]["nombre_empleado"]);
$usuario->setApellidos($respuesta[0]["apellidos"]);
$usuario->setNombre_completo($respuesta[0]["nombre_completo"]);
$usuario->setEdad($respuesta[0]["edad"]);
$usuario->setSexo($respuesta[0]["sexo"]);
$usuario->setSexo_completo($respuesta[0]["sexo_completo"]);
$usuario->setNivel_estudios_id($respuesta[0]["nivel_estudios_id"]);
$usuario->setNombre_estudios($respuesta[0]["nombre_estudios"]);
$usuario->setEstatus_estudios($respuesta[0]["estatus_estudios"]);
$usuario->setDivision_id($respuesta[0]["division_id"]);
$usuario->setNombre_division($respuesta[0]["nombre_division"]);
$usuario->setUsuario_id($respuesta[0]["usuario_id"]);
$usuario->setRol_id($respuesta[0]["rol_id"]);
$usuario->setNombre_rol($respuesta[0]["nombre_rol"]);

}catch(PDOException $e){
	echo 'Error conectando con la base de datos: ' . $e->getMessage();
}


if ($usuario->getFlag() == 1 and $usuario->getRol_id() == 1) {
    session_start();
    $_SESSION['usuario'] = serialize($usuario);
    header("Location:../../vistas/adm/adm_index.php");
} else if($usuario->getFlag() == 1 and ($usuario->getRol_id() == 2 or $usuario->getRol_id() == 3)){
	session_start();
	$_SESSION['usuario'] = serialize($usuario);
    header("Location:../../vistas/emp/emp_index.php");
}else {
    ?>
	<script type="text/javascript">
		alert("Error contraseña y/o correo incorrecto")
		location.href="../../vistas/iniciar_sesion/iniciar_sesion.html";
		//poner msj q esta en bd
	</script>
	<?php

}
$statement->closeCursor(); // opcional en MySQL, dependiendo del controlador de base de datos puede ser obligatorio
$statement = null; // obligado para cerrar la conexión
$db = null;
$conexion=null;
?>








