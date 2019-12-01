<?php 
	require_once('includes/admin_header.php');

	if ($_SESSION['rol'] != 1) 
	{
		header('location: ./');
	}
?>

<?php 

if ($_SESSION['rol'] != 1) 
{
	header('location: ./');
}
include '../conexion.php' ;

if (empty($_GET['id'])) {
	header('location: usuario_lista.php');
}

$id = $_GET['id'];

	$query_user = mysqli_query($conexion,"SELECT u.ident_usua,u.nombre, u.correo, u.usuario, u.usuar_usua, u.fotou_usua, r.rol, r.nombr_tipu FROM tab_usuar u INNER JOIN tab_tipusu r ON u.rol = r.rol WHERE ident_usua = '$id' AND statu_usua = 1");
	
$result_user = mysqli_num_rows($query_user);

$foto = '';
$classRemove = 'notBlock';

if ($result_user == 0) 
{
	header('location: usuario_lista.php');
}else{
	$data_user = mysqli_fetch_array($query_user);
	if ($data_user['fotou_usua'] != 'user.png') 
	{
		$foto = 'img/uploads/'.$data_user['fotou_usua'];
	}else{
		$foto = 'img/'.$data_user['fotou_usua'];
	}
	
	$nombre = $data_user['nombre'];
	$correo = $data_user['correo'];
	$usuario = $data_user['usuario'];
	$usuar_usua = $data_user['usuar_usua'];
	$rol = $data_user['rol'];
	$nombr_tipu = $data_user['nombr_tipu'];
}
mysqli_close($conexion);
?>

<div class="container col-lg-6">
	<div class="card text-center">
	  <div class="card-header">
	    <b>Ver Usuario</b>
	  </div>
		<div class="card-body" class="justify-content-center mx-3 my-1">
		  <div class="form-row">
		  	<div class="logoUser">
					<img src="<?php echo $foto; ?>" alt="Foto Usuario">
				</div>
		  </div>
		  <div class="form-row">
		    <div class="col form-group">
		      <label class="form-label" for="nombre"><b>Nombre: </b></label>
		      <label><?php echo $nombre; ?></label>
		    </div>
		  </div>
		  <div class="form-row">
		    <div class="col form-group">
		      <label class="form-label" for="correo">correo: </label>
		      <label><?php echo $correo; ?></label>
		    </div>
		  </div>
		  <div class="form-row">
		    <div class="col form-group">
		      <label class="form-label" for="usuario">E-Mail: </label>
		      <label><?php echo $usuario; ?></label>
		    </div>
		  </div>
		  <div class="form-row">
		    <div class="col form-group">
		      <label class="form-label" for="usuar_usua">Usuario: </label>
		      <label><?php echo $usuar_usua; ?></label>
		    </div>
		  </div>
			<div class="form-row">
				<div class="col form-group">
		      <label class="form-label" for="rol"><b>Tipo de Usuario: </b></label>
		      <?php
          	include "../conexion.php";
						$query_rol = mysqli_query($conexion,"SELECT t.nombr_tipu, p.ident_usua, t.rol FROM  tab_usuar p  INNER JOIN tab_tipusu t ON t.rol = p.rol WHERE ident_usua = $id");
						$result_rol = mysqli_num_rows($query_rol);
					?>
					<?php 
						if ($result_rol > 0) {
						while ($rol = mysqli_fetch_array($query_rol)) {?>
		      	<label><?php echo $rol['nombr_tipu'];?></label>
		      	<?php
						}
						}
						?>
		    </div>
			</div>
		</div>
		<div class="card-footer">
           <a href="usuario_lista.php" class="btn btn-primary float-left"><i class="fa fa-arrow-left"></i> Volver al Listado</a> 
				</div>
	</div>
</div>

<?php require_once('includes/admin_footer.php');  ?>