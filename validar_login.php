<?php
include('conexion.php');
session_start(); 

if (isset($_POST['input_usuario']) && isset($_POST['input_password'])) {
    $usuario = $_POST['input_usuario'];
    $password = $_POST['input_password'];
    
    $query = "SELECT id, usuario, password FROM usuarios WHERE usuario = ?";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "s", $usuario);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $user_data = mysqli_fetch_assoc($result);
        
        if (password_verify($password, $user_data['password'])) {
            
          
            $_SESSION['id_usuario'] = $user_data['id']; 
            
            $_SESSION['usuario'] = $user_data['usuario'];
            
            echo "Login exitoso";
            exit; 
        } else {
            echo "incorrecto";
            exit;
        }
    } else {
        echo "incorrecto";
        exit;
    }
}

mysqli_close($conexion);
?>