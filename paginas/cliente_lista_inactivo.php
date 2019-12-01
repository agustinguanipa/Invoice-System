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
							<h2>Administrar <b>Clientes Inactivos</b></h2>
						</div>
						<div class="col-sm-6">
							<a href="cliente_lista.php" class="btn btn-light text-dark"><i class="fa fa-users"></i> Clientes Activos</a>
							<a href="cliente_lista_inactivo.php" class="btn btn-light text-dark"><i class="fa fa-trash"></i> Clientes Inactivos</a>
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
							<th class='text-center'>Cédula</th>
							<th class='text-center'>Nombre</th>
							<th class='text-center'>Teléfono</th>
							<th class='text-center'>Dirección</th>
							<th class='text-center'>Restaurar</th>
						</tr>
						<?php 
							
						//Paginador 

							$sql_registe = mysqli_query($conexion,"SELECT COUNT(*) as total_registro FROM cliente WHERE estatus = 0");
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

						$query = mysqli_query($conexion,"SELECT * FROM cliente WHERE estatus = 0  ORDER BY idcliente ASC LIMIT $desde,$por_pagina");
							mysqli_close($conexion);
							$result = mysqli_num_rows($query);

							if ($result > 0) {
							 	while ($data = mysqli_fetch_array($query)) {

							 		?>

							 		<tr class="row<?php echo $data['idcliente']; ?>">
										<td class="text-center"><?php echo $data['idcliente']; ?></td>
										<td class="text-center"><?php echo $data['cedula']; ?></td>
										<td class="text-center"><?php echo $data['nombre']; ?></td>
										<td class="text-center"><?php echo $data['telefono']; ?></td>
										<td class="text-center"><?php echo $data['direccion']; ?></td>
										<td class='text-center'>
											<a href="cliente_restaurar.php?id=<?php echo $data['idcliente']; ?>" class="restaurar"><i class="fa fa-check"></i></a>
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

                               		                            