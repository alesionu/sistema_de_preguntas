<?php
include('conexion.php');

if (isset($_POST['input_usuario']) && isset($_POST['input_password'])) {
    $usuario = $_POST['input_usuario'];
    $password = $_POST['input_password'];
    
    $query = "INSERT INTO usuarios(usuario, password) VALUES ('$usuario', '$password')";
    $result = mysqli_query($connection, $query);
    
    if ($result) {
        echo "Usuario guardado exitosamente";
    } else {
        echo "Error al guardar usuario";
    }
}

$connection->close();
?>