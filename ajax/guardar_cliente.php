<?php

	session_start(); 

	include "../paginas/conexion.php";

	$cedula = $_POST['cedula'];
	$nombre = $_POST['nombre'];
	$telefono = $_POST['telefono'];
	$direccion = $_POST['direccion'];
	$estatus = 1;
	$usuario_id = $_SESSION['idUser'];

	$query_insert = mysqli_query($conexion,"INSERT INTO cliente(cedula,nombre,telefono,direccion,estatus,usuario_id) VALUES('$cedula','$nombre','$telefono','$direccion','$estatus','$usuario_id')");
	

	header('location: ../paginas/cliente_registro_exito.php');
?>