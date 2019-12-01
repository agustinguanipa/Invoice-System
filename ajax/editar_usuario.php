<?php 

include "../paginas/conexion.php";

// Actualizar Usuario

	$id = $_POST['id'];
	$nombre = $_POST['nombre'];
	$correo = $_POST['correo'];
	$usuario = $_POST['usuario'];
	$clave = $_POST['clave'];
	$rol = $_POST['rol'];

	$query_user = mysqli_query($conexion,"UPDATE usuario SET nombre='".$nombre."', correo='".$correo."', usuario='".$usuario."', rol='".$rol."' WHERE idusuario='".$id."'");

	header('location: ../paginas/usuario_actualizar_exito.php');
?>