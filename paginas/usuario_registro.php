<?php 
  require_once('includes/admin_header.php');

  if (!isset($_SESSION['active'])) {
    header('Location: usuario_inicio.php');
    exit();
  }
?>

<div class="container col-lg-10">
  <div class="form-group text-center">
    <div class="card">
    	<div class="card-header">
		    <b>Registrar Usuario</b>
		  </div>
	   	<div class="card-body">
        <form role="form" id="usuario_registro" class="justify-content-center mx- my-1" align="center" enctype="multipart/form-data" action="../ajax/guardar_usuario.php" method="post">
          <div class="form-row">
            <div class="col form-group">
              <label class="form-label" for="nombre"><b>Nombre: </b></label>
              <input type="text" class="form-control" name="nombre" autocomplete="off" id="nombre" placeholder="Carlos" maxlength="20" onkeyup="this.value = this.value.toUpperCase();" required>
            </div>
            <div class="col form-group">
              <label class="form-label" for="rol"><b>Tipo de Usuario: </b></label>
              <?php 
                $query_rol = mysqli_query($conexion,"SELECT * FROM  rol");
                $result_rol = mysqli_num_rows($query_rol);
              ?>
              <select class="form-control" name="rol" id="rol">
                <?php 
                  if ($result_rol > 0) {
                  while ($rol = mysqli_fetch_array($query_rol)) {?>
                  <option value="<?php echo $rol['idrol'];?>"><?php echo $rol['rol'];?></option>
                <?php
                }
                }
                ?>
              </select>
            </div>
            <div class="col form-group">
              <label class="form-label" for="correo"><b>E-Mail: </b></label>
              <input type="email" class="form-control" name="correo" autocomplete="off" id="correo" placeholder="correo@mail.com" onkeyup="this.value = this.value.toUpperCase();">
            </div>
          </div>
          <div class="form-row">
            <div class="col form-group">
              <label class="form-label" for="usuario"><b>Usuario: </b></label>
              <input type="text" class="form-control" name="usuario" autocomplete="off" id="usuario" placeholder="miusuario" maxlength="20" onkeyup="this.value = this.value.toUpperCase();">
            </div>
            <div class="col form-group">
              <label class="form-label" for="clave"><b>Contraseña: </b></label>
              <input type="password" class="form-control" name="clave" autocomplete="off" id="clave" placeholder="********" maxlength="20">
            </div>
            <div class="col form-group">
              <label class="form-label" for="confirm_password"><b>Confirmar Contraseña: </b></label>
              <input type="password" class="form-control" name="confirm_password" autocomplete="off" id="confirm_password" placeholder="********" maxlength="20">
            </div>
          </div>
          <div class="form-row">
            <div class="col form-group">
              <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-user"></i> Registrar Usuario</button>
              <button type="reset" class="btn btn-light btn-block"><i class="fa fa-undo"></i> Limpiar</button>
            </div>
          </div> 
        </form>    
			</div>
			<div class="card-footer">
         <a href="usuario_lista.php" class="btn btn-info float-left"><i class="fa fa-arrow-left"></i> Volver al Listado</a> 
			</div>
    </div>
  </div>
</div>

<?php require_once('includes/admin_footer.php');  ?>

<script type="text/javascript">
	$( document ).ready( function () {
  $( "#usuario_registro" ).validate( {
    rules: {
      
      nombre: {
        required: true,
        lettersonly: true,
        minlength: 2
      },
      correo: {
        required: true,
        email: true
      },
      usuario: {
        required: true,
        minlength: 2,
        remote: {
          url: "usuario_usuario_availability.php",
          type: "post",
          data:
            {
              usuario: function()
              {
                return $('#usuario_registro :input[name="usuario"]').val();
              }
            }
        }     
      },
      clave: {
        required: true,
        minlength: 4
      },
      confirm_password: {
        required: true,
        minlength: 4,
        equalTo: "#clave"
      }, 
    },

    messages: {
      
      nombre: {
        required: "Ingrese un Nombre",
        lettersonly: "El Nombre solo debe contener letras sin espacios",
        minlength: "El Nombre debe contener al menos 2 caracteres"
      },
      correo: {
        required: "Ingrese una Dirección de Correo Electrónico Válida",
        email: "Ingrese una Dirección de Correo Electrónico Válida"
      },
      usuario: {
        required: "Ingrese un Nombre de Usuario",
        minlength: "El Nombre de Usuario debe contener al menos 2 caracteres",
        remote: jQuery.validator.format("{0} no esta disponible")
      },
      clave: {
        required: "Ingrese una Contraseña",
        minlength: "Tu Contraseña debe contener al menos 5 caracteres"
      },
      confirm_password: {
        required: "Ingrese una Contraseña",
        minlength: "Tu Contraseña debe contener al menos 5 caracteres",
        equalTo: "Ingrese la Misma Contraseña"
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

$('.telem-mask').mask('(0000) 000 0000');
$('.telec-mask').mask('(0000) 000 0000');

</script>