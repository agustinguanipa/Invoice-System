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
	<div class="table-wrapper">
	    <div class="table-title">
	        <div class="row">
            <div class="col-sm-6">
							<h2>Administrar <b>Ventas</b></h2>
						</div>
						<div class="col-sm-6">
							
						</div>
	        </div>
	    </div>
	    <div class="row" style="padding-top: 2px;">
	    	<div class="col-sm-8">
					<a href="venta_nueva.php" class="btn btn-info float-left"><i class="fa fa-plus"></i> Nueva Venta</a>
				</div>
				<form action="venta_buscar.php" method="GET" class="col-sm-4" style="padding-top: 1px;">
					<div class="input-group">			
						<input type="text" class="form-control" name="busqueda" id="busqueda" placeholder="Buscar">
						<div class="input-group-append">
							<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
						</div>
					</div>
				</form>
	    </div>
	    <hr>
	    <div>
	    	<div class="table-responsive">
					<table class="table table-striped table-hover">
						<tr>
							<th class='text-center'>#</th>
							<th class='text-center'>Fecha</th>
							<th class='text-center'>Cliente</th>
							<th class='text-center'>Vendedor</th>
							<th class='text-center'>Estado</th>
							<th class='text-center'>Total</th>
							<th class='text-center'>Ver</th>
							<th class='text-center'>Anular</th>
						</tr>
						<?php 
							
						//Paginador 

							$sql_registro = mysqli_query($conexion,"SELECT COUNT(*) as total_registro FROM factura WHERE estatus = 1");
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

						$query = mysqli_query($conexion,"SELECT f.nofactura, f.fecha, f.totalfactura, f.codcliente, f.estatus,
										u.nombre as vendedor,
										cl.nombre as cliente
										FROM factura f
										INNER JOIN usuario u
										ON f.usuario = u.idusuario
										INNER JOIN cliente cl
										ON f.codcliente = cl.idcliente
										WHERE f.estatus != 10
										ORDER BY f.fecha DESC LIMIT $desde,$por_pagina");
							mysqli_close($conexion);
							$result = mysqli_num_rows($query);

							if ($result > 0) 
								{
								 	while ($data = mysqli_fetch_array($query)) 
								 	{
								 		if ($data['estatus'] == 1) 
								 		{
								 			$estado = '<span class="pagada">Pagada</span>';
								 		}else{
								 			$estado = '<span class="anulada">Anulada</span>';
								 		}
								 	?>

							 		<tr class="row<?php echo $data['nofactura']; ?>">
										<td class="text-center"><?php echo $data['nofactura']; ?></td>
										<td class="text-center"><?php echo $data['fecha']; ?></td>
										<td class="text-center"><?php echo $data['cliente']; ?></td>
										<td class="text-center"><?php echo $data['vendedor']; ?></td>
											<td class="text-center estado"><?php echo $estado; ?></td>
										<td class="text-center totalfactura"><?php echo $data['totalfactura']; ?> Bs.</td>
										<td class='text-center'>
											<a href="venta_ver.php?id=<?php echo $data['nofactura']; ?>" class="btn_view view_factura look" cl="<?php echo $data['codcliente']; ?>" f="<?php echo $data['nofactura']; ?>"><i class="fa fa-eye"></i></a>
										</td>
										<td class='text-center'>
											<?php  
											if ($data['rol'] != 'ADMINISTRADOR' && ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2)) {
											?>
												<a href="factura_anular.php?id=<?php echo $data['nofactura']; ?>" class="delete"><i class="fa fa-ban"></i></a>
											<?php	
												}
											?>
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

                               		                            