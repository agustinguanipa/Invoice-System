<?php 
  require_once('includes/admin_header.php');

  if (!isset($_SESSION['active'])) {
    header('Location: ../index.php');
    exit();
  }
?>

<div class="container col-lg-10">
  <div class="form-group text-center">
    <div class="card">
    	<div class="card-header">
		    <b>Registrar Producto</b>
		  </div>
	   	<div class="card-body">
        <form role="form" id="producto_registro" class="justify-content-center mx- my-1" align="center" enctype="multipart/form-data" action="../ajax/guardar_producto.php" method="post">
          <div class="form-row">
            <div class="col form-group">
              <label class="form-label" for="descripcion"><b>Nombre: </b></label>
              <input type="text" class="form-control" name="descripcion" autocomplete="off" id="descripcion" placeholder="Nombre del Producto" maxlength="100" onkeyup="this.value = this.value.toUpperCase();" required>
            </div>
            <div class="col form-group">
              <label class="form-label" for="precio"><b>Precio: </b></label>
              <input type="text" class="form-control precio-mask" name="precio" autocomplete="off" id="precio" placeholder="0000.00" maxlength="20" onkeyup="this.value = this.value.toUpperCase();">
            </div>
            <div class="col form-group">
              <label class="form-label" for="existencia"><b>Cantidad: </b></label>
              <input type="text" class="form-control" name="existencia" autocomplete="off" id="existencia" placeholder="00" maxlength="20" onkeyup="this.value = this.value.toUpperCase();">
            </div>
          </div>
          <div class="form-row">
            <div class="col form-group photo">
              <label class="form-label" for="image_not"><b>Imagen: </b></label>  
                <div class="prevPhoto">
                <span class="delPhoto notBlock">X</span>
                <label for="foto"></label>
                </div>
                <div class="upimg">
                <input type="file" name="foto" id="foto">
                </div>
                <div id="form_alert"></div>
            </div>
          </div>
          <div class="form-row">
            <div class="col form-group">
              <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-user"></i> Registrar Producto</button>
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

<?php require_once('includes/admin_footer.php');  ?>

<script type="text/javascript">
	$( document ).ready( function () {
  $( "#producto_registro" ).validate( {
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