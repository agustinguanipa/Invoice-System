<?php 

include "../paginas/conexion.php";

// Actualizar Usuario

	$id = $_POST['id'];
	$nombre = $_POST['nombre'];
	$telefono = $_POST['telefono'];
	$direccion = $_POST['direccion'];

		$query_user = mysqli_query($conexion,"UPDATE cliente SET nombre='".$nombre."', telefono='".$telefono."', direccion='".$direccion."' WHERE idcliente='".$id."'");

	header('location: ../paginas/cliente_actualizar_exito.php');
?>