<?php 

include "../paginas/conexion.php";

// Actualizar Noticia

	$id = $_POST['id'];
	$titul_not = $_POST['titul_not'];
	$desco_not = $_POST['desco_not'];
	$descr_not = $_POST['descr_not'];
	$imgNoticia = $_POST['foto_actual'];
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
		$imgNoticia = $img_nombre.'.jpg';
		$src = $destino.$imgNoticia;
	}else{
		if ($_POST['foto_actual'] != $_POST['foto_remove']) 
		{
			$imgNoticia = 'default.jpg';
		}
	}

		$query_noticia = mysqli_query($conexion,"UPDATE tab_not SET titul_not='".$titul_not."', desco_not='".$desco_not."', descr_not='".$descr_not."', image_not = '".$imgNoticia."' WHERE ident_not='".$id."'");

		if ($query_noticia > 0) 
		{
			if ($nombre_foto != '') 
			{
				move_uploaded_file($url_temp, $src);
			}
		}
	

	header('location: ../paginas/noticia_actualizar_exito.php');
?>