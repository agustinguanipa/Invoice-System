<?php 

include "../paginas/conexion.php";

// Actualizar Producto

	$id = $_POST['id'];
	$descripcion = $_POST['descripcion'];
	$precio = $_POST['precio'];
	$existencia = $_POST['existencia'];

		$query_user = mysqli_query($conexion,"UPDATE producto SET descripcion='".$descripcion."', precio='".$precio."', existencia='".$existencia."' WHERE codproducto='".$id."'");

	header('location: ../paginas/producto_actualizar_exito.php');
?>