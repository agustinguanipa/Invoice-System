<?php 

require_once('includes/header.php'); 

$id = $_GET['id'];

?>

<head>
  <title>Noticias | Consejo Comunal Ambrosio Plaza</title>
</head>

<?php    
  $query="SELECT * FROM tab_not WHERE ident_not = '$id'";
  $resultado= $conexion->query($query);
  while($row=$resultado->fetch_assoc()){
    if ($row['image_not'] != 'default.jpg') 
    {
      $foto = '../imagen/uploads/'.$row['image_not'];
    }else{
      $foto = '../imagen/uploads/'.$row['image_not'];
    }
?>

<body>
  <div class="container text-center noticia-detalle">
    <div class="card">
      <img class="card-img-fluid image-size-detalle" src="<?php echo $foto; ?>" alt="Foto de la Noticia">
      <div class="card-body">
        <h2><b><?php echo $row['titul_not'] ?></b></h2>
        <hr>
        <p class="card-text"><?php echo $row['descr_not'] ?></p>
      </div>
      <div class="card-footer">
        <a class="btn btn-primary float-left" href="../index.php"><i class="fa fa-arrow-left"></i> Volver</a>
        <p class="card-text float-right"><small class="text-muted"><?php echo $row['fecpu_not'] ?></small></p>
      </div>
    </div> 
  </div>

</body>

<?php 
  }
?>

<?php require_once('includes/footer.php'); ?>