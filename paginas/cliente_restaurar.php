<?php
  session_start();

  if (!isset($_SESSION['active'])) {
    header('Location: ../index.php');
    exit();
  }
?>

<?php 
	require_once('includes/admin_header.php');


  include 'conexion.php';

$id = $_GET['id'];
	$query_user = mysqli_query($conexion,"SELECT * FROM cliente WHERE idcliente = '$id' AND estatus = 0 ");
	
$result_user = mysqli_num_rows($query_user);

$data = mysqli_fetch_array($query_user);

$cedula = $data['cedula'];
$nombre = $data['nombre'];
$telefono = $data['telefono'];
$direccion = $data['direccion'];

?>

<div class="container col-lg-8">
  <div class="form-group text-center">
    <div class="card">
    	<div class="card-header">
			    <b>Restaurar Cliente</b>
			  </div>
		   	<div class="card-body">
  				<form role="form" id="cliente_restaurar" class="justify-content-center mx-3 my-1" align="center" enctype="" action="cliente_proceso_restaurar.php" method="post">
  					<input type="hidden" name="id" id="id" value="<?php echo $id ?>">
						<h2><b>¿Esta seguro que desea restaurar el siguiente registro?</b></h2>
					  <div class="form-row">
					  	<div class="col form-group">
					      <label class="form-label" for="cedula"><b>Cédula: </b></label>
					      <label><?php echo $cedula; ?></label>
					    </div>
					    <div class="col form-group">
					      <label class="form-label" for="nombre"><b>Nombre: </b></label>
					      <label><?php echo $nombre; ?></label>
					    </div>
					  </div>
		        <div class="form-row">
		          <div class="col form-group">
		            <button type="submit" id="" class="btn btn-success btn-block"><i class="fa fa-check"></i> Restaurar Usuario</button>
		          </div>
		        </div>
		      </form>
				</div>
				<div class="card-footer">
           <a href="cliente_lista_inactivo.php" class="btn btn-info float-left"><i class="fa fa-arrow-left"></i> Volver al Listado</a> 
				</div>
    </div> 
  </div>
</div>

<?php require_once('includes/admin_footer.php');  ?>