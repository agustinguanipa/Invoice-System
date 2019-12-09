<?php
  session_start();

  if (!isset($_SESSION['active'])) {
    header('Location: ../index.php');
    exit();
  }

	include "../conexion.php";
	require_once '../pdf/vendor/autoload.php';
	use Dompdf\Dompdf;

	if(empty($_REQUEST['cl']) || empty($_REQUEST['f']))
	{
		echo "No es posible generar la factura.";
	}else{
		$codcliente = $_REQUEST['cl'];
		$nofactura = $_REQUEST['f'];
		$anulada = '';

		$query_config   = mysqli_query($conexion,"SELECT * FROM configuracion");
		$result_config  = mysqli_num_rows($query_config);
		
		if($result_config > 0)
		{
			$configuracion = mysqli_fetch_assoc($query_config);
		}


		$query = mysqli_query($conexion,"SELECT f.nofactura, DATE_FORMAT(f.fecha, '%d/%m/%Y') as fecha, DATE_FORMAT(f.fecha,'%H:%i:%s') as  hora, f.codcliente, f.estatus,
												 v.nombre as vendedor,
												 cl.cedula, cl.nombre, cl.telefono,cl.direccion
											FROM factura f
											INNER JOIN usuario v
											ON f.usuario = v.idusuario
											INNER JOIN cliente cl
											ON f.codcliente = cl.idcliente
											WHERE f.nofactura = $nofactura AND f.codcliente = $codcliente  AND f.estatus != 10 ");

		$result = mysqli_num_rows($query);
		
		if($result > 0)
		{
			$factura = mysqli_fetch_assoc($query);
			$no_factura = $factura['nofactura'];

			// $query_cliente = mysqli_query($conexion,"SELECT ced_vended FROM client_dis WHERE ced_client = '".$factura['ced_client']."'");
			// $resulta_cliente = mysqli_num_rows($query_cliente);
			// $data_cliente = mysqli_fetch_assoc($query_cliente);
			// $ced_vendedor = $data_cliente['ced_vended'];


			// $query_vendedor = mysqli_query($conexion,"SELECT * FROM vended_dis WHERE ced_vended = '$ced_vendedor'");
			// $resulta_vendedor = mysqli_num_rows($query_vendedor);
			// $data_vendedor = mysqli_fetch_assoc($query_vendedor);
	
			if($factura['estatus'] == 2)
			{
				$anulada = '<img class="anulada" src="img/anulado.png" alt="Anulada">';
			}

			$query_productos = mysqli_query($conexion,"SELECT p.descripcion,dt.cantidad,dt.precio_venta,(dt.cantidad * dt.precio_venta) as precio_total
														FROM factura f
														INNER JOIN detallefactura dt
														ON f.nofactura = dt.nofactura
														INNER JOIN producto p
														ON dt.codproducto = p.codproducto
														WHERE f.nofactura = $no_factura ");
			$result_detalle = mysqli_num_rows($query_productos);

			ob_start();
		    include(dirname('__FILE__').'/factura.php');
		    $html = ob_get_clean();

			// instantiate and use the dompdf class
			$dompdf = new Dompdf();

			$dompdf->loadHtml($html);
			// (Optional) Setup the paper size and orientation
			$dompdf->setPaper('letter', 'portrait');
			// Render the HTML as PDF
			$dompdf->render();
			// Output the generated PDF to Browser
			$dompdf->stream('factura_'.$nofactura.'.pdf',array('Attachment'=>0));
			exit;
		}
	}

?>