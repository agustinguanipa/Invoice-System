<?php 
session_start();
 include "../paginas/conexion.php";

 $actual = md5($_POST['txtPassUser']);
 $nueva = md5($_POST['txtNewPassUser']);
 $confirmacion = $_POST['txtPassConfirm'];
 $idusuario = $_SESSION['idUser'];

	 
	$query_user = mysqli_query($conexion,"SELECT * FROM usuario WHERE clave = '$actual' AND idusuario = '$idusuario'");
	$result_user = mysqli_num_rows($query_user);

	if ($result_user > 0)
	{
		$query_update = mysqli_query($conexion,"UPDATE usuario SET clave = '$nueva' WHERE idusuario = '$idusuario'");

		if ($query_update) 
		{
			echo 'actualizo';
		}

		}else{
			echo 'La clave actual es incorrecta';
		}
		header('location: ../paginas/configuracion.php');
 ?>

