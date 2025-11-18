<?php
session_start();
include 'conexion.php';

if (!isset($_SESSION['id_usuario'])) {
    echo '<li><span class="dropdown-item">Error: Sesión no válida</span></li>';
    exit; 
}

$usuario_id = $_SESSION['id_usuario'];

$sql = "SELECT id, nombre_examen FROM examen WHERE id_usuarios = ? ORDER BY nombre_examen";
$stmt = mysqli_prepare($conexion, $sql);

if (!$stmt) {
    error_log('Error en prepared statement: ' . mysqli_error($conexion));
    echo '<li><span class="dropdown-item">Error al cargar</span></li>';
    mysqli_close($conexion);
    exit;
}

mysqli_stmt_bind_param($stmt, 'i', $usuario_id);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($resultado) > 0) {
    while($examen = mysqli_fetch_assoc($resultado)) {
        echo '<li><a class="dropdown-item" href="#" data-id="' . $examen['id'] . '">' . htmlspecialchars($examen['nombre_examen']) . '</a></li>';
    }
} else {
    echo '<li><span class="dropdown-item">No tienes exámenes disponibles</span></li>';
}

mysqli_stmt_close($stmt);
mysqli_close($conexion);
?>