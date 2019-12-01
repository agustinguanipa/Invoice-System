<?php 
	require_once('includes/admin_header.php');

	if (!isset($_SESSION['active'])) {
    header('Location: ../index.php');
    exit();
  }

  include 'conexion.php' ;

$id = $_GET['id'];

	$query_user = mysqli_query($conexion,"SELECT u.idusuario, u.nombre, u.correo, u.usuario, r.rol, r.idrol FROM usuario u INNER JOIN rol r ON u.rol = r.idrol WHERE idusuario = '$id' AND estatus = 1");
	
$result_user = mysqli_num_rows($query_user);

$data = mysqli_fetch_array($query_user);

$nombre = $data['nombre'];
$correo = $data['correo'];
$usuario = $data['usuario'];
$idrol = $data['idrol'];
$rol = $data['rol'];

?>

<div class="container col-lg-8">
  <div class="form-group text-center">
    <div class="card">
    	<div class="card-header">
			    <b>Eliminar Usuario</b>
			  </div>
		   	<div class="card-body">
  				<form role="form" id="usuario_borrar" class="justify-content-center mx-3 my-1" align="center" enctype="" action="usuario_proceso_eliminar.php" method="post">
  					<input type="hidden" name="id" id="id" value="<?php echo $id ?>">
						<h2><b>¿Esta seguro que desea eliminar el siguiente registro?</b></h2>
					  <div class="form-row">
					    <div class="col form-group">
					      <label class="form-label" for="nombre"><b>Nombre: </b></label>
					      <label><?php echo $nombre; ?></label>
					    </div>
					    <div class="col form-group">
					      <label class="form-label" for="usuario"><b>Usuario: </b></label>
					      <label><?php echo $usuario; ?></label>
					    </div>
					  </div>
		        <div class="form-row">
		          <div class="col form-group">
		            <button type="submit" id="" class="btn btn-danger btn-block"><i class="fa fa-trash"></i> Eliminar Usuario</button>
		          </div>
		        </div>
		      </form>
				</div>
				<div class="card-footer">
           <a href="usuario_lista.php" class="btn btn-info float-left"><i class="fa fa-arrow-left"></i> Volver al Listado</a> 
				</div>
    </div> 
  </div>
</div>

<?php require_once('includes/admin_footer.php');  ?>