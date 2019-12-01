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

<div class="container-fluid">
	<div class="card" align="center">
    <div class="card-body panel-background">
      <h2 class="card-title text-white"><b>Venta de Repuestos Juancho</b></h2>
      <p class="card-text text-white"><b>Todo en Repuestos para tu Vehículo Chevrolet y Ford</b></p>
      <a href="#" class="btn btn-light btn-lg"> <b>Bienvenido <?php echo $_SESSION['nombre']; ?> </b><i class="fa fa-user ml-2"></i></a>
    </div>
  </div>
	<div class="card-deck">
	</div>
</div>
</br>
<div class="container-fluid" align="center">
	<div class="card-deck">
	  <div class="card">
	    <img class="card-img-top" src="../imagen/adminpanel1.jpg" alt="Admin Panel Ventas">
	    <div class="card-body">
	      <h5 class="card-title text-center"><b>Ventas</b></h5>
	      <p class="card-text text-center">Administrar Ventas y Facturas</p>
	    </div>
	    <div class="card-footer" align="center">
      	<a href="venta_lista.php" class="btn btn-sm btn-primary">Ir a Ventas</a>
    	</div>
	  </div>
	  <div class="card">
	    <img class="card-img-top" src="../imagen/adminpanel2.jpg" alt="Admin Panel Productos">
	    <div class="card-body">
	      <h5 class="card-title text-center"><b>Productos</b></h5>
	      <p class="card-text text-center">Administrar Productos</p>
	    </div>
	    <div class="card-footer" align="center">
      	<a href="producto_lista.php" class="btn btn-sm btn-primary">Ir a Productos</a>
    	</div>
	  </div>
	  <div class="card">
	    <img class="card-img-top" src="../imagen/adminpanel3.jpg" alt="Admin Panel Clientes">
	    <div class="card-body">
	      <h5 class="card-title text-center"><b>Clientes</b></h5>
	      <p class="card-text text-center">Administrar Clientes</p>
	    </div>
	    <div class="card-footer" align="center">
      	<a href="cliente_lista.php" class="btn btn-primary btn-sm">Ir a Clientes</a>
    	</div>
	  </div>
	</div>
</div>

<?php require_once('includes/admin_footer.php');  ?>
