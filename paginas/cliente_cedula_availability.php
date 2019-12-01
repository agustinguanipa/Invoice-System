<?php
  include_once("conexion.php");

  $cedula = urldecode($_POST['cedula']);
  $result = mysqli_query($conexion, "SELECT * FROM cliente WHERE cedula = '$cedula' LIMIT 1;");
  $num = mysqli_num_rows($result);

  if($num == 0){
      echo "true";
  } else {
      echo "false";
  }
  mysqli_close($conexion);
?>