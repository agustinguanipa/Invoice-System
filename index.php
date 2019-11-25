<?php 
  session_start();

  require_once ("paginas/conexion.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <title>Inicio | Consejo Comunal Ambrosio Plaza</title>
  <meta name="description" content="Consejo Comunal Ambrosio Plaza | Comunidad de Ambrosio Plaza, San Cristóbal, Estado Táchira, Venezuela">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
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
  <script type="text/javascript" src="js/funciones.js"></script>
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

<body>
  <!-- Menú-->
  <header>
    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg bg-primary navbar-dark scrolling-navbar">
      <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="index.php">
          <img src="imagen/logo-cc.png" height="30" alt="Logo CC">
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
              <a class="nav-link" href="#"><i class="fa fa-home"></i> <b>Inicio</b>
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
              <a class="nav-link" href="paginas/admin_panel.php"><i class="fa fa-cogs"></i><b> Ir al Panel de Control </b></a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="paginas/usuario_salir.php"><i class="fa fa-sign-out-alt"></i> <b>Cerrar Sesión </b></a>
            </li>
          </ul>
          <?php endif ?>
          <?php  if (!isset($_SESSION['active'])) : ?>
          <ul class="navbar-nav nav-flex-icons">
            <li class="nav-item active">
              <a class="nav-link" href="paginas/usuario_inicio.php"><i class="fa fa-user"></i> <b>Iniciar Sesión</b></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php" style="font-style: italic; font-weight: bold;"> Consejo Comunal Ambrosio Plaza </a>
            </li>
          </ul>
          <?php endif ?>
        </div>
      </div>
    </nav>
    <!-- Navbar -->
  </header>
  <!--Main Navigation-->

  <!--Main Layout-->
  <main class="mt-5 pt-5">
    <div class="container justify-content-center">
      <!--Section: Jumbotron-->
      <div class="card" align="center">
        <div class="card-body index-background">
          <h2 class="card-title text-white"><b>Consejo Comunal Ambrosio Plaza</b></h2>
          <p class="card-text text-white"><b>Comunidad de Ambrosio Plaza Pueblo Nuevo</b></p>
          <p class="text-white">Información sobre la Comunidad, Acontecimientos, Eventos, Jornadas, entre otros.</p>
          <a href="#" class="btn btn-light btn-lg"> <b>¿Quíenes Somos? </b><i class="fas fa-users ml-2"></i></a>
        </div>
      </div>
      <!--Section: Jumbotron-->
      <p class="">
      <h2 align="center"><b>Noticias</b></h2>
      <hr class="my-3">

      <!--Section: Noticias-->

      <?php
        include("paginas/conexion.php");
         $perpage = 3;
          if(isset($_GET['page']) & !empty($_GET['page'])){
            $curpage = $_GET['page'];
          }else{
            $curpage = 1;
          }
          $start = ($curpage * $perpage) - $perpage;
          $PageSql = "SELECT * FROM tab_not WHERE statu_not = 1";
          $pageres = mysqli_query($conexion, $PageSql);
          $totalres = mysqli_num_rows($pageres);

          $endpage = ceil($totalres/$perpage);
          $startpage = 1;
          $nextpage = $curpage + 1;
          $previouspage = $curpage - 1;

          $ReadSql = "SELECT * FROM tab_not WHERE statu_not = 1 LIMIT $start, $perpage";
          $res = mysqli_query($conexion, $ReadSql);
      ?>

      <div class="container text-center">
        <div class="card-deck">
          <?php
              while($row = mysqli_fetch_assoc($res)){

                if ($row['image_not'] != 'default.jpg') 
                {
                  $foto = 'imagen/uploads/'.$row['image_not'];
                }else{
                  $foto = 'imagen/uploads/'.$row['image_not'];
                }
            ?>
          <div class="col-lg-4">
            <div class="card">
              <img  class="card-img-fluid image-size-index" src="<?php echo $foto; ?>" alt="Foto de la Noticia">
              <div class="card-body">
                <h4 class="card-title"><b><?php echo $row['titul_not'] ?></b></h4>
                <p class="card-text"><?php echo $row['desco_not'] ?></p>
                <p class="card-text float-left"><small class="text-muted"><?php echo $row['fecpu_not'] ?></small></p>
                <a href="paginas/noticia_detalle.php?id=<?php echo $row['ident_not']; ?>" class="btn btn-sm btn-primary float-right"><i class="fa fa-eye"></i> Leer Más</a>
              </div>
            </div>
          </div>
          <?php
              }
            ?>
        </div>
      </div>

      <br>

      <!--Pagination-->
      <nav aria-label="Page navigation">
        <ul class="pagination float-right">
        <?php if($curpage != $startpage){ ?>
          <li class="page-item">
            <a class="page-link" href="?page=<?php echo $startpage ?>" tabindex="-1" aria-label="Previous">
              <span aria-hidden="true">&laquo;</span>
              <span class="sr-only">First</span>
            </a>
          </li>
          <?php } ?>
          <?php if($curpage >= 2){ ?>
          <li class="page-item"><a class="page-link" href="?page=<?php echo $previouspage ?>"><?php echo $previouspage ?></a></li>
          <?php } ?>
          <li class="page-item active"><a class="page-link" href="?page=<?php echo $curpage ?>"><?php echo $curpage ?></a></li>
          <?php if($curpage != $endpage){ ?>
          <li class="page-item"><a class="page-link" href="?page=<?php echo $nextpage ?>"><?php echo $nextpage ?></a></li>
          <li class="page-item">
            <a class="page-link" href="?page=<?php echo $endpage ?>" aria-label="Next">
              <span aria-hidden="true">&raquo;</span>
              <span class="sr-only">Last</span>
            </a>
          </li>
          <?php } ?>
        </ul>
      </nav>
      <br>
    </div>
  </main>

  <br>
  <!--Main Layout-->

  <!--Footer-->
  <footer class="sticky-footer section-footer bg2 mt-2">
    <div class="container my-auto">
      <section class="footer-bottom row">
        <div class="col-sm-6"> 
          <p><b>Diseñado y Desarrollado por: </b><br>Dayana García, Jesus Carrillo, Isaac Clavijo y Carlos Guanipa<br>
          <small>Servicio Comunitario UNEFA Táchira Semestre 2-2019 Ingeniería de Sistemas</small></p>

        </div>
        <div class="col-sm-6">
          <p class="text-sm-right"><b>Consejo Comunal Ambrosio Plaza</b></p>
          <p class="text-sm-right">Copyright &copy 2019<br>
          </p>
        </div>
      </section>
  </footer>
  <!--/.Footer-->
  
</body>

</html>
