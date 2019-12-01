<?php 
include '../paginas/conexion.php';


session_start();
if (!empty($_POST)) {

	//REGISTRAR USUARIO
	if ($_POST['action'] == 'registrar_usuario')  {
		$nombre = $_POST['nombre'];
		$correo = $_POST['correo'];
		$usuario = $_POST['usuario'];
		$clave = md5($_POST['clave']);
		$rol = $_POST['rol'];

		$foto = $_FILES['foto'];

		echo $nombre;
		// $query = mysqli_query($conexion,"SELECT * FROM usuario WHERE usuario = '$usuario' OR correo = '$correo'");

		// $result = mysqli_fetch_array($query);

		// if ($result > 0) {
		// 	echo 'incorrecto';
		// 	exit;
		// }else{

		// 	$query_insert = mysqli_query($conexion,"INSERT INTO usuario(nombre,correo,usuario,clave,rol) VALUES('$nombre','$correo','$usuario','$clave','$rol')");
		// 	if ($query_insert) {
		// 	 	echo 'se inserto';
		// 	 	exit;
		// 	 }else{
		// 	 	echo 'no se inserto';
		// 	 	exit;
		// 	 }
		// }
	}

	//ACTUALIZAR USUARIO
	if ($_POST['action'] == 'actualizar_usuario')  {
		$id = $_POST['id'];
		$nombre = $_POST['nombre'];
		$correo = $_POST['correo'];
		$usuario = $_POST['usuario'];
		$rol = $_POST['rol'];

		$consulta_user = mysqli_query($conexion,"SELECT * FROM usuario 
					WHERE (usuario = '$usuario' AND idusuario != $id) 
					OR (correo = '$correo' AND idusuario != '$id')");
		$result_consulta = mysqli_fetch_array($consulta_user);

		if ($result_consulta > 0) 
		{
			echo 'incorrecto';
			exit;
		}else{

			$query_user = mysqli_query($conexion,"UPDATE usuario SET nombre='".$nombre."', correo='".$correo."', usuario='".$usuario."', rol='".$rol."' WHERE idusuario='".$id."'");

			if ($query_user > 0) 
			{
				echo 'se modifico';
				exit;
			}else{

				echo 'no se modifico';
				exit;
			}
		}	
	}

	//EXTRAER DATOS DEL USUARIO
	if ($_POST['action'] == 'infousuario')  {
			
		$usuario = $_POST['usuario'];

		$query_usuario = mysqli_query($conexion,"SELECT idusuario,nombre,correo,usuario
			FROM usuario 
			WHERE idusuario = '$usuario' 
			AND estatus = 1");

		$result_usuario = mysqli_num_rows($query_usuario);
		if ($result_usuario > 0) {
			$data_usuario = mysqli_fetch_array($query_usuario);
			echo json_encode($data_usuario,JSON_UNESCAPED_UNICODE);
			exit;
		}else{
			echo 'error';
		}
	}

	//ELIMINAR USUARIO
	if ($_POST['action'] == 'eliminarusuario')  {
		
			$idusuario = $_POST['idusuario'];
			$alert = $_POST['alert'];
		
			$delete_usuario = mysqli_query($conexion,"UPDATE usuario SET estatus = 0 WHERE idusuario = '$idusuario'");
			if ($delete_usuario) {
				
					$usuario = mysqli_query($conexion,"SELECT * FROM usuario WHERE idusuario = '$idusuario'");
					$data_delete = mysqli_fetch_array($usuario);
					echo json_encode($data_delete,JSON_UNESCAPED_UNICODE);
				//header('location: lista_producto.php');
				exit;
				
				
			
			}else{
				echo 'error';
			}
		exit;
	}

	//REGISTRAR CLIENTE
	if ($_POST['action'] == 'registrar_cliente')  {
		$cedula = $_POST['cedula'];
		$nombre = $_POST['nombre'];
		$telefono = $_POST['telefono'];
		$direccion = $_POST['direccion'];
		$usuario_id = $_SESSION['idUser'];

		
		$query = mysqli_query($conexion,"SELECT * FROM cliente WHERE cedula = '$cedula'");

		$result = mysqli_fetch_array($query);

		if ($result > 0) {
			echo 'incorrecto';
			exit;
		}else{

			$query_insert = mysqli_query($conexion,"INSERT INTO cliente(cedula,nombre,telefono,direccion,usuario_id) VALUES('$cedula','$nombre','$telefono','$direccion','$usuario_id')");
			if ($query_insert) {
			 	echo 'se inserto';
			 	exit;
			 }else{
			 	echo 'no se inserto';
			 	exit;
			 }
		}
	}

	//ACTUALIZAR CLIENTE
	if ($_POST['action'] == 'actualizar_cliente')  {
		$id = $_POST['id'];
		$cedula = $_POST['cedula'];
		$nombre = $_POST['nombre'];
		$telefono = $_POST['telefono'];
		$direccion = $_POST['direccion'];

		$consulta_user = mysqli_query($conexion,"SELECT * FROM cliente 
					WHERE (cedula = '$cedula' AND idcliente != $id)");
		$result_consulta = mysqli_fetch_array($consulta_user);

		if ($result_consulta > 0) 
		{
			echo 'incorrecto';
			exit;
		}else{

			$query_user = mysqli_query($conexion,"UPDATE cliente SET cedula='".$cedula."', nombre='".$nombre."', telefono='".$telefono."', direccion='".$direccion."' WHERE idcliente='".$id."'");

			if ($query_user > 0) 
			{
				echo 'se modifico';
				exit;
			}else{

				echo 'no se modifico';
				exit;
			}
		}	
	}

	//EXTRAER DATOS DEL CLIENTE
	if ($_POST['action'] == 'infocliente')  {
			
		$cliente = $_POST['cliente'];

		$query_cliente = mysqli_query($conexion,"SELECT idcliente,cedula,nombre,direccion
			FROM cliente 
			WHERE idcliente = '$cliente' 
			AND estatus = 1");

		$result_cliente = mysqli_num_rows($query_cliente);
		if ($result_cliente > 0) {
			$data_cliente = mysqli_fetch_array($query_cliente);
			echo json_encode($data_cliente,JSON_UNESCAPED_UNICODE);
			exit;
		}else{
			echo 'error';
		}
	}

	//ELIMINAR CLIENTE
	if ($_POST['action'] == 'eliminarcliente')  {
		
			$idcliente = $_POST['idcliente'];
			$alert = $_POST['alert'];
		
			$delete_cliente = mysqli_query($conexion,"UPDATE cliente SET estatus = 0 WHERE idcliente = '$idcliente'");
			if ($delete_cliente) {
				
					$cliente = mysqli_query($conexion,"SELECT * FROM cliente WHERE idcliente = '$idcliente'");
					$data_delete = mysqli_fetch_array($cliente);
					echo json_encode($data_delete,JSON_UNESCAPED_UNICODE);
				//header('location: lista_producto.php');
				exit;
				
				
			
			}else{
				echo 'error';
			}
		exit;
	}

	//REGISTRAR PROVEEDOR
	if ($_POST['action'] == 'registrar_proveedor')  {
		$proveedor = $_POST['proveedor'];
		$contacto = $_POST['contacto'];
		$telefono = $_POST['telefono'];
		$direccion = $_POST['direccion'];
		$usuario_id = $_SESSION['idUser'];

		
		$query_insert = mysqli_query($conexion,"INSERT INTO proveedor(proveedor,contacto,telefono,direccion,usuario_id) VALUES('$proveedor','$contacto','$telefono','$direccion','$usuario_id')");
		if ($query_insert) {
			echo 'se inserto';
			exit;
		}else{
			echo 'no se inserto';
			exit;
		}
	}

	//ACTUALIZAR PROVEEDOR
	if ($_POST['action'] == 'actualizar_proveedor')  {
		$id = $_POST['id'];
		$proveedor = $_POST['proveedor'];
		$contacto = $_POST['contacto'];
		$telefono = $_POST['telefono'];
		$direccion = $_POST['direccion'];

		$query_user = mysqli_query($conexion,"UPDATE proveedor SET proveedor='".$proveedor."', contacto='".$contacto."', telefono='".$telefono."', direccion='".$direccion."' WHERE codproveedor='".$id."'");

		if ($query_user > 0) 
		{
			echo 'se modifico';
			exit;
		}else{

			echo 'no se modifico';
			exit;
		}	
	}

	//EXTRAER DATOS DEL PROVEEDOR
	if ($_POST['action'] == 'infoproveedor')  {
			
		$proveedor = $_POST['proveedor'];

		$query_proveedor = mysqli_query($conexion,"SELECT codproveedor,proveedor,contacto,telefono,direccion
			FROM proveedor 
			WHERE codproveedor = '$proveedor' 
			AND estatus = 1");

		$result_proveedor = mysqli_num_rows($query_proveedor);
		if ($result_proveedor > 0) {
			$data_proveedor = mysqli_fetch_array($query_proveedor);
			echo json_encode($data_proveedor,JSON_UNESCAPED_UNICODE);
			exit;
		}else{
			echo 'error';
		}
	}

	//ELIMINAR PROVEEDOR
	if ($_POST['action'] == 'eliminarproveedor')  {
		
			$codproveedor = $_POST['codproveedor'];
			$alert = $_POST['alert'];
		
			$delete_proveedor = mysqli_query($conexion,"UPDATE proveedor SET estatus = 0 WHERE codproveedor = '$codproveedor'");
			if ($delete_proveedor) {
				
					$proveedor = mysqli_query($conexion,"SELECT * FROM proveedor WHERE codproveedor = '$codproveedor'");
					$data_delete = mysqli_fetch_array($proveedor);
					echo json_encode($data_delete,JSON_UNESCAPED_UNICODE);
				//header('location: lista_producto.php');
				exit;
				
				
			
			}else{
				echo 'error';
			}
		exit;
	}

	//REGISTRAR PRODUCTO
	if ($_POST['action'] == 'registrar_producto')  {
		$proveedor = $_POST['proveedor'];
		$descripcion = $_POST['descripcion'];
		$precio = $_POST['precio'];
		$existencia = $_POST['existencia'];
		$usuario_id = $_SESSION['idUser'];
		// $foto = $_FILE['foto'];
		// $nombre_foto = $foto['name'];
		// $type = $foto['type'];
		// $url_tmp = $foto['tmp_name'];
		
		$imgProducto = 'img_producto.png';

		// if ($nombre_foto != '') 
		// {
		// 	$destino = 'img/uploads/';
		// 	$img_nombre = 'img_'.md5(date('d-m-Y H:m:s'));
		// 	$imgProducto = $img_nombre.'jpg';
		// 	$src = $destino.$imgProducto;
		// }

		
		$query_insert = mysqli_query($conexion,"INSERT INTO producto(proveedor,descripcion,precio,existencia,usuario_id,foto) VALUES('$proveedor','$descripcion','$precio','$existencia','$usuario_id','$imgProducto')");
		if ($query_insert) {
			if ($nombre_foto != '') {
				move_uploaded_file($url_tmp, $src);
			}
			echo 'se inserto';
			exit;
		}else{
			echo 'no se inserto';
			exit;
		}
	}

	//EXTRAER DATOS DE PRODUCTO PARA AGREGAR EXISTENCIA
	if ($_POST['action'] == 'infoProducto')  {
			
		$producto_id = $_POST['producto'];

		$query_producto = mysqli_query($conexion,"SELECT codproducto,descripcion,existencia,precio
			FROM producto 
			WHERE codproducto = '$producto_id' 
			AND estatus = 1");

		$result_producto = mysqli_num_rows($query_producto);
		if ($result_producto > 0) {
			$data_producto = mysqli_fetch_array($query_producto);
			echo json_encode($data_producto,JSON_UNESCAPED_UNICODE);
			exit;
		}else{
			echo 'error';
		}


		// $proveedor = $_POST['proveedor'];
		// $descripcion = $_POST['descripcion'];
		// $precio = $_POST['precio'];
		// $existencia = $_POST['existencia'];
		// $usuario_id = $_SESSION['idUser'];
		// // $foto = $_FILE['foto'];
		// // $nombre_foto = $foto['name'];
		// // $type = $foto['type'];
		// // $url_tmp = $foto['tmp_name'];
		
		// $imgProducto = 'img_producto.png';

		// // if ($nombre_foto != '') 
		// // {
		// // 	$destino = 'img/uploads/';
		// // 	$img_nombre = 'img_'.md5(date('d-m-Y H:m:s'));
		// // 	$imgProducto = $img_nombre.'jpg';
		// // 	$src = $destino.$imgProducto;
		// // }

		
		// $query_insert = mysqli_query($conexion,"INSERT INTO producto(proveedor,descripcion,precio,existencia,usuario_id,foto) VALUES('$proveedor','$descripcion','$precio','$existencia','$usuario_id','$imgProducto')");
		// if ($query_insert) {
		// 	if ($nombre_foto != '') {
		// 		move_uploaded_file($url_tmp, $src);
		// 	}
		// 	echo 'se inserto';
		// 	exit;
		// }else{
		// 	echo 'no se inserto';
		// 	exit;
		// }
	}

	//ENVIAR DATOS DE LOS PRODUCTOS
	if ($_POST['action'] == 'insertardatos')  {
		$cantidad = $_POST['cantidad'];
		$precio = $_POST['precio'];
		$codproducto = $_POST['codproducto'];
		$usuario_id = $_SESSION['idUser'];
		
		if (!empty($cantidad) || !empty($precio) || !empty($codproducto)) 
		{
			$query_insert = mysqli_query($conexion,"INSERT INTO entradas(codproducto,cantidad,precio,usuario_id) VALUES($codproducto,$cantidad,$precio,$usuario_id)");
			if ($query_insert) 
			{
				//ejecutar procedimiento almacenado
				$query_upd = mysqli_query($conexion,"CALL actualizar_precio_producto($cantidad,$precio,$codproducto)");
				$result_pro = mysqli_num_rows($query_upd);
				if ($result_pro > 0) {
					$data = mysqli_fetch_assoc($query_upd);
					$data['codproducto'] = $codproducto;
					echo json_encode($data,JSON_UNESCAPED_UNICODE);
					exit;
				}
			}else{

				echo 'error';
			}	
		}else{

			echo 'error';
		}
		exit;
	}

	//ACTUALIZAR PRODUCTO
	if ($_POST['action'] == 'actualizar_producto')  {
		$codproducto = $_POST['codproducto'];
		$proveedor = $_POST['proveedor'];
		$descripcion = $_POST['descripcion'];
		$precio = $_POST['precio'];

		$query_producto = mysqli_query($conexion,"UPDATE producto SET proveedor='".$proveedor."', descripcion='".$descripcion."', precio='".$precio."' WHERE codproducto='".$codproducto."'");

		if ($query_producto > 0) 
		{
			echo 'se modifico';
			exit;
		}else{

			echo 'no se modifico';
			exit;
		}	
	}

	//ELIMINAR PRODUCTO
	if ($_POST['action'] == 'eliminarproducto')  {
		
			$codproducto = $_POST['codproducto'];
			$alert = $_POST['alert'];
		
			$delete_producto = mysqli_query($conexion,"UPDATE producto SET estatus = 0 WHERE codproducto = $codproducto");
			if ($delete_producto) {
				
					$producto = mysqli_query($conexion,"SELECT * FROM producto WHERE codproducto = $codproducto");
					$data_delete = mysqli_fetch_array($producto);
					echo json_encode($data_delete,JSON_UNESCAPED_UNICODE);
				//header('location: lista_producto.php');
				exit;
				
				
			
			}else{
				echo 'error';
			}
		exit;
	}

	//BUSCAR CLIENTE
	if ($_POST['action'] == 'searchCliente')  
	{
		if (!empty($_POST['cliente'])) 
		{
			$cedula = $_POST['cliente'];

			$query = mysqli_query($conexion,"SELECT * FROM cliente WHERE cedula LIKE '$cedula' AND estatus = 1");
			$result = mysqli_num_rows($query);

			$data = '';
			if ($result > 0) 
			{
			 	$data = mysqli_fetch_assoc($query);
			}else{
				$data = 0;
			}
			echo json_encode($data,JSON_UNESCAPED_UNICODE);
		}
		exit;	
	}

	//REGISTRAR CLIENTE - VEWNTAS
	if ($_POST['action'] == 'addCliente')  
	{
		$cedula = $_POST['cedula_cliente'];
		$nombre = $_POST['nom_cliente'];
		$telefono = $_POST['tel_cliente'];
		$direccion = $_POST['dir_cliente'];
		$usuario_id = $_SESSION['idUser'];

		$query_insert = mysqli_query($conexion,"INSERT INTO cliente(cedula,nombre,telefono,direccion,usuario_id) 
			VALUES('$cedula','$nombre','$telefono','$direccion','$usuario_id')");
			
		if ($query_insert) 
		{
			$codCliente = mysqli_insert_id($conexion);
			$msg = $codCliente;
		}else{
			 $msg = 'error';
		}
		echo $msg;
		exit;
	}

	//AGREGAR PRODUCTO AL DETALLE TEMPORAL
	if ($_POST['action'] == 'addProductoDetalle')
	{
		if (empty($_POST['codproducto']) || empty($_POST['cantidad'])) 
		{
			echo 'error';
		}else{

			$codproducto = $_POST['codproducto'];
			$cantidad = $_POST['cantidad'];
			$token = md5($_SESSION['idUser']);

			$query_iva = mysqli_query($conexion,"SELECT iva FROM configuracion");
			$result_iva = mysqli_num_rows($query_iva);

			$query_detalle_tmp = mysqli_query($conexion,"CALL add_detalle_temp($codproducto,$cantidad,'$token')");
			$result_detalle_tmp = mysqli_num_rows($query_detalle_tmp);

			$detalleTabla = '';
			$sub_total = 0;
			$iva = 0;
			$total = 0;
			$arrayData = array();

			if ($result_detalle_tmp > 0) 
			{
				if ($result_iva > 0) 
				{
					$info_iva = mysqli_fetch_assoc($query_iva);
					$iva = $info_iva['iva'];
				}

				while ($data_detalle_tmp = mysqli_fetch_assoc($query_detalle_tmp)) 
				{
					$precioTotal = round($data_detalle_tmp['cantidad'] * $data_detalle_tmp['precio_venta'], 2);
					$sub_total = round($sub_total + $precioTotal, 2);

					$detalleTabla .= '<tr>
									<td class="text-center">'.$data_detalle_tmp['codproducto'].'</td>
									<td colspan="2" class="text-center">'.$data_detalle_tmp['descripcion'].'</td>
									<td class="text-center">'.$data_detalle_tmp['cantidad'].'</td>
									<td class="text-right">'.$data_detalle_tmp['precio_venta'].'</td>
									<td class="text-right">'.$precioTotal.'</td>
									<td class="text-center">
									<a href="#" class="link_delete delete" onclick="event.preventDefault(); del_product_detalle('.$data_detalle_tmp['correlativo'].');"><i class="fa fa-trash-alt"></i></a>
									</td>
									</tr>';
				}

				$impuesto = round($sub_total * ($iva/100), 2);
				$total = round($sub_total + $impuesto, 2);

				$detalleTotales = '<tr>
								<td colspan="5" class="text-right"><b>SUBTOTAL Bs.</b></td>
								<td class="text-left"><b>'.$sub_total.'</b></td>
								</tr>
								<tr>
								<td colspan="5" class="text-right"><b>IVA ('.$iva.'%)</b></td>
								<td class="text-left"><b>'.$impuesto.'</b></td>
								</tr>
								<tr>
								<td colspan="5" class="text-right"><b>TOTAL Bs.</b></td>
								<td class="text-left"><b>'.$total.'</b></td>
								</tr>';

				$arrayData['detalle'] = $detalleTabla;
				$arrayData['totales'] = $detalleTotales;

				echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);
				
			}else{
				echo 'error';
			}		
		}
		exit;
	}

	//EXTRAE DATOS DEL DETALLE TEMPORAL
	if ($_POST['action'] == 'serchforDetalle')
	{
		if (empty($_POST['user'])) 
		{
			echo 'error';
		}else{

			$token = md5($_SESSION['idUser']);

			$query = mysqli_query($conexion,"SELECT tmp.correlativo,
													tmp.token_user,
													tmp.cantidad,
													tmp.precio_venta,
													p.codproducto,
													p.descripcion
											FROM detalle_temp tmp
											INNER JOIN producto p
											ON tmp.codproducto = p.codproducto
											WHERE token_user = '$token'");
			
			$result = mysqli_num_rows($query);

			$query_iva = mysqli_query($conexion,"SELECT iva FROM configuracion");
			$result_iva = mysqli_num_rows($query_iva);

			$detalleTabla = '';
			$sub_total = 0;
			$iva = 0;
			$total = 0;
			$arrayData = array();

			if ($result > 0) 
			{
				if ($result_iva > 0) 
				{
					$info_iva = mysqli_fetch_assoc($query_iva);
					$iva = $info_iva['iva'];
				}

				while ($data_detalle_tmp = mysqli_fetch_assoc($query)) 
				{
					$precioTotal = round($data_detalle_tmp['cantidad'] * $data_detalle_tmp['precio_venta'], 2);
					$sub_total = round($sub_total + $precioTotal, 2);

					$detalleTabla .= '<tr>
									<td>'.$data_detalle_tmp['codproducto'].'</td>
									<td colspan="2">'.$data_detalle_tmp['descripcion'].'</td>
									<td class="textcenter">'.$data_detalle_tmp['cantidad'].'</td>
									<td class="textright">'.$data_detalle_tmp['precio_venta'].'</td>
									<td class="textright">'.$precioTotal.'</td>
									<td class="">
									<a href="#" class="link_delete" onclick="event.preventDefault(); del_product_detalle('.$data_detalle_tmp['correlativo'].');"><i class="fas fa-trash-alt"></i></a>
									</td>
									</tr>';
				}

				$impuesto = round($sub_total * ($iva/100), 2);
				$total = round($sub_total + $impuesto, 2);

				$detalleTotales = '<tr>
								<td colspan="5" class="textright">SUBTOTAL Bs.</td>
								<td class="textright">'.$sub_total.'</td>
								</tr>
								<tr>
								<td colspan="5" class="textright">IVA ('.$iva.'%)</td>
								<td class="textright">'.$impuesto.'</td>
								</tr>
								<tr>
								<td colspan="5" class="textright">TOTAL Bs.</td>
								<td class="textright">'.$total.'</td>
								</tr>';

				$arrayData['detalle'] = $detalleTabla;
				$arrayData['totales'] = $detalleTotales;

				echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);
				exit;
			}else{
				echo 'error';
			}		
		}
		exit;
	}

	//ELIMINAR DETALLE DE FACTURA
	if ($_POST['action'] == 'delPorductoDetalle')
	{
		if (empty($_POST['id_detalle'])) 
		{
			echo 'error';
		}else{

			$id_detalle = $_POST['id_detalle'];
			$token = md5($_SESSION['idUser']);
			
			$query_iva = mysqli_query($conexion,"SELECT iva FROM configuracion");
			$result_iva = mysqli_num_rows($query_iva);

			$query_detalle_tmp = mysqli_query($conexion,"CALL del_detalle_temp($id_detalle,'$token')");
			$result_detalle_tmp = mysqli_num_rows($query_detalle_tmp);

			$detalleTabla = '';
			$sub_total = 0;
			$iva = 0;
			$total = 0;
			$arrayData = array();

			if ($result_detalle_tmp > 0) 
			{
				if ($result_iva > 0) 
				{
					$info_iva = mysqli_fetch_assoc($query_iva);
					$iva = $info_iva['iva'];
				}

				while ($data_detalle_tmp = mysqli_fetch_assoc($query_detalle_tmp)) 
				{
					$precioTotal = round($data_detalle_tmp['cantidad'] * $data_detalle_tmp['precio_venta'], 2);
					$sub_total = round($sub_total + $precioTotal, 2);

					$detalleTabla .= '<tr>
									<td>'.$data_detalle_tmp['codproducto'].'</td>
									<td colspan="2">'.$data_detalle_tmp['descripcion'].'</td>
									<td class="textcenter">'.$data_detalle_tmp['cantidad'].'</td>
									<td class="textright">'.$data_detalle_tmp['precio_venta'].'</td>
									<td class="textright">'.$precioTotal.'</td>
									<td class="">
									<a href="#" class="link_delete" onclick="event.preventDefault(); del_product_detalle('.$data_detalle_tmp['correlativo'].');"><i class="fas fa-trash-alt"></i></a>
									</td>
									</tr>';
				}

				$impuesto = round($sub_total * ($iva/100), 2);
				$total = round($sub_total + $impuesto, 2);

				$detalleTotales = '<tr>
								<td colspan="5" class="textright">SUBTOTAL Bs.</td>
								<td class="textright">'.$sub_total.'</td>
								</tr>
								<tr>
								<td colspan="5" class="textright">IVA ('.$iva.'%)</td>
								<td class="textright">'.$impuesto.'</td>
								</tr>
								<tr>
								<td colspan="5" class="textright">TOTAL Bs.</td>
								<td class="textright">'.$total.'</td>
								</tr>';

				$arrayData['detalle'] = $detalleTabla;
				$arrayData['totales'] = $detalleTotales;

				echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);
				exit;
			}else{
				echo 'error';
			}		
		}
		exit;
	}

	//ANULAR VENTA
	if ($_POST['action'] == 'anularVenta')
	{
		$token = md5($_SESSION['idUser']);
		$query_del = mysqli_query($conexion,"DELETE FROM detalle_temp WHERE token_user = '$token'");
		if ($query_del) 
		{
			echo "ok";
		}else{
			echo "error";
		}
		exit;
	}

	//PROCESAR VENTA
	if ($_POST['action'] == 'procesarVenta')
	{
		if (empty($_POST['codcliente']))
		{
			echo 'error';
		}else{
			$codcliente = $_POST['codcliente'];
		}

		$token = md5($_SESSION['idUser']);
		$usuario = $_SESSION['idUser'];

		$query = mysqli_query($conexion,"SELECT * FROM detalle_temp WHERE token_user = '$token'");
		$result = mysqli_num_rows($query);

		if ($result) 
		{
			$query_procesar = mysqli_query($conexion,"CALL procesar_venta($usuario,$codcliente,'$token')");
			$resultado_procesar = mysqli_num_rows($query_procesar);

			if ($resultado_procesar > 0) 
			{
				$data_procesar = mysqli_fetch_assoc($query_procesar);
				echo json_encode($data_procesar,JSON_UNESCAPED_UNICODE);
			}else{
				echo "error";
			}
		}else{
			echo "error";
		}
		exit;
	}

	//MODAL ANULAR FACTURA
	if ($_POST['action'] == 'infoFactura')
	{
		if (!empty($_POST['nofactura'])) 
		{
			$nofactura = $_POST['nofactura'];
			$query = mysqli_query($conexion,"SELECT * FROM factura WHERE nofactura = '$nofactura' AND estatus = 1");
			mysqli_close($conexion);

			$result = mysqli_num_rows($query);

			if ($result > 0) 
			{
				$data = mysqli_fetch_assoc($query);
				echo json_encode($data,JSON_UNESCAPED_UNICODE);
				exit;
			}
		}
		echo 'error';
		exit;
	}

	//ANULAR FACTURA
	if ($_POST['action'] == 'anularFactura') 
	{
		if (!empty($_POST['nofactura'])) 
		{
			$nofactura = $_POST['nofactura'];

			$query_anular = mysqli_query($conexion,"CALL anular_factura($nofactura)");
			$result_anular = mysqli_num_rows($query_anular);
			if ($result_anular > 0) 
			{
				$data = mysqli_fetch_assoc($query_anular);
				echo json_encode($data,JSON_UNESCAPED_UNICODE);
				exit;
			}
		}
		echo "error";
		exit;
	}

	//FORMULARIO CAMBIAR CONTRASEÑA
	if ($_POST['action'] == 'changePassword') 
	{
		if (!empty($_POST['passActual']) && !empty($_POST['passNuevo'])) 
		{
			$password = md5($_POST['passActual']);
			$newPass = md5($_POST['passNuevo']);
			$idUser = $_SESSION['idUser'];

			$code = '';
			$msg = '';
			$arrData = array();

			$query_user = mysqli_query($conexion,"SELECT * FROM usuario WHERE clave = '$password' AND idusuario = '$idUser'");
			$result_user = mysqli_num_rows($query_user);

			if ($result_user > 0)
			{
				$query_update = mysqli_query($conexion,"UPDATE usuario SET clave = '$newPass' WHERE idusuario = '$idUser'");

				if ($query_update) 
				{
					$code = '00';
					$msg = '<p style="color: green;">Su contraseña se ha actualizado con exito.</p>';
				}else{
					$code = '2';
					$msg = '<p style="color: red;">No es posible cambiar su contraseña.</p>';
				}
			}else{
				$code = '1';
				$msg = '<p style="color: red;">La contraseña actual es incorrecta.</p>';
			}

			$arrData =array('cod' => $code, 'msg' => $msg);
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
		}else
		{
			echo "error";
		}
		exit;
	}

	//ACTUALIZAR DATOS EMPRESA
	if ($_POST['action'] == 'updateDataEmpresa') 
	{
		if (empty($_POST['txtEmpRegistro']) || empty($_POST['txtEmpNombre']) || empty($_POST['txtRSocial']) || empty($_POST['txtEmpTelefono']) || empty($_POST['txtEmpEmail']) || empty($_POST['txtEmpDireccion']) || empty($_POST['txtEmpIva'])) 
		{
			$code = '1';
			$msg = "Todos los campos son obligatorios";
		}else{

			$registro = intval($_POST['txtEmpRegistro']);
	        $nombre = $_POST['txtEmpNombre'];
	        $razon_social = $_POST['txtRSocial'];
	        $telefono = intval($_POST['txtEmpTelefono']);
	        $email = $_POST['txtEmpEmail'];
	        $direccion = $_POST['txtEmpDireccion'];
	        $iva = $_POST['txtEmpIva'];

	        $queryUpd = mysqli_query($conexion,"UPDATE configuracion SET rif = $registro, nombre = '$nombre', razon_social = '$razon_social', telefono = $telefono, email = '$email', direccion = '$direccion', iva = $iva WHERE id = 1");

	        if ($queryUpd) 
	        {
	        	$code = '00';
	        	$msg = "Datos actualizados correctamente.";
	        }else{
	        	$code = '2';
	        	$msg = "Error al actualizar los datos.";
	        }
		}

		$arrData = array('cod' => $code, 'msg' => $msg);
		echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
		exit;
	}

	//RESPALDAR
	if ($_POST['action'] == 'respaldo')  {
		
	$fecha=getdate();
	$nombre='Respaldo__'.$fecha["mday"]."-".$fecha["mon"]."-".$fecha["year"]."__".$fecha["hours"]."-".$fecha["minutes"]."-".$fecha["seconds"].".sql";

	//$nombre= 'Respaldo_'.date('d-m-Y').'.sql';
	$directorio= "C:\\php\\respaldo";

	$dir= $directorio.'\\'.$nombre;

	$comando= "C:\\xampp\\mysql\\bin\\mysqldump.exe --opt --user=$user --password=$pw $bd > $dir";
	system($comando, $error);

	
	if ($comando) {
		echo "respaldo";
	}else{
		echo "error";
	}
		exit;
	}
	

mysqli_close($conexion);
}


?>