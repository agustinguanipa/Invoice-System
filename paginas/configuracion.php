<?php 

	require_once('includes/admin_header.php');

	// Datos Empresa
		
		$query_empresa = mysqli_query($conexion,"SELECT * FROM configuracion");
		$row_empresa = mysqli_num_rows($query_empresa);

		if ($row_empresa > 0) 
		{
			while ($data = mysqli_fetch_assoc($query_empresa)) 
			{
				$rif = $data['rif'];
				$nombre = $data['nombre'];
				$razon_social = $data['razon_social'];
				$telefono = $data['telefono'];
				$email = $data['email'];
				$direccion = $data['direccion'];
				$iva = $data['iva'];
			}
		}

		$query_dash = mysqli_query($conexion,"CALL dataDashboard()");
		$result_das = mysqli_num_rows($query_dash);
		if ($result_das > 0) 
		{
			$data_das = mysqli_fetch_assoc($query_dash);
		}
?>

<div class="container-fluid" align="center">
	<div class="card-deck">
		<div class="card text-center">
		  <div class="card-header">
		    <b>Configuración del Usuario</b>
		  </div>
		 <div class="card-body">
		    <h5>Información Personal</h5>
				  <hr class="my-4">
				  <div class="form-row">
				    <div class="col form-group">
				      <label class="form-label" for="nombre"><b>Nombre: </b></label>
				      <label><?= $_SESSION['nombre']; ?></label>
				    </div>
				  </div>
				  <div class="form-row">
				    <div class="col form-group">
				      <label class="form-label" for="email"><b>E-Mail: </b></label>
				      <label><?= $_SESSION['email']; ?></label>
				    </div>
				  </div>
			  <h5>Datos Usuario</h5>
			  <hr class="my-4">
			  <div class="form-row">
			    <div class="col form-group">
			      <label class="form-label" for="user"><b>Usuario: </b></label>
			      <label><?= $_SESSION['user']; ?></label>
			    </div>
			  </div>
			  <div class="form-row">
			    <div class="col form-group">
			      <label class="form-label" for="ident_tipu"><b>Tipo de Usuario: </b></label>
			      <label><?= $_SESSION['rol_name']; ?></label>
			    </div>
			  </div>
		  </div>
		</div>

		<div class="card text-center">
		  <div class="card-header">
		    <b>Configuración de la Empresa</b>
		  </div>
		  <div class="card-body">
		  	<h5>Información de la Empresa</h5>
				<hr class="my-4">
		    <div class="containerdataempresa">
					<div class="logoEmpresa">
						<img src="../imagen/logo-vrj.png" alt="" width="150px">
					</div>
					<h5>Datos Empresa</h5>
		  		<hr class="my-4">
					<form role="form" id="configuracion_editar" name="configuracion_editar" action="../ajax/editar_configuracion.php" method="POST">
						<input type="hidden" name="action" value="updateDataEmpresa">
						<div class="form-row">
					    <div class="col form-group">
					      <label class="form-label" for="textEmpRegistro"><b>RIF: </b></label>
					      <input class="form-control" type="text" name="txtEmpRegistro" id="txtEmpRegistro" placeholder="Registro de la Empresa" value="<?= $rif; ?>" onkeyup="this.value = this.value.toUpperCase();" required>
					    </div>
					  </div>
					  <div class="form-row">
					    <div class="col form-group">
					      <label class="form-label" for="textEmpNombre"><b>Nombre: </b></label>
					      <input class="form-control" type="text" name="txtEmpNombre" id="txtEmpNombre" placeholder="Nombre de la Empresa" value="<?= $nombre; ?>" onkeyup="this.value = this.value.toUpperCase();" required>
					    </div>
					  </div>
					  <div class="form-row">
					    <div class="col form-group">
					      <label class="form-label" for="textRSocial"><b>Razón Social: </b></label>
					      <input class="form-control" type="text" name="txtRSocial" id="txtRSocial" placeholder="Razón Social" value="<?= $razon_social; ?>" onkeyup="this.value = this.value.toUpperCase();" required>
					    </div>
					  </div>
					  <div class="form-row">
					    <div class="col form-group">
					      <label class="form-label" for="txtEmpTelefono"><b>Teléfono: </b></label>
					      <input class="form-control telefono-mask" type="text" name="txtEmpTelefono" id="txtEmpTelefono" placeholder="(0000) 000 0000" value="<?= $telefono; ?>" onkeyup="this.value = this.value.toUpperCase();" required>
					    </div>
					  </div>
					  <div class="form-row">
					    <div class="col form-group">
					      <label class="form-label" for="txtEmpEmail"><b>E-Mail: </b></label>
					      <input class="form-control" type="email" name="txtEmpEmail" id="txtEmpEmail" placeholder="correo@mail" value="<?= $email; ?>" onkeyup="this.value = this.value.toUpperCase();" required>
					    </div>
					  </div>
					  <div class="form-row">
					    <div class="col form-group">
					      <label class="form-label" for="txtEmpDireccion"><b>Dirección: </b></label>
					      <input class="form-control" type="text" name="txtEmpDireccion" id="txtEmpDireccion" placeholder="Zona Industrial de Paramillo" value="<?= $direccion; ?>" onkeyup="this.value = this.value.toUpperCase();" required>
					    </div>
					  </div>
					  <div class="form-row">
					    <div class="col form-group">
					      <label class="form-label" for="txtEmpIva"><b>IVA (%): </b></label>
					      <input class="form-control" type="text" name="txtEmpIva" id="txtEmpIva" placeholder="Impuesto al Valor Agregado (iva)" value="<?= $iva; ?>" onkeyup="this.value = this.value.toUpperCase();" required>
					    </div>
					  </div>
						<div class="form-row">
	            <div class="col form-group">
	              <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-save"></i> Guardar Datos</button>
	              <button type="reset" class="btn btn-light btn-block"><i class="fa fa-undo"></i> Limpiar</button>
	            </div>
	          </div>
					</form>
				</div>
		  </div>
		</div>

		<div class="card text-center">
			<div class="card-header">
		    <b>Cambiar Contraseña</b>
		  </div>
		  <div class="container">
		    <div class="form-group text-center">
		      <div class="justify-content-center mx-3 my-3">
		        <form role="form" name="frmChangePass" id="frmChangePass" action="../ajax/actualizar_contraseña.php" class="justify-content-center" align="center" method="post">
		          <div class="form-row">
		            <div class="col form-group">
		              <label class="form-label" for="txtPassUser"><b>Contraseña Actual: </b></label>
		              <input class="form-control" type="password" name="txtPassUser" id="txtPassUser" placeholder="*********" required>
		            </div>
		          </div>
		          <div class="form-row">
		            <div class="col form-group">
		              <label class="form-label" for="txtNewPassUser"><b>Nueva Contraseña: </b></label>
		              <input class="form-control newPass" type="password" name="txtNewPassUser" id="txtNewPassUser" placeholder="*********" required>
		            </div>
		          </div>
		          <div class="form-row">
		            <div class="col form-group">
		              <label class="form-label" for="txtPassConfirm"><b>Confirmar Contraseña: </b></label>
		              <input class="form-control newPass" type="password" name="txtPassConfirm" id="txtPassConfirm" placeholder="*********" required>
		            </div>
		          </div>
		          <div class="form-row">
		            <div class="col form-group">
		              <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-key"></i> Cambiar Contraseña</button>
		              <button type="reset" class="btn btn-light btn-block"><i class="fa fa-undo"></i> Limpiar</button>
		            </div>
		          </div>
		        </form>
		      </div> 
		    </div>
	  	</div>
		</div>
	</div>
</div>


<?php require_once('includes/admin_footer.php');  ?>

<script type="text/javascript">
  $( document ).ready( function () {
  $( "#configuracion_editar" ).validate( {
    rules: {
      
      textEmpRegistro: {
        required: true,
        minlength: 8
      },
      textEmpNombre: {
        required: true,
        lettersonly: true
      },
      textEmpRSocial: {
        required: true,
        minlength: 8
      },
      textEmpTelefono: {
        required: true,
        minlength: 15,
      },
      textEmpEmail: {
        required: true,
        email: true
      },
      textEmpDireccion: {
        required: true,
        minlength: 2
      },
      textEmpIva: {
        required: true,
        number: true,
        minlength: 8
      },
    },

    messages: {
      
      textEmpRegistro: {
        required: "Ingrese un RIF",
        minlength: "El RIF debe contener al menos 2 caracteres"
      },
      textEmpNombre: {
        required: "Ingrese un Nombre",
        minlength: "El Nombre debe contener al menos 2 caracteres"
      },
      textEmpRSocial: {
        required: "Ingrese una Razón Social",
        minlength: "La Razón Social debe contener al menos 2 caracteres"
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

$('.telefono-mask').mask('(0000) 000 0000');

</script>

<script type="text/javascript">
	$( document ).ready( function () {
  $( "#frmChangePass" ).validate( {
    rules: {
    	txtPassUser: {
    		required: true,
    		minlength: 4
    	},
      txtNewPassUser: {
        required: true,
        minlength: 4
      },
      txtPassConfirm: {
        required: true,
        minlength: 4,
        equalTo: "#txtNewPassUser"
      }, 
    },

    messages: {
    	txtPassUser: {
    		required: "Ingrese su Contraseña Actual",
        minlength: "Tu Contraseña debe contener al menos 5 caracteres"
    	},
      txtNewPassUser: {
        required: "Ingrese una Contraseña Nueva",
        minlength: "Tu Contraseña debe contener al menos 5 caracteres"
      },
      txtPassConfirm: {
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

</script>
