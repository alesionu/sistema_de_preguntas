<?php
include('conexion.php');
session_start();

if (isset($_POST['input_usuario']) && isset($_POST['input_password'])) {
    $usuario = $_POST['input_usuario'];
    $password = $_POST['input_password'];
    
    // Buscar el usuario en la base de datos
    $query = "SELECT id, usuario FROM usuarios WHERE usuario = ? AND password = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "ss", $usuario, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $user_data = mysqli_fetch_assoc($result);
        
        // Crear la sesión
        $_SESSION['usuario_id'] = $user_data['id'];
        $_SESSION['usuario'] = $user_data['usuario'];
        
        echo "Login exitoso";
    } else {
        echo "incorrecto";
    }
}

$connection->close();
?>