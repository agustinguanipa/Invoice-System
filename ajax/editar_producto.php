<?php 

include "../paginas/conexion.php";

// Actualizar Producto

	$id = $_POST['id'];
	$descripcion = $_POST['descripcion'];
	$precio = $_POST['precio'];
	$existencia = $_POST['existencia'];
	$imgProducto = $_POST['foto_actual'];
	$imgRemove = $_POST['foto_remove'];

	$foto = $_FILES['foto'];

	$nombre_foto = $foto['name'];
	$type = $foto['type'];
	$url_temp = $foto['tmp_name'];

	$upd = '';

	if ($nombre_foto != '')
	{
		$destino = '../imagen/uploads/';
		$img_nombre = 'img_'.md5(date('d-m-Y H:m:s'));
		$imgProducto = $img_nombre.'.jpg';
		$src = $destino.$imgProducto;
	}else{
		if ($_POST['foto_actual'] != $_POST['foto_remove']) 
		{
			$imgProducto = 'producto.png';
		}
	}

		$query_user = mysqli_query($conexion,"UPDATE producto SET descripcion='".$descripcion."', precio='".$precio."', existencia='".$existencia."', foto = '".$imgUsuario."' WHERE codproducto='".$id."'");

		if ($query_user > 0) 
		{

			// if ([$nombre_foto != '' && ($_POST['foto_actual'] != 'user.png')] || ($_POST['foto_actual'] != $_POST['foto_remove'])) 
			// {
			// 	unlink('../sistema/img/uploads/'.$_POST['foto_actual']);
			// }
			if ($nombre_foto != '' || ($_POST['foto_actual'] == $_POST['foto_remove']) ) 
			{
				move_uploaded_file($url_temp, $src);
			}
		}

	header('location: ../paginas/producto_actualizar_exito.php');
?>