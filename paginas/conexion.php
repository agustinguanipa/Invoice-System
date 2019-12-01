<?php 

$host = 'localhost';
$user = 'root';
$pw = 'root';
$bd = 'Facturacion';

$conexion = @mysqli_connect($host,$user,$pw,$bd);

if (!$conexion) {
    echo 'Error en la conexion!';
}
?>