<?php
  session_start();

  if (!isset($_SESSION['active'])) {
    header('Location: ../index.php');
    exit();
  }
?>

<?php 
	require_once('includes/admin_header.php');

  include 'conexion.php' ;

$id = $_GET['id'];

$query_user = mysqli_query($conexion,"SELECT * FROM factura WHERE nofactura = '$id' AND estatus = 1 ");
	
$result_user = mysqli_num_rows($query_user);

$data_user = mysqli_fetch_array($query_user);

$codcliente = $data_user['codcliente'];
$fecha = $data_user['fecha'];
$totalfactura = $data_user['totalfactura'];
$existencia = $data_user['existencia'];

?>

<div class="container col-lg-8">
  <div class="form-group text-center">
    <div class="card">
    	<div class="card-header">
			    <b>Anular Factura</b>
			  </div>
		   	<div class="card-body">
  				<form role="form" id="factura_anular" class="justify-content-center mx-3 my-1" align="center" enctype="" action="factura_proceso_anular.php" method="post">
  					<input type="hidden" name="id" id="id" value="<?php echo $id ?>">
						<h2><b>¿Esta seguro que desea eliminar el siguiente registro?</b></h2>
					  <div class="form-row">
					  	<div class="col form-group">
					      <label class="form-label" for="codcliente"><b>Nº: </b></label>
					      <label><?php echo $id; ?></label>
					    </div>
					    <div class="col form-group">
					      <label class="form-label" for="codcliente"><b>Código del Cliente: </b></label>
					      <label><?php echo $codcliente; ?></label>
					    </div>
					    <div class="col form-group">
					      <label class="form-label" for="fecha"><b>Fecha: </b></label>
					      <label><?php echo $fecha; ?></label>
					    </div>
					    <div class="col form-group">
					      <label class="form-label" for="totalfactura"><b>Total Factura: </b></label>
					      <label><?php echo $totalfactura; ?></label>
					    </div>
					  </div>
		        <div class="form-row">
		          <div class="col form-group">
		            <button type="submit" id="" class="btn btn-danger btn-block"><i class="fa fa-ban"></i> Anular Factura</button>
		          </div>
		        </div>
		      </form>
				</div>
				<div class="card-footer">
           <a href="venta_lista.php" class="btn btn-info float-left"><i class="fa fa-arrow-left"></i> Volver al Listado</a> 
				</div>
    </div> 
  </div>
</div>

<?php require_once('includes/admin_footer.php');  ?>