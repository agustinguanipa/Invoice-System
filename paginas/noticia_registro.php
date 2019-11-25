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
		    <b>Publicar Noticia</b>
		  </div>
	   	<div class="card-body">
        <form role="form" id="noticia_registro" class="justify-content-center mx- my-1" align="center" enctype="multipart/form-data" action="../ajax/guardar_noticia.php" method="post">
          <div class="form-row">
            <div class="col form-group">
              <label class="form-label" for="titul_not"><b>Título: </b></label>
              <input type="text" class="form-control" name="titul_not" autocomplete="off" id="titul_not"  maxlength="100" required>
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
              <label class="form-label" for="desco_not"><b>Descripción Corta: </b></label>
              <input type="text" class="form-control" name="desco_not" autocomplete="off" id="desco_not" maxlength="100">
            </div>
          </div>
          <div class="form-row">        
            <div class="col form-group">
              <label class="form-label" for="descr_not"><b>Descripción Larga: </b></label>
              <textarea class="form-control" name="descr_not" autocomplete="off" id="descr_not"  maxlength="2000"></textarea>
            </div>
          </div>
          <div class="form-row">
            <div class="col form-group">
              <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-user"></i> Publicar Noticia</button>
              <button type="reset" class="btn btn-light btn-block"><i class="fa fa-undo"></i> Limpiar</button>
            </div>
          </div> 
        </form>    
			</div>
			<div class="card-footer">
         <a href="noticia_lista.php" class="btn btn-info float-left"><i class="fa fa-arrow-left"></i> Volver al Listado</a> 
			</div>
    </div>
  </div>
</div>

<?php require_once('includes/admin_footer.php');  ?>

<script type="text/javascript">
	$( document ).ready( function () {
  $( "#noticia_registro" ).validate( {
    rules: {
      titul_not: {
        required: true,
        minlength: 6
      },
      desco_not: {
        required: true,
        minlength: 15
      },
      descr_not: {
        required: true,
        minlength: 15
      },
    },

    messages: {
      titul_not: {
        required: "Ingrese un Título",
        minlength: "El Título debe contener al menos 6 caracteres"
      },
      desco_not: {
        required: "Ingrese una Descripción Corta",
        minlength: "La Descripcion debe contener al menos 6 caracteres"
      },
      descr_not: {
        required: "Ingrese una Descripción Larga",
        minlength: "La Descripción debe contener al menos 15 caracteres"
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