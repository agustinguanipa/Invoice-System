<?php 
  session_start();

  require_once ("conexion.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta name="description" content="Venta de Repuestos Juancho">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--- Favicon --->
  <link rel="shortcut icon" href="../imagen/favicon.ico" type="image/x-icon">
  <link rel="icon" href="../imagen/favicon.ico" type="image/x-icon">
  <!--- CSS --->
  <link rel="stylesheet" type="text/css" href="../css/estilos.css">
  <link rel="stylesheet" type="text/css" href="../css/estilos_admin.css">
  <link rel="stylesheet" type="text/css" href="../css/estilos_crud.css">
  <link rel="stylesheet" type="text/css" href="../css/foto.css">
  <link href="../libs/startbootstrap-simple-sidebar-gh-pages/css/simple-sidebar.css" rel="stylesheet">
  <link href="../libs/startbootstrap-simple-sidebar-gh-pages/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--- jQuery --->
  <script src="../libs/jquery/jquery-3.4.1.min.js" type="text/javascript"></script>
  <!--- jQuery Validation --->
  <script type="text/javascript" src="../libs/jquery-validation-1.19.0/lib/jquery-1.11.1.js"></script>
  <script type="text/javascript" src="../libs/jquery-validation-1.19.0/dist/jquery.validate.js"></script>
  <!--- jQuery Mask Plugin --->
  <script type="text/javascript" src="../libs/jQuery-Mask-Plugin/dist/jquery.mask.js"></script>
  <!--- JS --->
  <script type="text/javascript" src="../js/funciones.js"></script>
  <!--- Bootstrap 4 --->
  <link rel="stylesheet" href="../libs/bootstrap-4.1.3-dist/css/bootstrap.min.css"/>
  <script src="../libs/bootstrap-4.1.3-dist/js/bootstrap.min.js"></script>
  <!--- Bootstrap 4 UI E-Commerce --->
  <script src="../libs/bootstrap-ecommerce-uikit/ui-ecommerce/js/bootstrap.bundle.min.js" type="text/javascript"></script>
  <link href="../libs/bootstrap-ecommerce-uikit/ui-ecommerce/css/bootstrap.css" rel="stylesheet" type="text/css"/>
  <link href="../libs/bootstrap-ecommerce-uikit/ui-ecommerce/fonts/fontawesome/css/fontawesome-all.min.css" type="text/css" rel="stylesheet">
  <link href="../libs/bootstrap-ecommerce-uikit/ui-ecommerce/plugins/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="../libs/bootstrap-ecommerce-uikit/ui-ecommerce/plugins/owlcarousel/assets/owl.theme.default.css" rel="stylesheet">
  <script src="../libs/bootstrap-ecommerce-uikit/ui-ecommerce/plugins/owlcarousel/owl.carousel.min.js"></script>
  <link href="../libs/bootstrap-ecommerce-uikit/ui-ecommerce/css/ui.css" rel="stylesheet" type="text/css"/>
  <link href="../libs/bootstrap-ecommerce-uikit/ui-ecommerce/css/responsive.css" rel="stylesheet" media="only screen and (max-width: 1200px)"/>
  <script src="../libs/bootstrap-ecommerce-uikit/ui-ecommerce/js/script.js" type="text/javascript"></script>
  <!--- Bootstrap 4 File Style 2 --->
  <script type="text/javascript" src="../libs/bootstrap-filestyle-2.1.0/src/bootstrap-filestyle.min.js"> </script>
</head>

<body>
  <!-- Menú-->
  <header>
    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg bg-primary navbar-dark scrolling-navbar">
      <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="index.php">
          <img src="../imagen/logo-cc.png" height="30" alt="Logo CC">
        </a>
        <!-- Collapse -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left -->
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="../index.php"><i class="fa fa-home"></i> <b>Inicio</b>
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="#"><i class="fa fa-users"></i> <b>La Comunidad</b></a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="#"
                target="_blank"><i class="fa fa-phone"></i> <b>Contacto</b></a>
            </li>
          </ul>
          <!-- Right -->
          <?php  if (isset($_SESSION['active'])) :  ?>
          <ul class="navbar-nav nav-flex-icons">
            <li class="nav-item active">
              <a class="nav-link" href="#"><i class="fa fa-user"></i> <b>Bienvenido <?php echo $_SESSION['nombr_per']; ?> <?php echo $_SESSION['apeli_per']; ?></b></a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="admin_panel.php"><i class="fa fa-cogs"></i><b> Ir al Panel de Control </b></a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="usuario_salir.php"><i class="fa fa-sign-out-alt"></i> <b>Cerrar Sesión </b></a>
            </li>
          </ul>
          <?php endif ?>
          <?php  if (!isset($_SESSION['active'])) : ?>
          <ul class="navbar-nav nav-flex-icons">
            <li class="nav-item active">
              <a class="nav-link" href="usuario_inicio.php"><i class="fa fa-user"></i> <b>Iniciar Sesión</b></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../index.php" style="font-style: italic; font-weight: bold;"> Consejo Comunal Ambrosio Plaza </a>
            </li>
          </ul>
          <?php endif ?>
        </div>
      </div>
    </nav>
    <!-- Navbar -->
  </header>