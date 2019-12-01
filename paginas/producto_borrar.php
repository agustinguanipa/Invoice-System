<?php 
	require_once('includes/admin_header.php');

	if (!isset($_SESSION['active'])) {
    header('Location: ../index.php');
    exit();
  }

  include 'conexion.php' ;

$id = $_GET['id'];

$query_user = mysqli_query($conexion,"SELECT * FROM producto WHERE codproducto = '$id' AND estatus = 1 ");
	
$result_user = mysqli_num_rows($query_user);

$data_user = mysqli_fetch_array($query_user);

$descripcion = $data_user['descripcion'];
$precio = $data_user['precio'];
$existencia = $data_user['existencia'];

?>

<div class="container col-lg-8">
  <div class="form-group text-center">
    <div class="card">
    	<div class="card-header">
			    <b>Eliminar Producto</b>
			  </div>
		   	<div class="card-body">
  				<form role="form" id="usuario_borrar" class="justify-content-center mx-3 my-1" align="center" enctype="" action="producto_proceso_eliminar.php" method="post">
  					<input type="hidden" name="id" id="id" value="<?php echo $id ?>">
						<h2><b>¿Esta seguro que desea eliminar el siguiente registro?</b></h2>
					  <div class="form-row">
					    <div class="col form-group">
					      <label class="form-label" for="descripcion"><b>Nombre: </b></label>
					      <label><?php echo $descripcion; ?></label>
					    </div>
					    <div class="col form-group">
					      <label class="form-label" for="precio"><b>Precio: </b></label>
					      <label><?php echo $precio; ?></label>
					    </div>
					  </div>
		        <div class="form-row">
		          <div class="col form-group">
		            <button type="submit" id="" class="btn btn-danger btn-block"><i class="fa fa-trash"></i> Eliminar Producto</button>
		          </div>
		        </div>
		      </form>
				</div>
				<div class="card-footer">
           <a href="producto_lista.php" class="btn btn-info float-left"><i class="fa fa-arrow-left"></i> Volver al Listado</a> 
				</div>
    </div> 
  </div>
</div>

<?php require_once('includes/admin_footer.php');  ?>