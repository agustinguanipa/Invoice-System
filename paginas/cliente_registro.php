<?php 
  require_once('includes/admin_header.php');

  if (!isset($_SESSION['active'])) {
    header('Location: cliente_inicio.php');
    exit();
  }
?>

<div class="container col-lg-10">
  <div class="form-group text-center">
    <div class="card">
    	<div class="card-header">
		    <b>Registrar Cliente</b>
		  </div>
	   	<div class="card-body">
        <form role="form" id="cliente_registro" class="justify-content-center mx- my-1" align="center" enctype="multipart/form-data" action="../ajax/guardar_cliente.php" method="post">
          <div class="form-row">
            <div class="col form-group">
              <label class="form-label" for="cedula"><b>Cédula de Identidad: </b></label>
              <input type="text" class="form-control" name="cedula" autocomplete="off" id="cedula" placeholder="26607655" maxlength="10" onkeyup="this.value = this.value.toUpperCase();" required>
            </div>
            <div class="col form-group">
              <label class="form-label" for="nombre"><b>Nombre: </b></label>
              <input type="text" class="form-control" name="nombre" autocomplete="off" id="nombre" placeholder="Carlos" maxlength="45" onkeyup="this.value = this.value.toUpperCase();" required>
            </div>
          </div>
          <div class="form-row">
            <div class="col form-group">
              <label class="form-label" for="telefono"><b>Teléfono: </b></label>
              <input type="text" class="form-control tele-mask" name="telefono" autocomplete="off" id="telefono" placeholder="(0000) 000 0000" maxlength="15">
            </div>
            <div class="col form-group">
              <label class="form-label" for="direccion"><b>Dirección: </b></label>
              <input type="text" class="form-control" name="direccion" autocomplete="off" id="direccion" placeholder="Calle 2 Bellavista" onkeyup="this.value = this.value.toUpperCase();">
            </div>
          </div>
          <div class="form-row">
            <div class="col form-group">
              <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-user"></i> Registrar Cliente</button>
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

<?php require_once('includes/admin_footer.php');  ?>

<script type="text/javascript">
	$( document ).ready( function () {
  $( "#cliente_registro" ).validate( {
    rules: {
      cedula: {
        required: true,
        number: true,
        minlength: 6,
        remote: {
          url: "cliente_cedula_availability.php",
          type: "post",
          data:
            {
              cedula: function()
              {
                return $('#cliente_registro :input[name="cedula"]').val();
              }
            }
        }     
      },
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
      cedula: {
        required: "Ingrese una Cédula de Identidad",
        number: "Ingrese solo números",
        minlength: "La Cédula debe contener al menos 6 números",
        remote: jQuery.validator.format("{0} no esta disponible")
      },
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