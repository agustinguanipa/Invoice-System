<?php

	session_start(); 

	include "../paginas/conexion.php";

	$descripcion = $_POST['descripcion'];
	$precio = $_POST['precio'];
	$existencia = $_POST['existencia'];
	$estatus = 1;
	$usuario_id = $_SESSION['idUser'];

	$foto = $_FILES['foto'];

	$nombre_foto = $foto['name'];
	$type = $foto['type'];
	$url_temp = $foto['tmp_name'];

	$imgProducto = 'user.png';

	if ($nombre_foto != '')
	{
		$destino = '../imagen/uploads/';
		$img_nombre = 'img_'.md5(date('d-m-Y H:m:s'));
		$imgProducto = $img_nombre.'.jpg';
		$src = $destino.$imgProducto;
	}

	$query_insert = mysqli_query($conexion,"INSERT INTO producto(descripcion,precio,existencia,usuario_id,foto) VALUES('$descripcion','$precio','$existencia','$usuario_id','$imgProducto')");

	if ($query_insert) {
			if ($nombre_foto != '') 
			{
				move_uploaded_file($url_temp, $src);
			}
		 }
	

	header('location: ../paginas/producto_registro_exito.php');
?>