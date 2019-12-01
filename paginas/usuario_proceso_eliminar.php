<?php 
	include ('conexion.php');
	$idusuario = $_POST['id'];
			$delete_usuario = mysqli_query($conexion,"UPDATE usuario SET estatus = 0 WHERE idusuario = '$idusuario'");
			if ($delete_usuario) {
				
					$usuario = mysqli_query($conexion,"SELECT * FROM usuario WHERE idusuario = '$idusuario'");

				header('location: usuario_lista.php');
				exit;
			}else{
				echo 'error';
			}
		exit;

 ?>