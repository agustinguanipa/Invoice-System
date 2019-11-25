<?php 
	include ('conexion.php');
	$ident_per = $_POST['id'];
			$restaurar_persona = mysqli_query($conexion,"UPDATE tab_per SET statu_per = 1 WHERE ident_per = '$ident_per'");
			if ($restaurar_persona) {
				
					$persona = mysqli_query($conexion,"SELECT * FROM tab_per WHERE ident_per = '$ident_per'");

				header('location: persona_lista_inactivo.php');
				exit;
			}else{
				echo 'error';
			}
		exit;

 ?>