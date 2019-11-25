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
  header('location: noticia_lista.php');
}

$id = $_GET['id'];

  $query_not = mysqli_query($conexion,"SELECT ident_not, titul_not, desco_not, descr_not, image_not FROM tab_not WHERE ident_not = '$id' AND statu_not = 1");
  
  
$result_not = mysqli_num_rows($query_not);


$foto = '';
$classRemove = 'notBlock';

if ($result_not == 0) 
{
  header('location: libro_lista.php');
}else{
  $data_not = mysqli_fetch_array($query_not);
  if ($data_not['image_not'] != 'default.jpg') 
  {
    $classRemove = '';
    $foto = '<img id="img" src="../imagen/uploads/'.$data_not['image_not'].'" alt="Foto de la Noticia">';
  }
  
  $titul_not = $data_not['titul_not'];
  $desco_not = $data_not['desco_not'];
  $descr_not = $data_not['descr_not'];
}
mysqli_close($conexion);
?>

<div class="container col-lg-10">
  <div class="form-group text-center">
    <div class="card">
      <div class="card-header">
          <b>Editar Noticia</b>
        </div>
        <div class="card-body">
          <form role="form" id="noticia_editar" class="justify-content-center mx-3 my-1" align="center" enctype="multipart/form-data" action="../ajax/editar_noticia.php" method="post">
          <input type="hidden" name="id" id="id" value="<?php echo $id ?>">
          <input type="hidden" id="foto_actual" name="foto_actual" value="<?php echo $data_not['image_not'] ?>">
            <input type="hidden" id="foto_remove" name="foto_remove" value="<?php echo $data_not['image_not'] ?>">
          <div class="form-row">
            <div class="col form-group">
              <label class="form-label" for="titul_not"><b>Título: </b></label>
              <input type="text" class="form-control" name="titul_not" autocomplete="off" id="titul_not"  maxlength="100" value="<?php echo $titul_not; ?>" required>
            </div>
          </div>
          <div class="form-row">
            <div class="col form-group">
                <div class="photo">
                  <label class="form-label" for="image_not"><b>Imagen: </b></label>  
                    <div class="prevPhoto">
                    <span class="delPhoto <?php $classRemove; ?>">X</span>
                    <label for="foto"></label>
                    <?php echo $foto; ?>
                    </div>
                    <div class="upimg">
                    <input type="file" name="foto" id="foto">
                    </div>
                    <div id="form_alert"></div>
                </div>
              </div>
          </div>
          <div class="form-row">
            <div class="col form-group">
              <label class="form-label" for="desco_not"><b>Descripción Corta: </b></label>
              <input type="text" class="form-control" name="desco_not" autocomplete="off" id="desco_not" maxlength="100" value="<?php echo $desco_not; ?>">
            </div>
          </div>
          <div class="form-row">        
            <div class="col form-group">
              <label class="form-label" for="descr_not"><b>Descripción Larga: </b></label>
              <textarea class="form-control" name="descr_not" autocomplete="off" id="descr_not"  maxlength="2000"><?php echo $descr_not; ?></textarea>
            </div>
          </div>
            <div class="form-row">
              <div class="col form-group">
                <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-user"></i> Actualizar Noticia</button>
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

<script type="text/javascript">
  $( document ).ready( function () {
  $( "#noticia_editar" ).validate( {
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