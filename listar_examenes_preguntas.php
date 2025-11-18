<?php
session_start();
include('conexion.php');

header('Content-Type: text/html; charset=UTF-8');

$usuario_id = $_SESSION['id_usuario'] ?? 0;



$query = "SELECT id, nombre_examen FROM examen WHERE id_usuarios = ? ORDER BY nombre_examen ASC";
$stmt = mysqli_prepare($conexion, $query);

if (!$stmt) {
    error_log('Error en prepared statement: ' . mysqli_error($conexion));
    echo '<li><span class="dropdown-item">Error al cargar exámenes</span></li>';
    exit;
}

mysqli_stmt_bind_param($stmt, "i", $usuario_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (!$result) {
    error_log('Query Failed: ' . mysqli_error($conexion));
    echo '<li><span class="dropdown-item">Error al cargar exámenes</span></li>';
    exit;
}

$count = mysqli_num_rows($result);


    $output = '';
    while ($row = mysqli_fetch_assoc($result)) {
        $id = htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8');
        $nombre = htmlspecialchars($row['nombre_examen'], ENT_QUOTES, 'UTF-8');
        $output .= '<li><a class="dropdown-item" data-id="' . $id . '" href="#">' . $nombre . '</a></li>';
    }
    echo $output;


mysqli_stmt_close($stmt);
mysqli_close($conexion);
?>