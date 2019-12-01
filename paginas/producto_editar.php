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
	header('location: producto_lista.php');
}

$id = $_GET['id'];

$query_user = mysqli_query($conexion,"SELECT * FROM producto WHERE codproducto = '$id' AND estatus = 1 ");
	
$result_user = mysqli_num_rows($query_user);

$data_user = mysqli_fetch_array($query_user);

$descripcion = $data_user['descripcion'];
$precio = $data_user['precio'];
$existencia = $data_user['existencia'];


mysqli_close($conexion);
?>

<div class="container col-lg-8">
  <div class="form-group text-center">
    <div class="card">
    	<div class="card-header">
			    <b>Editar Productoe</b>
			  </div>
		   	<div class="card-body">
  				<form role="form" id="producto_editar" class="justify-content-center mx-3 my-1" align="center" enctype="multipart/form-data" action="../ajax/editar_producto.php" method="post">
  					<input type="hidden" name="id" id="id" value="<?php echo $id ?>">
		        <div class="form-row">
              <div class="col form-group">
                <label class="form-label" for="descripcion"><b>Nombre: </b></label>
                <input type="text" class="form-control" name="descripcion" autocomplete="off" id="descripcion" value="<?php echo $descripcion; ?>" maxlength="100" onkeyup="this.value = this.value.toUpperCase();">
              </div>
		          <div class="col form-group">
		            <label class="form-label" for="precio"><b>Precio: </b></label>
		            <input type="text" class="form-control" name="precio" autocomplete="off" id="precio" value="<?php echo $precio; ?>" maxlength="45" onkeyup="this.value = this.value.toUpperCase();">
		          </div>
              <div class="col form-group">
                <label class="form-label" for="existencia"><b>Cantidad: </b></label>
                <input type="text" class="form-control" name="existencia" autocomplete="off" id="existencia" value="<?php echo $existencia; ?>" maxlength="45" onkeyup="this.value = this.value.toUpperCase();">
              </div>
		        </div>
		        <div class="form-row">
		          <div class="col form-group">
		            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-user"></i> Actualizar Producto</button>
		            <button type="reset" class="btn btn-light btn-block"><i class="fa fa-undo"></i> Limpiar</button>
		          </div>
		        </div>
		      </form>
				</div>
				<div class="card-footer">
           <a href="producto_lista.php" class="btn btn-info float-left"><i class="fa fa-arrow-left"></i> Volver al Listado</a> 
				</div>
    </div> 
  </div>
</div>

<script type="text/javascript">
  $( document ).ready( function () {
  $( "#producto_editar" ).validate( {
    rules: {
      
      descripcion: {
        required: true,
        minlength: 2
      },
      precio: {
        required: true
      },
      existencia: {
        required: true,
        number: true
      },
    },

    messages: {
      
      descripcion: {
        required: "Ingrese una Descripcion",
        minlength: "La descripcion debe contener al menos 2 caracteres"
      },
      precio: {
        required: "Ingrese el Precio"
      },
      existencia: {
        required: "Ingrese la Cantidad",
        number: "Ingrese solo Números"
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

</script>