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
	header('location: usuario_lista.php');
}

$id = $_GET['id'];

	$query_user = mysqli_query($conexion,"SELECT u.idusuario, u.nombre, u.correo, u.usuario, r.rol, r.idrol FROM usuario u INNER JOIN rol r ON u.rol = r.idrol WHERE idusuario = '$id' AND estatus = 1");
	
$result_user = mysqli_num_rows($query_user);

$data_user = mysqli_fetch_array($query_user);

$nombre = $data_user['nombre'];
$correo = $data_user['correo'];
$usuario = $data_user['usuario'];
$idrol = $data_user['idrol'];
$rol = $data_user['rol'];

mysqli_close($conexion);
?>

<div class="container col-lg-6">
  <div class="form-group text-center">
    <div class="card">
    	<div class="card-header">
			    <b>Editar Usuario</b>
			  </div>
		   	<div class="card-body">
  				<form role="form" id="usuario_editar" class="justify-content-center mx-3 my-1" align="center" enctype="multipart/form-data" action="../ajax/editar_usuario.php" method="post">
  					<input type="hidden" name="id" id="id" value="<?php echo $id ?>">
						<input type="hidden" id="foto_actual" name="foto_actual" value="<?php echo $data_user['foto'] ?>">
						<input type="hidden" id="foto_remove" name="foto_remove" value="<?php echo $data_user['foto'] ?>">
		        <div class="form-row">
		          <div class="col form-group">
		            <label class="form-label" for="nombre"><b>Nombre: </b></label>
		            <input type="text" class="form-control" name="nombre" autocomplete="off" id="nombre" value="<?php echo $nombre; ?>" maxlength="20" onkeyup="this.value = this.value.toUpperCase();">
		          </div>
		          <div class="col form-group">
		            <label class="form-label" for="correo"><b>Correo: </b></label>
		            <input type="email" class="form-control" name="correo" autocomplete="off" id="correo" value="<?php echo $correo; ?>" onkeyup="this.value = this.value.toUpperCase();">
		          </div>
		        </div>
		        <div class="form-row">
		          <div class="col form-group">
		            <label class="form-label" for="usuario"><b>Usuario: </b></label>
		            <input type="text" class="form-control" name="usuario" autocomplete="off" value="<?php echo $usuario; ?>" id="usuario" placeholder="miusuario" maxlength="20" onkeyup="this.value = this.value.toUpperCase();">
		          </div>
              <div class="col form-group">
                <label class="form-label" for="rol"><b>Tipo de Usuario: </b></label>
                <?php
                  include "conexion.php"; 
                  $query_rol = mysqli_query($conexion,"SELECT * FROM  rol");
                  mysqli_close($conexion);
                  $result_rol = mysqli_num_rows($query_rol);
                ?>
                <select name="rol" id="rol" class="form-control">
                  <?php 
                    if ($result_rol > 0) {
                    ?>
                    <option value="<?php echo $data_user['idrol'];?>"><?php echo $data_user['rol'];?></option>
                    <?php
                    while ($rol = mysqli_fetch_array($query_rol)) {?>
                    <option value="<?php echo $rol['idrol'];?>"><?php echo $rol['rol'];?></option>
                  <?php
                  }
                  }
                  ?>
                </select>
              </div>
		        </div>
		        <div class="form-row">
		          <div class="col form-group">
		            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-user"></i> Actualizar Usuario</button>
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

<script type="text/javascript">
  $( document ).ready( function () {
  $( "#usuario_editar" ).validate( {
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
<?php require_once('includes/admin_footer.php');  ?>