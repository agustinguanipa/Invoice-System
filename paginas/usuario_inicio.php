<?php 

$alert = '';
session_start();
if (!empty($_SESSION['active'])) {
  header('location: admin_panel.php');
}else{

  if (!empty($_POST)) {
    if (empty($_POST['usuar_per']) || empty($_POST['contr_per'])) 
    {
      $alert = '(*) Ingrese su usuario y/o clave';
    }else{

      require_once 'conexion.php';
      $usuar_per = mysqli_real_escape_string($conexion, $_POST['usuar_per']);
      $contr_per = mysqli_real_escape_string($conexion, $_POST['contr_per']);

      $query = mysqli_query($conexion,"SELECT u.ident_per,u.cedul_per,u.nombr_per,u.apeli_per,u.fecna_per,u.telem_per,u.telec_per,u.email_per,u.direc_per,u.tifam_per,u.tibom_per,u.seria_per,u.usuar_per,u.contr_per,u.statu_per, r.ident_tip, r.nombr_tip FROM tab_per u INNER JOIN tab_tip r ON u.ident_tip = r.ident_tip WHERE u.usuar_per = '$usuar_per' AND u.contr_per = '$contr_per'");
      mysqli_close($conexion);
      $result = mysqli_num_rows($query);

      if ($result > 0)
      {
        $data = mysqli_fetch_array($query);
        
        $_SESSION['active'] = true;
        $_SESSION['idUser'] = $data['ident_per'];
        $_SESSION['nombr_per'] = $data['nombr_per'];
        $_SESSION['apeli_per'] = $data['apeli_per'];
        $_SESSION['fecna_per'] = $data['fecna_per'];
        $_SESSION['telem_per'] = $data['telem_per'];
        $_SESSION['telec_per'] = $data['telec_per'];
        $_SESSION['email_per'] = $data['email_per'];
        $_SESSION['direc_per'] = $data['direc_per'];
        $_SESSION['tifam_per'] = $data['tifam_per'];
        $_SESSION['tibom_per'] = $data['tibom_per'];
        $_SESSION['seria_per'] = $data['seria_per'];
        $_SESSION['usuar_per'] = $data['usuar_per'];
        $_SESSION['statu_per'] = $data['statu_per'];
        $_SESSION['ident_tip'] = $data['ident_tip'];
        $_SESSION['nombr_tip'] = $data['nombr_tip'];
        
        header('location: admin_panel.php');
      }else{

        $alert = '(*) El usuario y/o contraseña son incorrectos.';
        session_destroy();
      }
    }
  }
}

?>

<?php require_once('includes/logreg_header.php'); ?>

<head>
  <title>Iniciar Sesión | Biblioteca UNEFA Táchira</title>
</head>

<body>

<!-- Header --->

<header class="section-header mt-5">
  <section class="header-main">
    <div class="container" align="center">
      <div class="row align-items-center">
        <div class="col-sm-12">
          <div class="brand-wrap">
            <a href="../index.php" style="color: #000000; text-decoration: none;">
              <img class="logo" src="../imagen/logo-cc-color.png">
              <h2 class="logo-text"><b>Consejo Comunal Ambrosio Plaza</b></h2>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
</header>

<body>
  <div class="container">
    <div class="form-group text-center">
      <div class="formulario-registro-inicio">
        <form name="form" id="usuario_inicio" class="justify-content-center" align="center" action="" method="post">
          <h3>Iniciar Sesión</h3>
          <hr class="my-4">
          <div class="form-row">
            <div class="col form-group">
              <label class="form-label" for="usuar_per"><b>Usuario: </b></label>
              <input type="text" class="form-control" name="usuar_per" autocomplete="off" id="usuar_per" placeholder="miusuario" maxlength="20" onkeyup="this.value = this.value.toUpperCase();">
            </div>
          </div>
          <div class="form-row">
            <div class="col form-group">
              <label class="form-label" for="contr_per"><b>Contraseña: </b></label>
              <input type="password" class="form-control" name="contr_per" autocomplete="off" id="contr_per" placeholder="********" maxlength="20">
            </div>
          </div>
          <div class="form-row">
            <div class="col form-group">
              <div class="alert" style="color: #FC0107; font-style: italic;"><?php echo isset($alert)? $alert : ''; ?></div>
              <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-user"></i> Iniciar Sesión</button>
              <button type="reset" class="btn btn-light btn-block"><i class="fa fa-undo"></i> Limpiar</button>
            </div>
          </div>
        </form>
      </div> 
    </div>
  </div>
</body>

<?php require_once('includes/logreg_footer.php'); ?>

<script type="text/javascript">
 $( document ).ready( function () {
  $( "#usuario_inicio" ).validate( {
    rules: {
      usuar_per: {
        required: true,
        minlength: 2
      },
      contr_per: {
        required: true,
        minlength: 4
      }
    },

    messages: {
      usuar_per: {
        required: "Ingrese un Nombre de Usuario",
        minlength: "Tu Nombre de Usuario debe contener al menos 2 caracteres"
      },
      contr_per: {
        required: "Ingrese una Contraseña",
        minlength: "Tu Contraseña debe contener al menos 5 caracteres"
      }
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
