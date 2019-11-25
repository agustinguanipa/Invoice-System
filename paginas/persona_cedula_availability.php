<?php
  include_once("conexion.php");

  $cedul_per = urldecode($_POST['cedul_per']);
  $result = mysqli_query($conexion, "SELECT * FROM tab_per WHERE cedul_per = '$cedul_per' LIMIT 1;");
  $num = mysqli_num_rows($result);

  if($num == 0){
      echo "true";
  } else {
      echo "false";
  }
  mysqli_close($conexion);
?>