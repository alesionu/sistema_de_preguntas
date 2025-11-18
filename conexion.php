<?php

$conexion = mysqli_connect(
  'localhost', 'root', '', 'bd_gestion_examenes');
  
  if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

?>
