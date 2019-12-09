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
			    <b>Actualizar Configuración</b>
			  </div>
		   	<div class="card-body">
  				<h2><b>¡La Configuración ha sido Actualizada Exitosamente!</b></h2>
				</div>
				<div class="card-footer">
           <a href="configuracion.php" class="btn btn-info float-left"><i class="fa fa-arrow-left"></i> Volver a Configuración </a> 
				</div>
    </div> 
  </div>
</div>

<?php require_once('includes/admin_footer.php');  ?>

