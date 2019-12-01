<?php 
	require_once('includes/admin_header.php');

	if (!isset($_SESSION['active'])) {
    header('Location: ../index.php');
    exit();
  }
?>

<div class="container-fluid">
	<div class="table-wrapper">
	    <div class="table-title">
	        <div class="row">
            <div class="col-sm-6">
							<h2>Administrar <b>Productos Inactivos</b></h2>
						</div>
						<div class="col-sm-6">
							<a href="producto_lista.php" class="btn btn-light text-dark"><i class="fa fa-users"></i> Productos Activos</a>
							<a href="producto_lista_inactivo.php" class="btn btn-light text-dark"><i class="fa fa-trash"></i> Productos Inactivos</a>
						</div>
	        </div>
	    </div>
	    <div class="row" style="padding-top: 2px;">
	    	<div class="col-sm-8">
				
				</div>
				
	    </div>
	    <hr>
	    <div>
	    	<div class="table-responsive">
					<table class="table table-striped table-hover">
						<tr>
							<th class='text-center'>#</th>
							<th class='text-center'>Nombre</th>
							<th class='text-center'>Precio</th>
							<th class='text-center'>Existencia</th>
							<th class='text-center'>Restaurar</th>
						</tr>
						<?php 
							
						//Paginador 

							$sql_registe = mysqli_query($conexion,"SELECT COUNT(*) as total_registro FROM producto WHERE estatus = 0");
							$result_registe = mysqli_fetch_array($sql_registe);
							$total_registro = $result_registe['total_registro'];

							$por_pagina = 5;

							if (empty($_GET['pagina'])) 
							{
								$pagina = 1;
							}else{

								$pagina = $_GET['pagina'];
							}

							$desde = ($pagina-1) * $por_pagina;
							$total_paginas = ceil($total_registro / $por_pagina);

						$query = mysqli_query($conexion,"SELECT codproducto, descripcion, precio, existencia, foto FROM producto WHERE estatus = 0 ORDER BY codproducto DESC LIMIT $desde,$por_pagina");
							mysqli_close($conexion);
							$result = mysqli_num_rows($query);

							if ($result > 0) {
							 	while ($data = mysqli_fetch_array($query)) {

							 		?>

							 		<tr class="row<?php echo $data['codproducto']; ?>">
										<td class="text-center"><?php echo $data['codproducto']; ?></td>
										<td class="text-center"><?php echo $data['descripcion']; ?></td>
										<td class="text-center"><?php echo $data['precio']; ?></td>
										<td class="text-center"><?php echo $data['existencia']; ?></td>
										<td class='text-center'>
											<a href="producto_restaurar.php?id=<?php echo $data['codproducto']; ?>" class="restaurar"><i class="fa fa-check"></i></a>
										</td>
									</tr>

							 	<?php	
							 	}
							 } 
						?>
					</table>
				</div>
				<div class="paginador">
					<ul>
						<?php 
							if ($pagina != 1) 
							{
								?>
								<li><a href="?pagina=<?php echo 1; ?>"><i class="fas fa-step-backward"></i></a></li>
								<li><a href="?pagina=<?php echo $pagina-1; ?>"><i class="fas fa-backward"></i></a></li>
								<?php	
							}
						?>
						
						<?php 
							for ($i=1; $i <= $total_paginas; $i++) 
							{ 
								if ($i == $pagina) 
								{
									echo '<li class="pageSelected">'.$i.'</li>';
								}else{

									echo '<li><a href="?pagina='.$i.'">'.$i.'</a></li>';
								}
							}
						
							if ($pagina != $total_paginas) 
							{
								?>
								<li><a href="?pagina=<?php echo $pagina+1; ?>"><i class="fas fa-forward"></i></a></li>
								<li><a href="?pagina=<?php echo $total_paginas; ?>"><i class="fas fa-step-forward"></i></a></li>
								<?php
							}
						?>
			
					</ul>
				</div>
	    </div>
	</div>
</div>

<?php require_once('includes/admin_footer.php');  ?>

                               		                            