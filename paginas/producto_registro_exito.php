<?php
  session_start();

  if (!isset($_SESSION['active'])) {
    header('Location: ../index.php');
    exit();
  }
?>

<?php 
  require_once('includes/admin_header.php');
?>

<div class="container col-lg-6">
  <div class="form-group text-center">
    <div class="card">
    	<div class="card-header">
			    <b>Registrar Producto</b>
			  </div>
		   	<div class="card-body">
  				<h2><b>¡El Producto ha sido Registrado Exitosamente!</b></h2>
				</div>
				<div class="card-footer">
           <a href="producto_registro.php" class="btn btn-info float-left"><i class="fa fa-plus"></i> Registrar otro Producto</a> 
           <a href="producto_lista.php" class="btn btn-primary float-right"><i class="fa fa-arrow-right"></i> Ir al Listado</a> 
				</div>
    </div> 
  </div>
</div>

<?php require_once('includes/admin_footer.php');  ?>

