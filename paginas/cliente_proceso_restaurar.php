<?php 
	include ('conexion.php');
	$idcliente = $_POST['id'];
			$restaurar_cliente = mysqli_query($conexion,"UPDATE cliente SET estatus = 1 WHERE idcliente = '$idcliente'");
			if ($restaurar_cliente) {
				
					$cliente = mysqli_query($conexion,"SELECT * FROM cliente WHERE idcliente = '$idcliente'");

				header('location: cliente_lista_inactivo.php');
				exit;
			}else{
				echo 'error';
			}
		exit;

 ?>