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

<?php 

if ($_SESSION['rol'] != 1) 
{
	header('location: ./');
}
include '../conexion.php' ;

if (empty($_GET['id'])) {
	header('location: cliente_lista.php');
}

$id = $_GET['id'];

	$query_user = mysqli_query($conexion,"SELECT * FROM cliente WHERE idcliente = '$id' AND estatus = 1 ");
	
$result_user = mysqli_num_rows($query_user);

$data_user = mysqli_fetch_array($query_user);

$cedula = $data_user['cedula'];
$nombre = $data_user['nombre'];
$telefono = $data_user['telefono'];
$direccion = $data_user['direccion'];

mysqli_close($conexion);
?>

<div class="container col-lg-6">
  <div class="form-group text-center">
    <div class="card">
    	<div class="card-header">
			    <b>Editar Cliente</b>
			  </div>
		   	<div class="card-body">
  				<form role="form" id="cliente_editar" class="justify-content-center mx-3 my-1" align="center" enctype="multipart/form-data" action="../ajax/editar_cliente.php" method="post">
  					<input type="hidden" name="id" id="id" value="<?php echo $id ?>">
		        <div class="form-row">
              <div class="col form-group">
                <label class="form-label" for="cedula"><b>Cédula de Identidad: </b></label>
                <input type="text" class="form-control" name="cedula" autocomplete="off" id="cedula" value="<?php echo $cedula; ?>" maxlength="10" onkeyup="this.value = this.value.toUpperCase();" disabled>
              </div>
		          <div class="col form-group">
		            <label class="form-label" for="nombre"><b>Nombre: </b></label>
		            <input type="text" class="form-control" name="nombre" autocomplete="off" id="nombre" value="<?php echo $nombre; ?>" maxlength="45" onkeyup="this.value = this.value.toUpperCase();">
		          </div>
		        </div>
            <div class="form-row">
              <div class="col form-group">
                <label class="form-label" for="telefono"><b>Teléfono: </b></label>
                <input type="text" class="form-control tele-mask" name="telefono" autocomplete="off" id="telefono" value="<?php echo $telefono; ?>" maxlength="15" onkeyup="this.value = this.value.toUpperCase();">
              </div>
              <div class="col form-group">
                <label class="form-label" for="direccion"><b>Dirección: </b></label>
                <input type="text" class="form-control" name="direccion" autocomplete="off" id="direccion" value="<?php echo $direccion; ?>" onkeyup="this.value = this.value.toUpperCase();">
              </div>
            </div>
		        <div class="form-row">
		          <div class="col form-group">
		            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-user"></i> Actualizar Cliente</button>
		            <button type="reset" class="btn btn-light btn-block"><i class="fa fa-undo"></i> Limpiar</button>
		          </div>
		        </div>
		      </form>
				</div>
				<div class="card-footer">
           <a href="cliente_lista.php" class="btn btn-info float-left"><i class="fa fa-arrow-left"></i> Volver al Listado</a> 
				</div>
    </div> 
  </div>
</div>

<script type="text/javascript">
  $( document ).ready( function () {
  $( "#cliente_editar" ).validate( {
    rules: {

      nombre: {
        required: true,
        lettersonly: true,
        minlength: 2
      },
      telefono: {
        required: true,
        number: false,
        minlength: 15
      },
       direccion: {
        required: true
      },
    },

    messages: {
      
      nombre: {
        required: "Ingrese un Nombre",
        lettersonly: "El Nombre solo debe contener letras sin espacios",
        minlength: "El Nombre debe contener al menos 2 caracteres"
      },
       telefono: {
        required: "Ingrese un Número de Teléfono Valido",
        number: "Ingrese un Número de Teléfono Valido",
        minlength: "Ingrese un Número de Teléfono Valido"
      },
      direc_per: {
        required: "Ingrese una Dirección"
      },
      
    },

    errorElement: "em",
    errorPlacement: function ( error, element ) {
      // Add the `invalid-feedback` class to the error element
      error.addClass( "invalid-feedback" );

      if ( element.prop( "type" ) === "checkbox" ) {
        error.insertAfter( element.next( "label" ) );
      } else {
        error.insertAfter( element );
      }
    },
    highlight: function ( element, errorClass, validClass ) {
      $( element ).addClass( "is-invalid" ).removeClass( "is-valid" );
    },
    unhighlight: function (element, errorClass, validClass) {
      $( element ).addClass( "is-valid" ).removeClass( "is-invalid" );
    }
  } );

} );

  jQuery.validator.addMethod("lettersonly", function(value, element) {
  return this.optional(element) || /^[A-Z^\s]+$/i.test(value);
}, "Letters only please"); 

// Masks

$('.tele-mask').mask('(0000) 000 0000');

</script>
<?php require_once('includes/admin_footer.php');  ?>