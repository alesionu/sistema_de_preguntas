<?php
include('conexion.php');

$usuario = $_POST['usuario'];
$password = $_POST['password'];

$stmt = $conexion->prepare("SELECT id FROM usuarios WHERE usuario = ?");
$stmt->bind_param("s", $usuario);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo '
        <script>
        alert("El nombre de usuario ya está siendo utilizado");
        location.href = "registrar.php";
        </script>
    ';
    exit;
}
$stmt->close();

$hash_password = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conexion->prepare("INSERT INTO usuarios (usuario, password) VALUES (?, ?)");
$stmt->bind_param("ss", $usuario, $hash_password);

if ($stmt->execute()) {
    echo '
    <script>
        alert("Registro exitoso");
        location.href = "login.php";
    </script>
    ';
} else {
    echo '
    <script>
        alert("Error al registrar el usuario");
        location.href = "registrar.php";
    </script>
    ';
}

$stmt->close();
$conexion->close();
?>
