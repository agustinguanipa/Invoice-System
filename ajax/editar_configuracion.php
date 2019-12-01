<?php 
	include "../paginas/conexion.php";;

	$registro = $_POST['txtEmpRegistro'];
  $nombre = $_POST['txtEmpNombre'];
  $razon_social = $_POST['txtRSocial'];
  $telefono = $_POST['txtEmpTelefono'];
  $email = $_POST['txtEmpEmail'];
  $direccion = $_POST['txtEmpDireccion'];
  $iva = $_POST['txtEmpIva'];

	$queryUpd = mysqli_query($conexion,"UPDATE configuracion SET rif = '$registro', nombre = '$nombre', razon_social = '$razon_social', telefono = '$telefono', email = '$email', direccion = '$direccion', iva = '$iva' WHERE codigo = 1");

	header('location: ../paginas/configuracion_actualizar_exito.php');

 ?>