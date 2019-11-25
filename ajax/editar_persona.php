<?php 

include "../paginas/conexion.php";

// Actualizar Persona

	$id = $_POST['id'];
	$nombr_per = $_POST['nombr_per'];
	$apeli_per = $_POST['apeli_per'];
	$fecna_per = $_POST['fecna_per'];
	$telem_per = $_POST['telem_per'];
	$telec_per = $_POST['telec_per'];
	$email_per = $_POST['email_per'];
	$direc_per = $_POST['direc_per'];
	$tifam_per = $_POST['tifam_per'];
	$tibom_per = $_POST['tibom_per'];
	$seria_per = $_POST['seria_per'];
	$ident_tip = $_POST['ident_tip'];

	$query_user = mysqli_query($conexion,"UPDATE tab_per SET nombr_per='".$nombr_per."', apeli_per='".$apeli_per."',fecna_per='".$fecna_per."', telem_per='".$telem_per."', telec_per='".$telec_per."', email_per='".$email_per."', tifam_per='".$tifam_per."', tibom_per='".$tibom_per."', seria_per='".$seria_per."', ident_tip='".$ident_tip."' WHERE ident_per='".$id."'");

	header('location: ../paginas/persona_actualizar_exito.php');
?>