<?php 
	include ('conexion.php');
	
		$nofactura = $_POST['id'];

		$query_anular = mysqli_query($conexion,"CALL anular_factura($nofactura)");
		$result_anular = mysqli_num_rows($query_anular);
		if ($result_anular > 0) 
		{
			$data = mysqli_fetch_assoc($query_anular);
			echo json_encode($data,JSON_UNESCAPED_UNICODE);
			header('location: venta_lista.php');
			exit;
		}
	
	echo "error";
	exit;

 ?>