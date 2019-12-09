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
						<h3 class="float-right">Nueva <b>Venta</b></h3>
					</div>
        </div>
			</div>
			<div class="card-deck">
				<div class="datos_cliente form-group text-center col-sm-8">
					<div class="card h-100">
						<div class="card-header action_cliente">
							<b>Datos del Cliente</b>
							<a href="#" class="btn_new btn_new_cliente btn-sm btn-primary float-right"><i class="fa fa-plus"></i> Nuevo Cliente</a>
						</div>
						<div class="card-body">
							<form name="form_new_cliente_venta" id="form_new_cliente_venta" class="datos justify-content-center mx-3 my-1">
								<div class="form-row">
									<input type="hidden" name="action" value="addCliente">
									<input type="hidden" id="idcliente" name="idcliente" value="" required>
									<div class="col form-group">
				            <label class="form-label" for="cedula_cliente"><b>Cédula: </b></label>
				            <input type="text" class="form-control" name="cedula_cliente" autocomplete="off" id="cedula_cliente" value="<?php echo $cedula_cliente; ?>" onkeyup="this.value = this.value.toUpperCase();">
				          </div>
				          <div class="col form-group">
				            <label class="form-label" for="nom_cliente"><b>Nombre: </b></label>
				            <input type="text" class="form-control" name="nom_cliente" autocomplete="off" id="nom_cliente" value="<?php echo $nom_cliente; ?>" onkeyup="this.value = this.value.toUpperCase();" disabled required>
				          </div>
									<div class="col form-group">
				            <label class="form-label" for="tel_cliente"><b>Teléfono: </b></label>
				            <input type="text" class="form-control" name="tel_cliente" autocomplete="off" id="tel_cliente" value="<?php echo $tel_cliente; ?>" onkeyup="this.value = this.value.toUpperCase();" disabled required>
				          </div>
				          <div class="col form-group">
				            <label class="form-label" for="dir_cliente"><b>Dirección: </b></label>
				            <input type="text" class="form-control" name="dir_cliente" autocomplete="off" id="dir_cliente" value="<?php echo $dir_cliente; ?>" onkeyup="this.value = this.value.toUpperCase();" disabled required>
				          </div>
				        </div>
			          <div class="form-row">
			          	<div id="div_registro_cliente col form-group" class="wd100">
										<button type="submit" class="btn_save btn-sm btn-info float-center"><i class="fa fa-save"></i> Guardar</button>
									</div>
			          </div>
							</form>
						</div>
					</div>
				</div>
				<div class="datos_venta form-group text-center col-sm-4">
					<div class="card h-100">
						<div class="card-header action_cliente">
							<b>Datos de Venta</b>
						</div>
						<div class="card-body">
							<div class="datos form-row">
								<div class="wd50 col form-group">
									<div class="col form-group float-left">
							      <label class="form-label" for="cedul_per"><b>Vendedor: </b></label>
							      <label><?php echo $_SESSION['nombre']; ?></label>
							    </div>
								</div>
							</div>
						</div>
						<div class="card-footer">
							<div id="acciones_venta card-footer">
								<a href="#" class="btn_ok textcenter btn btn-danger" id="btn_anular_venta"><i class="fa fa-ban"></i> Anular</a>
								<a href="#" class="btn_cancel textcenter btn btn-info" id="btn_facturar_venta" style="display: none;"><i class="fa fa-spinner"></i> Procesar</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="container col-sm-12">
				<div class="card">
					<div class="card-header text-center">
						<b>Factura</b>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-striped table-hover">
								<thead>
									<tr>
										<td colspan="10" class="text-center card-footer">
											<b>Agregar</b>
										</td>
									</tr>
									<tr>
										<th class="text-center">Codigo</th>
										<th class="text-center">Descripcion</th>
										<th class="text-center">Existencia</th>
										<th class="text-center" width="10px">Cantidad</th>
										<th class="text-right">Precio</th>
										<th class="text-right">Precio Total</th>
										<th class="text-center">Accion</th>
									</tr>
									<tr>
										<td><input type="text" name="txt_cod_producto" id="txt_cod_producto" class="form-control"></td>
										<td id="txt_descripcion" class="text-center">-</td>
										<td id="txt_existencia" class="text-center">-</td>
										<td><input type="text" name="txt_cant_producto" id="txt_cant_producto" value="0" min="1" class="form-control" disabled></td>
										<td id="txt_precio" class="text-right">0.00</td>
										<td id="txt_precio_total" class="text-right">0.00</td>
										<td class="text-center"><a href="#" id="add_product_venta" class="link_add agregar"><i class="fa fa-plus"></i></a></td>
									</tr>
									<tr>
										<td colspan="10" class="text-center card-footer">
											<b>Detalle</b>
										</td>
									</tr>
									<tr>
										<th class="text-center">Codigo</th>
										<th colspan="2" class="text-center">Descripcion</th>
										<th class="text-center">Cantidad</th>
										<th class="text-right">Precio</th>
										<th class="text-right">Precio Total</th>
										<th class="text-center">Accion</th>
									</tr>
								</thead>
								<tbody id="detalle_venta">
									<!-- CONTENIDO AJAX -->
								</tbody>
								<tfoot id="detalleTotales">
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		$(document).ready(function(){
			var usuarioid = "<?php echo $_SESSION['idUser']; ?>";
			serchforDetalle(usuarioid);
		});
	</script>


<?php require_once('includes/admin_footer.php');  ?>