<?php 

	include "../paginas/conexion.php";

	$titul_not = $_POST['titul_not'];
	$desco_not = $_POST['desco_not'];
	$descr_not = $_POST['descr_not'];
	$statu_not = 1;
	
	$foto = $_FILES['foto'];

	$nombre_foto = $foto['name'];
	$type = $foto['type'];
	$url_temp = $foto['tmp_name'];

	$imgNoticia = 'default.png';

	if ($nombre_foto != '')
	{
		$destino = '../imagen/uploads/';
		$img_nombre = 'img_'.md5(date('d-m-Y H:m:s'));
		$imgNoticia = $img_nombre.'.jpg';
		$src = $destino.$imgNoticia;
	}

		$query_insert = mysqli_query($conexion,"INSERT INTO tab_not(titul_not,desco_not,descr_not,image_not,statu_not) VALUES('$titul_not','$desco_not','$descr_not','$imgNoticia','$statu_not')");

		if ($query_insert) {
			if ($nombre_foto != '') 
			{
				move_uploaded_file($url_temp, $src);
			}
		 }
		 
	header('location: ../paginas/noticia_registro_exito.php');
?>