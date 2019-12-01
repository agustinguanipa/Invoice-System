<?php 
	include ('conexion.php');
	$codproducto = $_POST['id'];
			$restaurar_producto = mysqli_query($conexion,"UPDATE producto SET estatus = 1 WHERE codproducto = '$codproducto'");
			if ($restaurar_producto) {
				
					$producto = mysqli_query($conexion,"SELECT * FROM producto WHERE codproducto = '$codproducto'");

				header('location: producto_lista_inactivo.php');
				exit;
			}else{
				echo 'error';
			}
		exit;

 ?>