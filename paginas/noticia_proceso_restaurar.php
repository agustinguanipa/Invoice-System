<?php 
	include ('conexion.php');
	$ident_not = $_POST['id'];
			$restaurar_noticia = mysqli_query($conexion,"UPDATE tab_not SET statu_not = 1 WHERE ident_not = '$ident_not'");
			if ($restaurar_noticia) {
				
					$noticia = mysqli_query($conexion,"SELECT * FROM tab_not WHERE ident_not = '$ident_not'");

				header('location: noticia_lista_inactivo.php');
				exit;
			}else{
				echo 'error';
			}
		exit;

 ?>