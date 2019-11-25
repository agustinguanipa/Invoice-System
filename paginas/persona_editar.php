<?php 
  require_once('includes/admin_header.php');

  if (!isset($_SESSION['active'])) {
    header('Location: usuario_inicio.php');
    exit();
  }
?>

<?php 

include 'conexion.php';

if (empty($_GET['id'])) {
  header('location: persona_lista.php');
}

$id = $_GET['id'];

	$query_user = mysqli_query($conexion,"SELECT u.ident_per, u.cedul_per,u.nombr_per, u.apeli_per, u.fecna_per, u.telem_per, u.telec_per, u.email_per, u.direc_per, u.tifam_per, u.tibom_per, u.seria_per, u.usuar_per, r.ident_tip, r.nombr_tip FROM tab_per u INNER JOIN tab_tip r ON u.ident_tip = r.ident_tip WHERE ident_per = '$id' AND statu_per = 1");
	
	
$result_user = mysqli_num_rows($query_user);

if ($result_user == 0) 
{
	header('location: persona_lista.php');
}else{
	$data_per = mysqli_fetch_array($query_user);
	
	$cedul_per = $data_per['cedul_per'];
  $nombr_per = $data_per['nombr_per'];
  $apeli_per = $data_per['apeli_per'];
  $fecna_per = $data_per['fecna_per'];
  $telem_per = $data_per['telem_per'];
  $telec_per = $data_per['telec_per'];
  $email_per = $data_per['email_per'];
  $direc_per = $data_per['direc_per'];
  $tifam_per = $data_per['tifam_per'];
  $tibom_per = $data_per['tibom_per'];
  $seria_per = $data_per['seria_per'];
  $usuar_per = $data_per['usuar_per'];
  $ident_tip = $data_per['ident_tip'];
  $nombr_tip = $data_per['nombr_tip'];
}
mysqli_close($conexion);
?>

<div class="container col-lg-10">
  <div class="form-group text-center">
    <div class="card">
    	<div class="card-header">
			    <b>Editar Persona</b>
			  </div>
		   	<div class="card-body">
  				<form role="form" id="usuario_editar" class="justify-content-center mx-3 my-1" align="center" enctype="multipart/form-data" action="../ajax/editar_persona.php" method="post">
  					<input type="hidden" name="id" id="id" value="<?php echo $id ?>">
		        <div class="form-row">
              <!--
              <div class="col form-group">
                <label class="form-label" for="cedul_per"><b>Cédula de Identidad: </b></label>
                <input type="text" class="form-control" name="cedul_per" autocomplete="off" id="cedul_per" value="<?php echo $cedul_per; ?>" maxlength="10" onkeyup="this.value = this.value.toUpperCase();">
              </div> 
              !-->
		          <div class="col form-group">
		            <label class="form-label" for="nombr_per"><b>Nombre: </b></label>
		            <input type="text" class="form-control" name="nombr_per" autocomplete="off" id="nombr_per" value="<?php echo $nombr_per; ?>" maxlength="20" onkeyup="this.value = this.value.toUpperCase();">
		          </div>
		          <div class="col form-group">
		            <label class="form-label" for="apeli_per"><b>Apellido: </b></label>
		            <input type="text" class="form-control" name="apeli_per" autocomplete="off" id="apeli_per" value="<?php echo $apeli_per; ?>" maxlength="20" onkeyup="this.value = this.value.toUpperCase();">
		          </div>
              <div class="col form-group">
                <label class="form-label" for="ident_tip"><b>Tipo de Usuario: </b></label>
                <?php
                  include "conexion.php";
                  $query_rol = mysqli_query($conexion,"SELECT * FROM  tab_tip");
                  $result_rol = mysqli_num_rows($query_rol);
                ?>
                <select class="form-control" name="ident_tip" id="ident_tip">
                  <option value="<?php echo $ident_tip;?>"><?php echo $nombr_tip;?></option>
                  <?php 
                    if ($result_rol > 0) {
                    while ($rol = mysqli_fetch_array($query_rol)) {?>
                    <option value="<?php echo $rol['ident_tip'];?>"><?php echo $rol['nombr_tip'];?></option>
                  <?php
                  }
                  }
                  ?>
                </select>
              </div>
		        </div>
		        <div class="form-row">
              <div class="col form-group">
                <label class="form-label" for="fecna_per"><b>Fecha de Nacimiento: </b></label>
                <input type="date" class="form-control" name="fecna_per" autocomplete="off" value="<?php echo $fecna_per; ?>" id="fecna_per">
              </div>
              <div class="col form-group">
                <label class="form-label" for="telem_per"><b>Teléfono Celular: </b></label>
                <input type="text" class="form-control telem-mask" name="telem_per" autocomplete="off" id="telem_per" value="<?php echo $telem_per; ?>" maxlength="15">
              </div>
              <div class="col form-group">
                <label class="form-label" for="telec_per"><b>Teléfono de Casa: </b></label>
                <input type="text" class="form-control telec-mask" name="telec_per" autocomplete="off" id="telec_per" value="<?php echo $telec_per; ?>" maxlength="15">
              </div>
		          <div class="col form-group">
		            <label class="form-label" for="email_per"><b>E-Mail: </b></label>
		            <input type="email" class="form-control" name="email_per" autocomplete="off" value="<?php echo $email_per; ?>" id="email_per" maxlength="100" onkeyup="this.value = this.value.toUpperCase();">
		          </div>
		        </div>
		        <div class="form-row">
              <div class="col form-group">
                <label class="form-label" for="direc_per"><b>Dirección: </b></label>
                <input type="text" class="form-control" name="direc_per" autocomplete="off" id="direc_per" value="<?php echo $direc_per; ?>" onkeyup="this.value = this.value.toUpperCase();">
              </div>
		        </div>
            <div class="form-row">
              <div class="col form-group">
                <label class="form-label" for="tifam_per"><b>Tipo de Familiar: </b></label>
                <select class="form-control" name="tifam_per" id="tifam_per">
                  <option value="<?php echo $tifam_per;?>"><?php echo $tifam_per;?></option>
                  <option value="JEFE DE FAMILIA">JEFE DE FAMILIA</option>
                  <option value="MADRE/PADRE">MADRE/PADRE</option>
                  <option value="HIJO/HIJA">HIJO/HIJA</option>
                  <option value="NIETO/NIETA">NIETO/NIETA</option>
                </select>
              </div>
              <div class="col form-group">
                <label class="form-label" for="tibom_per"><b>Tipo de Bombona: </b></label>
                <select class="form-control" id="tibom_per" name="tibom_per">
                  <option value="<?php echo $tibom_per;?>"><?php echo $tibom_per;?></option>
                  <option value="10 KG">10 KG</option>
                  <option value="20 KG">20 KG</option>
                  <option value="GRANEL">GRANEL</option>
                </select>
              </div>
              <div class="col form-group">
                <label class="form-label" for="seria_per"><b>Serial del Carnet de la Patria: </b></label>
                <input type="text" class="form-control" name="seria_per" autocomplete="off" id="seria_per" value="<?php echo $seria_per; ?>" maxlength="20">
              </div>
              <!--
              <div class="col form-group">
                <label class="form-label" for="usuar_per"><b>Usuario: </b></label>
                <input type="text" class="form-control" name="usuar_per" autocomplete="off" id="usuar_per" value="<?php echo $usuar_per; ?>" maxlength="20" onkeyup="this.value = this.value.toUpperCase();">
              </div>
              !-->
		        </div>
		        <div class="form-row">
		          <div class="col form-group">
		            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-user"></i> Actualizar Persona</button>
		            <button type="reset" class="btn btn-light btn-block"><i class="fa fa-undo"></i> Limpiar</button>
		          </div>
		        </div>
		      </form>
				</div>
				<div class="card-footer">
           <a href="persona_lista.php" class="btn btn-info float-left"><i class="fa fa-arrow-left"></i> Volver al Listado</a> 
				</div>
    </div> 
  </div>
</div>

<script type="text/javascript">
  $( document ).ready( function () {
  $( "#usuario_editar" ).validate( {
    rules: {
      cedul_per: {
        required: true,
        number: false,
        minlength: 6,
        remote: {
          url: "persona_cedula_availability.php",
          type: "post",
          data:
            {
              usuar_per: function()
              {
                return $('#usuario_editar :input[name="cedul_per"]').val();
              }
            }
        }     
      },
      nombr_per: {
        required: true,
        lettersonly: true,
        minlength: 2
      },
      apeli_per: {
        required: true,
        lettersonly: true,
        minlength: 2
      },
      fecna_per: {
        required: true
      },
      telem_per: {
        required: true,
        number: false,
        minlength: 15
      },
      telec_per: {
        required: true,
        number: false,
        minlength: 15
      },
      email_per: {
        required: true,
        email: true
      },
      direc_per: {
        required: true
      },
      seria_per: {
        required: true,
        number: false
      },
      usuar_per: {
        required: true,
        minlength: 2,
        remote: {
          url: "persona_usuario_availability.php",
          type: "post",
          data:
            {
              usuar_per: function()
              {
                return $('#usuario_editar :input[name="usuar_per"]').val();
              }
            }
        }     
      },
    },

    messages: {
      cedul_per: {
        required: "Ingrese una Cédula de Identidad",
        minlength: "La Cédula debe contener al menos 6 números",
        remote: jQuery.validator.format("{0} no esta disponible")
      },
      nombr_per: {
        required: "Ingrese un Nombre",
        lettersonly: "El Nombre solo debe contener letras sin espacios",
        minlength: "El Nombre debe contener al menos 2 caracteres"
      },
      apeli_per: {
        required: "Ingrese un Apellido",
        lettersonly: "El Apellido solo debe contener letras sin espacios",
        minlength: "El Apellido debe contener al menos 2 caracteres"
      },
      fecna_per: {
        required: "Ingrese una Fecha de Nacimiento"
      },
      telem_per: {
        required: "Ingrese un Número de Teléfono Valido",
        number: "Ingrese un Número de Teléfono Valido",
        minlength: "Ingrese un Número de Teléfono Valido"
      },
      telec_per: {
        required: "Ingrese un Número de Teléfono Valido",
        number: "Ingrese un Número de Teléfono Valido",
        minlength: "Ingrese un Número de Teléfono Valido"
      },
      email_per: {
        required: "Ingrese una Dirección de Correo Electrónico Válida",
        email: "Ingrese una Dirección de Correo Electrónico Válida"
      },
      direc_per: {
        required: "Ingrese una Dirección"
      },
      seria_per: {
        required: "Ingrese un Serial del Carnet",
        number: "Ingrese un Serial del Carnet"
      },
      usuar_per: {
        required: "Ingrese un Nombre de Usuario",
        minlength: "El Nombre de Usuario debe contener al menos 2 caracteres",
        remote: jQuery.validator.format("{0} no esta disponible")
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