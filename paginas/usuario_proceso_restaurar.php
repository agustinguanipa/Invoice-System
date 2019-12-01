<?php 
	include ('conexion.php');
	$idusuario = $_POST['id'];
			$restaurar_usuario = mysqli_query($conexion,"UPDATE usuario SET estatus = 1 WHERE idusuario = '$idusuario'");
			if ($restaurar_usuario) {
				
					$usuario = mysqli_query($conexion,"SELECT * FROM usuario WHERE idusuario = '$idusuario'");

				header('location: usuario_lista_inactivo.php');
				exit;
			}else{
				echo 'error';
			}
		exit;

 ?>