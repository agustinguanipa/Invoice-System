<?php 
	require_once('includes/admin_header.php');

	if (!isset($_SESSION['active'])) {
    header('Location: usuario_inicio.php');
    exit();
  }

  include 'conexion.php';

$id = $_GET['id'];

	$query_user = mysqli_query($conexion,"SELECT u.ident_per, u.cedul_per, u.nombr_per, u.apeli_per, r.ident_tip, r.nombr_tip FROM tab_per u INNER JOIN tab_tip r ON u.ident_tip = r.ident_tip WHERE ident_per = '$id' AND statu_per = 0");
	
$result_user = mysqli_num_rows($query_user);

$data = mysqli_fetch_array($query_user);

	$cedul_per = $data['cedul_per'];
	$nombr_per = $data['nombr_per'];
	$apeli_per = $data['apeli_per'];

?>

<div class="container col-lg-8">
  <div class="form-group text-center">
    <div class="card">
    	<div class="card-header">
			    <b>Restaurar Persona</b>
			  </div>
		   	<div class="card-body">
  				<form role="form" id="usuario_editar" class="justify-content-center mx-3 my-1" align="center" enctype="" action="persona_proceso_restaurar.php" method="post">
  					<input type="hidden" name="id" id="id" value="<?php echo $id ?>">
						<h2><b>¿Esta seguro que desea restaurar el siguiente registro?</b></h2>
					  <div class="form-row">
					  	<div class="col form-group">
					      <label class="form-label" for="cedul_per"><b>Cédula de Identidad: </b></label>
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
					  </div>
		        <div class="form-row">
		          <div class="col form-group">
		            <button type="submit" id="" class="btn btn-success btn-block"><i class="fa fa-check"></i> Restaurar Persona</button>
		          </div>
		        </div>
		      </form>
				</div>
				<div class="card-footer">
           <a href="persona_lista.php" class="btn btn-info float-left"><i class="fa fa-arrow-left"></i> Volver al Listado</a> 
				</div>
    </div> 
  </div>
</div>

<?php require_once('includes/admin_footer.php');  ?>