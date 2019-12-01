<?php 
	include ('conexion.php');
	$codproducto = $_POST['id'];
			$delete_producto = mysqli_query($conexion,"UPDATE producto SET estatus = 0 WHERE codproducto = '$codproducto'");
			if ($delete_producto) {
				
					$producto = mysqli_query($conexion,"SELECT * FROM producto WHERE codproducto = '$codproducto'");

				header('location: producto_lista.php');
				exit;
			}else{
				echo 'error';
			}
		exit;

 ?>