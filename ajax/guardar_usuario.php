<?php 

	include "../paginas/conexion.php";

	$nombre = $_POST['nombre'];
	$correo = $_POST['correo'];
	$usuario = $_POST['usuario'];
	$clave = $_POST['clave'];
	$estatus = 1;
	$rol = $_POST['rol'];

	$query_insert = mysqli_query($conexion,"INSERT INTO usuario(nombre,correo,usuario,clave,estatus,rol) VALUES('$nombre','$correo','$usuario','$clave','$estatus','$rol')");
	

	header('location: ../paginas/usuario_registro_exito.php');
?>