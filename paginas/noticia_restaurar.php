<?php 
	require_once('includes/admin_header.php');

	if (!isset($_SESSION['active'])) {
    header('Location: usuario_inicio.php');
    exit();
  }

  include 'conexion.php';

$id = $_GET['id'];

	$query_not = mysqli_query($conexion,"SELECT * FROM tab_not WHERE ident_not = '$id' AND statu_not = 0");
	
$result_not = mysqli_num_rows($query_not);

$data = mysqli_fetch_array($query_not);

	$titul_not = $data['titul_not'];
	$desco_not = $data['desco_not'];
	$descr_not = $data['descr_not'];
	$fecpu_not = $data['fecpu_not'];

?>

<div class="container col-lg-8">
  <div class="form-group text-center">
    <div class="card">
    	<div class="card-header">
			    <b>Restaurar Noticia</b>
			  </div>
		   	<div class="card-body">
  				<form role="form" id="" class="justify-content-center mx-3 my-1" align="center" enctype="" action="noticia_proceso_restaurar.php" method="post">
  					<input type="hidden" name="id" id="id" value="<?php echo $id ?>">
						<h2><b>¿Esta seguro que desea restaurar el siguiente registro?</b></h2>
					  <div class="form-row">
					  	<div class="col form-group">
					      <label class="form-label" for="titul_not"><b>Título: </b></label>
					      <label><?php echo $titul_not; ?></label>
					    </div>
					    <div class="col form-group">
					      <label class="form-label" for="fecpu_not"><b>Fecha de Publicación: </b></label>
					      <label><?php echo $fecpu_not; ?></label>
					    </div>
					  </div>
		        <div class="form-row">
		          <div class="col form-group">
		            <button type="submit" id="" class="btn btn-success btn-block"><i class="fa fa-check"></i> Restaurar Noticia</button>
		          </div>
		        </div>
		      </form>
				</div>
				<div class="card-footer">
           <a href="noticia_lista_inactivo.php" class="btn btn-info float-left"><i class="fa fa-arrow-left"></i> Volver al Listado</a> 
				</div>
    </div> 
  </div>
</div>

<?php require_once('includes/admin_footer.php');  ?>