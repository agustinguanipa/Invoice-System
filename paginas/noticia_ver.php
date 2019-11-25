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
	header('location: noticia_lista.php');
}

$id = $_GET['id'];

	$query_not = mysqli_query($conexion,"SELECT * FROM tab_not WHERE ident_not = '$id' AND statu_not = 1");
	
$result_not = mysqli_num_rows($query_not);

if ($result_not == 0) 
{
	header('location: noticia_lista.php');
}else{
	$data_not = mysqli_fetch_array($query_not);
	
	$titul_not = $data_not['titul_not'];
	$desco_not = $data_not['desco_not'];
	$descr_not = $data_not['descr_not'];
	$fecpu_not = $data_not['fecpu_not'];
	
}
mysqli_close($conexion);
?>

<div class="container col-lg-10">
	<div class="card text-center">
	  <div class="card-header">
	    <b>Ver Noticia</b>
	  </div>
		<div class="card-body" class="justify-content-center mx-3 my-1">
		  <div class="form-row">
		  	 <div class="col form-group">
		      <label class="form-label" for="titul_not"><b>Título: </b></label>
		      <label><?php echo $titul_not; ?></label>
		    </div>
		  </div>
		  <div class="form-row">
		    <div class="col form-group">
		      <label class="form-label" for="desco_not"><b>Descripción Corta: </b></label>
		      <label><?php echo $desco_not; ?></label>
		    </div>
		  </div>
		  <div class="form-row">
		    <div class="col form-group">
		      <label class="form-label" for="descr_not"><b>Descripción Larga: </b></label>
		      <label><?php echo $descr_not; ?></label>
		    </div>
		  </div>
		  <div class="form-row">
		    <div class="col form-group">
		      <label class="form-label" for="fecpu_not"><b>Fecha de Pub.: </b></label>
		      <label><?php echo $fecpu_not; ?></label>
		    </div>
		  </div>
		</div>
		<div class="card-footer">
      <a href="noticia_lista.php" class="btn btn-info float-left"><i class="fa fa-arrow-left"></i> Volver al Listado</a> 
		</div>
	</div>
</div>

<?php require_once('includes/admin_footer.php');  ?>