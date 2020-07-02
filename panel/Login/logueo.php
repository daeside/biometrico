<?php 

require 'conexion.php';

session_start();


$usuarios = $mysqli->query("SELECT nombre_usuario, apellido_usuario, correo_usuario, tipo_usuario
	FROM usuarios
	WHERE usuario = '".$_POST['inputUsuario']."'
	AND pass_usuario = '".$_POST['inputPassword']."'");
if ($usuarios -> num_rows == 1) {
	$datos = $usuarios->fetch_assoc();
	echo json_encode(array(error => false, 'tipo' => $datos['tipo_usuario']));
}
else{
	echo json_encode(array('error' => true));
}

$mysqli -> close();
 ?>