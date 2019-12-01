<?php 

$alert = '';
session_start();
if (!empty($_SESSION['active'])) {
  header('location: paginas/admin_panel.php');
}else{

  if (!empty($_POST)) {
    if (empty($_POST['usuario']) || empty($_POST['clave'])) 
    {
      $alert = '(*) Ingrese su usuario y/o clave';
    }else{

      require_once 'paginas/conexion.php';
      $usuario = mysqli_real_escape_string($conexion, $_POST['usuario']);
      $clave = mysqli_real_escape_string($conexion, $_POST['clave']);

     $query = mysqli_query($conexion,"SELECT u.idusuario,u.nombre,u.correo,u.usuario, r.idrol, r.rol FROM usuario u INNER JOIN rol r ON u.rol = r.idrol WHERE u.usuario = '$usuario' AND u.clave = '$clave'");
      mysqli_close($conexion);
      
      $result = mysqli_num_rows($query);

     if ($result > 0)
      {
        $data = mysqli_fetch_array($query);
        
        $_SESSION['active'] = true;
        $_SESSION['idUser'] = $data['idusuario'];
        $_SESSION['nombre'] = $data['nombre'];
        $_SESSION['email'] = $data['correo'];
        $_SESSION['user'] = $data['usuario'];
        $_SESSION['rol'] = $data['idrol'];
        $_SESSION['rol_name'] = $data['rol'];

        header('location: index.php');
      }else{

        $alert = '(*) El usuario y/o clave son incorrestos.';
        session_destroy();
      }
    }
  }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta name="description" content="Venta de Repuestos Juancho">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--- Favicon --->
  <link rel="shortcut icon" href="imagen/favicon.ico" type="image/x-icon">
  <link rel="icon" href="imagen/favicon.ico" type="image/x-icon">
  <!--- CSS --->
  <link rel="stylesheet" type="text/css" href="css/estilos.css">
  <link rel="stylesheet" type="text/css" href="css/estilos_admin.css">
  <link rel="stylesheet" type="text/css" href="css/estilos_crud.css">
  <link href="libs/startbootstrap-simple-sidebar-gh-pages/css/simple-sidebar.css" rel="stylesheet">
  <link href="libs/startbootstrap-simple-sidebar-gh-pages/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--- jQuery --->
  <script src="libs/jquery/jquery-3.4.1.min.js" type="text/javascript"></script>
  <!--- jQuery Validation --->
  <script type="text/javascript" src="libs/jquery-validation-1.19.0/lib/jquery-1.11.1.js"></script>
  <script type="text/javascript" src="libs/jquery-validation-1.19.0/dist/jquery.validate.js"></script>
  <!--- jQuery Mask Plugin --->
  <script type="text/javascript" src="libs/jQuery-Mask-Plugin/dist/jquery.mask.js"></script>
  <!--- JS --->
  <!--- Bootstrap 4 --->
  <link rel="stylesheet" href="libs/bootstrap-4.1.3-dist/css/bootstrap.min.css"/>
  <script src="libs/bootstrap-4.1.3-dist/js/bootstrap.min.js"></script>
  <!--- Bootstrap 4 UI E-Commerce --->
  <script src="libs/bootstrap-ecommerce-uikit/ui-ecommerce/js/bootstrap.bundle.min.js" type="text/javascript"></script>
  <link href="libs/bootstrap-ecommerce-uikit/ui-ecommerce/css/bootstrap.css" rel="stylesheet" type="text/css"/>
  <link href="libs/bootstrap-ecommerce-uikit/ui-ecommerce/fonts/fontawesome/css/fontawesome-all.min.css" type="text/css" rel="stylesheet">
  <link href="libs/bootstrap-ecommerce-uikit/ui-ecommerce/plugins/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="libs/bootstrap-ecommerce-uikit/ui-ecommerce/plugins/owlcarousel/assets/owl.theme.default.css" rel="stylesheet">
  <script src="libs/bootstrap-ecommerce-uikit/ui-ecommerce/plugins/owlcarousel/owl.carousel.min.js"></script>
  <link href="libs/bootstrap-ecommerce-uikit/ui-ecommerce/css/ui.css" rel="stylesheet" type="text/css"/>
  <link href="libs/bootstrap-ecommerce-uikit/ui-ecommerce/css/responsive.css" rel="stylesheet" media="only screen and (max-width: 1200px)"/>
  <script src="libs/bootstrap-ecommerce-uikit/ui-ecommerce/js/script.js" type="text/javascript"></script>
  <!--- Bootstrap 4 File Style 2 --->
  <script type="text/javascript" src="libs/bootstrap-filestyle-2.1.0/src/bootstrap-filestyle.min.js"> </script>
</head>

<head>
  <title>Iniciar Sesión | Venta de Repuestos Juancho</title>
</head>

<body>

<!-- Header --->

<header class="section-header mt-5">
  <section class="header-main">
    <div class="container" align="center">
      <div class="row align-items-center">
        <div class="col-sm-12">
          <div class="brand-wrap">
            <a href="index.php" style="color: #000000; text-decoration: none;">
              <img class="logo" src="imagen/logo-vrj.png">
              <h2 class="logo-text"><b>Venta de Repuestos Juancho</b></h2>
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
              <label class="form-label" for="usuario"><b>Usuario: </b></label>
              <input type="text" class="form-control" name="usuario" autocomplete="off" id="usuario" placeholder="miusuario" maxlength="20" onkeyup="this.value = this.value.toUpperCase();">
            </div>
          </div>
          <div class="form-row">
            <div class="col form-group">
              <label class="form-label" for="clave"><b>Contraseña: </b></label>
              <input type="password" class="form-control" name="clave" autocomplete="off" id="clave" placeholder="********" maxlength="20">
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

<footer>
  <div class="container">
    <section class="footer-bottom row">
      <div class="col-sm-12">
        <p class="text-sm-center">Venta de Repuestos Juancho</p>
        <p class="text-sm-center">Copyright &copy 2019<br>
        </p>
      </div>
    </section>
  </div>
</footer>
</html>

<?php require_once('includes/logreg_footer.php'); ?>

<script type="text/javascript">
 $( document ).ready( function () {
  $( "#usuario_inicio" ).validate( {
    rules: {
      usuario: {
        required: true,
        minlength: 2
      },
      clave: {
        required: true,
        minlength: 4
      }
    },

    messages: {
      usuario: {
        required: "Ingrese un Nombre de Usuario",
        minlength: "Tu Nombre de Usuario debe contener al menos 2 caracteres"
      },
      clave: {
        required: "Ingrese una Contraseña",
        minlength: "Tu Contraseña debe contener al menos 5 caracteres"
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
