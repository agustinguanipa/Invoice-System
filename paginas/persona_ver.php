<?php 
  require_once('includes/admin_header.php');

  if (!isset($_SESSION['active'])) {
    header('Location: usuario_inicio.php');
    exit();
  }
?>

<?php 

include 'conexion.php' ;

if (empty($_GET['id'])) {
	header('location: persona_lista.php');
}

$id = $_GET['id'];

	$query_per = mysqli_query($conexion,"SELECT u.ident_per,u.cedul_per,u.nombr_per, u.apeli_per, u.fecna_per, u.telem_per, u.telec_per, u.email_per, u.direc_per, u.tifam_per, u.tibom_per, u.seria_per, u.usuar_per, r.ident_tip, r.nombr_tip FROM tab_per u INNER JOIN tab_tip r ON u.ident_tip = r.ident_tip WHERE ident_per = '$id' AND statu_per = 1");
	
$result_per = mysqli_num_rows($query_per);

if ($result_per == 0) 
{
	header('location: persona_lista.php');
}else{
	$data_per = mysqli_fetch_array($query_per);
	
	$cedul_per = $data_per['cedul_per'];
	$nombr_per = $data_per['nombr_per'];
	$apeli_per = $data_per['apeli_per'];
	$fecna_per = $data_per['fecna_per'];
	$telem_per = $data_per['telem_per'];
	$telec_per = $data_per['telec_per'];
	$email_per = $data_per['email_per'];
	$direc_per = $data_per['direc_per'];
	$tifam_per = $data_per['tifam_per'];
	$tibom_per = $data_per['tibom_per'];
	$seria_per = $data_per['seria_per'];
	$usuar_per = $data_per['usuar_per'];
	$ident_tip = $data_per['ident_tip'];
	$nombr_tip = $data_per['nombr_tip'];
}
mysqli_close($conexion);
?>

<div class="container col-lg-10">
	<div class="card text-center">
	  <div class="card-header">
	    <b>Ver Persona</b>
	  </div>
		<div class="card-body" class="justify-content-center mx-3 my-1">
		  <div class="form-row">
		  	 <div class="col form-group">
		      <label class="form-label" for="cedul_per"><b>Cédula: </b></label>
		      <label><?php echo $cedul_per; ?></label>
		    </div>
		    <div class="col form-group">
		      <label class="form-label" for="nombr_per"><b>Nombre: </b></label>
		      <label><?php echo $nombr_per; ?></label>
		    </div>
		    <div class="col form-group">
		      <label class="form-label" for="apeli_per"><b>Apellido: </b></label>
		      <label><?php echo $apeli_per; ?></label>
		    </div>
		    <div class="col form-group">
		      <label class="form-label" for="fecna_per"><b>Fecha de Nac.: </b></label>
		      <label><?php echo $fecna_per; ?></label>
		    </div>
		  </div>
		  <hr>
		  <div class="form-row">
		    <div class="col form-group">
		      <label class="form-label" for="telem_per"><b>Teléfono Celular: </b></label>
		      <label><?php echo $telem_per; ?></label>
		    </div>
		    <div class="col form-group">
		      <label class="form-label" for="telec_per"><b>Teléfono de Casa: </b></label>
		      <label><?php echo $telec_per; ?></label>
		    </div>
		    <div class="col form-group">
		      <label class="form-label" for="email_per"><b>E-Mail: </b></label>
		      <label><?php echo $email_per; ?></label>
		    </div>
		  </div>
		  <hr>
		  <div class="form-row">
		    <div class="col form-group">
		      <label class="form-label" for="usuar_per"><b>Dirección: </b></label>
		      <label><?php echo $direc_per; ?></label>
		    </div>
		  </div>
		  <hr>
		  <div class="form-row">
		  	<div class="col form-group">
		      <label class="form-label" for="tifam_per"><b>Tipo de Familiar: </b></label>
		      <label><?php echo $tifam_per; ?></label>
		    </div>
		    <div class="col form-group">
		      <label class="form-label" for="tibom_per"><b>Tipo de Bombona: </b></label>
		      <label><?php echo $tibom_per; ?></label>
		    </div>
		    <div class="col form-group">
		      <label class="form-label" for="seria_per"><b>Serial del Carnet de la Patria: </b></label>
		      <label><?php echo $seria_per; ?></label>
		    </div>
		  </div>
		  <hr>
			<div class="form-row">
				<div class="col form-group">
		      <label class="form-label" for="usuar_per"><b>Usuario: </b></label>
		      <label><?php echo $usuar_per; ?></label>
		    </div>
				<div class="col form-group">
		      <label class="form-label" for="ident_tip"><b>Tipo de Usuario: </b></label>
		      <?php
		      	include "conexion.php";
						$query_rol = mysqli_query($conexion,"SELECT t.nombr_tip, p.ident_per, t.ident_tip FROM  tab_per p INNER JOIN tab_tip t ON t.ident_tip = p.ident_tip WHERE p.ident_per = $id");
						$result_rol = mysqli_num_rows($query_rol);
					?>
					<?php 
						if ($result_rol > 0) {
						while ($rol = mysqli_fetch_array($query_rol)) {?>
		      	<label><?php echo $rol['nombr_tip'];?></label>
		      	<?php
						}
						}
						?>
		    </div>
			</div>
		</div>
		<div class="card-footer">
           <a href="persona_lista.php" class="btn btn-info float-left"><i class="fa fa-arrow-left"></i> Volver al Listado</a> 
				</div>
	</div>
</div>

<?php require_once('includes/admin_footer.php');  ?>