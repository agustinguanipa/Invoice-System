<?php 
	include ('conexion.php');
	$ident_not = $_POST['id'];
			$delete_noticia = mysqli_query($conexion,"UPDATE tab_not SET statu_not = 0 WHERE ident_not = '$ident_not'");
			if ($delete_noticia) {
				
					$noticia = mysqli_query($conexion,"SELECT * FROM tab_not WHERE ident_not = '$ident_not'");

				header('location: noticia_lista.php');
				exit;
			}else{
				echo 'error';
			}
		exit;

 ?>