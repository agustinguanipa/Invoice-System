<?php 
	require_once('includes/admin_header.php');

	if ($_SESSION['rol'] != 1) 
	{
		header('location: ./');
	}
?>

<?php 

if ($_SESSION['rol'] != 1) 
{
	header('location: ./');
}
include '../conexion.php' ;

if (empty($_GET['id'])) {
	header('location: existencia_lista.php');
}

$id = $_GET['id'];

	$query_user = mysqli_query($conexion,"SELECT codproducto,descripcion,precio,existencia,foto FROM producto WHERE codproducto = '$id' AND estatus = 1");
	
$result_user = mysqli_num_rows($query_user);

$foto = '';
$classRemove = 'notBlock';

if ($result_user == 0) 
{
	header('location: producto_lista.php');
}else{
	$data_user = mysqli_fetch_array($query_user);
	if ($data_user['foto'] != 'producto.png') 
	{
		$foto = '../imagen/uploads/'.$data_user['foto'];
	}else{
		$foto = '../imagen/'.$data_user['foto'];
	}
	
	$descripcion = $data_user['descripcion'];
	$precio = $data_user['precio'];
	$existencia = $data_user['existencia'];
	
}
mysqli_close($conexion);
?>

<div class="container col-lg-6">
	<div class="card text-center">
	  <div class="card-header">
	    <b>Ver Producto</b>
	  </div>
		<div class="card-body" class="justify-content-center mx-3 my-1">
		  <div class="form-row">
		  	<div class="logoUser">
					<img src="<?php echo $foto; ?>" alt="Foto Producto">
				</div>
		  </div>
		  <div class="form-row">
		    <div class="col form-group">
		      <label class="form-label" for="descripcion"><b>Descripcion: </b></label>
		      <label><?php echo $descripcion; ?></label>
		    </div>
		  </div>
		  <div class="form-row">
		    <div class="col form-group">
		      <label class="form-label" for="precio"><b>Precio: </b></label>
		      <label><?php echo $precio; ?></label>
		    </div>
		  </div>
		  <div class="form-row">
		    <div class="col form-group">
		      <label class="form-label" for="existencia"><b>Existencia: </b></label>
		      <label><?php echo $existencia; ?></label>
		    </div>
		  </div>
		</div>
		<div class="card-footer">
           <a href="producto_lista.php" class="btn btn-primary float-left"><i class="fa fa-arrow-left"></i> Volver al Listado</a> 
				</div>
	</div>
</div>

<?php require_once('includes/admin_footer.php');  ?>