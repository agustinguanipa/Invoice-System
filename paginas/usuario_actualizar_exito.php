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
			    <b>Actualizar Usuario</b>
			  </div>
		   	<div class="card-body">
  				<h2><b>¡El Usuario ha sido Actualizado Exitosamente!</b></h2>
				</div>
				<div class="card-footer">
           <a href="usuario_lista.php" class="btn btn-info float-right">Ir al Listado <i class="fa fa-arrow-right"></i></a> 
				</div>
    </div> 
  </div>
</div>

<?php require_once('includes/admin_footer.php');  ?>

