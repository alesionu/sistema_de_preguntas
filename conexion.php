<?php

$conexion = mysqli_connect(
  'localhost', 'root', '', 'bd_gestion_examenes1');
  
  if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

?>
