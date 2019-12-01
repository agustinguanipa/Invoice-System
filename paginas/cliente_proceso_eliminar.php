<?php 
	include ('conexion.php');
	$idcliente = $_POST['id'];
			$delete_cliente = mysqli_query($conexion,"UPDATE cliente SET estatus = 0 WHERE idcliente = '$idcliente'");
			if ($delete_cliente) {
				
					$cliente = mysqli_query($conexion,"SELECT * FROM cliente WHERE idcliente = '$idcliente'");

				header('location: cliente_lista.php');
				exit;
			}else{
				echo 'error';
			}
		exit;

 ?>