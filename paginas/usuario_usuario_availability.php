<?php
  include_once("conexion.php");

  $usuario = urldecode($_POST['usuario']);
  $result = mysqli_query($conexion, "SELECT * FROM usuario WHERE usuario = '$usuario' LIMIT 1;");
  $num = mysqli_num_rows($result);

  if($num == 0){
      echo "true";
  } else {
      echo "false";
  }
  mysqli_close($conexion);
?>