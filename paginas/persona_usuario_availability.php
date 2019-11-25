<?php
  include_once("conexion.php");

  $usuar_per = urldecode($_POST['usuar_per']);
  $result = mysqli_query($conexion, "SELECT * FROM tab_per WHERE usuar_per = '$usuar_per' LIMIT 1;");
  $num = mysqli_num_rows($result);

  if($num == 0){
      echo "true";
  } else {
      echo "false";
  }
  mysqli_close($conexion);
?>