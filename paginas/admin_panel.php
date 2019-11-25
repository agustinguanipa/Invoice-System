<?php
  session_start();

  if (!isset($_SESSION['active'])) {
    header('Location: usuario_inicio.php');
    exit();
  }
?>

<?php 
	require_once('includes/admin_header.php');
?>

<div class="container-fluid">
	<div class="card-deck">
		<div class="card text-center">
		  <div class="card-header">
		    <b>Bienvenido al Panel de Control</b>
		  </div>
		  <div class="card-body">
		    <h5 class="card-title">Consejo Comunal Ambrosio Plaza</h5>
		    <a href="../index.php" class="btn btn-primary">Ir a la Web</a>
		  </div>
		</div>
	</div>
</div>
</br>
<div class="container-fluid" align="center">
	<div class="card-deck">
		<div class="card mb-3">
		  <img src="../imagen/panel-1.jpg" class="card-img-top" alt="Panel Noticias">
		  <div class="card-body">
		    <h5 class="card-title"><b>Noticias</b></h5>
		    <p class="card-text">Agrega y Visualiza todas las Noticias Publicadas.</p>
		  </div>
		  <div class="card-footer">
		  	<a href="noticia_lista.php" class="btn btn-primary">Ver Noticias</a>
		  </div>
		</div>
	  <div class="card mb-3">
		  <img src="../imagen/panel-3.jpg" class="card-img-top" alt="Panel Personas">
		  <div class="card-body">
		    <h5 class="card-title"><b>Personas</b></h5>
		    <p class="card-text">Listado de Personas que integran la Comunidad.</p>
		  </div>
		  <div class="card-footer">
		  	<a href="persona_lista.php" class="btn btn-primary">Ver Personas</a>
		  </div>
		</div>
		<div class="card mb-3">
		  <img src="../imagen/panel-2.jpg" class="card-img-top" alt="Panel Personas">
		  <div class="card-body">
		    <h5 class="card-title"><b>Usuarios</b></h5>
		    <p class="card-text">Usuarios Registrados para Administrar el Sistema</p>
		  </div>
		  <div class="card-footer">
		  	<a href="#" class="btn btn-primary">Ver Usuarios</a>
		  </div>
		</div>
	  
	</div>
</div>

<?php require_once('includes/admin_footer.php');  ?>
