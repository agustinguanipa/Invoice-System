<?php 
	include ('conexion.php');
	$ident_per = $_POST['id'];
			$delete_persona = mysqli_query($conexion,"UPDATE tab_per SET statu_per = 0 WHERE ident_per = '$ident_per'");
			if ($delete_persona) {
				
					$persona = mysqli_query($conexion,"SELECT * FROM tab_per WHERE ident_per = '$ident_per'");

				header('location: persona_lista.php');
				exit;
			}else{
				echo 'error';
			}
		exit;

 ?>