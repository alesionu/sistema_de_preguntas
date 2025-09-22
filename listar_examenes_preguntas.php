<?php
include('conexion.php');
session_start();


$usuario_id = $_SESSION['usuario_id'] ?? 0;


if ($usuario_id == 0) {
    echo '<li><span class="dropdown-item">No hay sesión activa</span></li>';
    exit;
}

$query = "SELECT id, nombre_examen FROM examen WHERE id_usuarios = ?";
$stmt = mysqli_prepare($conexion, $query);

if (!$stmt) {
    echo '<li><span class="dropdown-item">Error en prepared statement: ' . mysqli_error($conexion) . '</span></li>';
    exit;
}

mysqli_stmt_bind_param($stmt, "i", $usuario_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (!$result) {
    echo '<li><span class="dropdown-item">Query Failed: ' . mysqli_error($conexion) . '</span></li>';
    exit;
}

// Verificar si hay resultados
$count = mysqli_num_rows($result);
error_log("Exámenes encontrados para usuario $usuario_id: " . $count);

if ($count > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<li><a class="dropdown-item" data-id="'.$row['id'].'" href="#">'.$row['nombre_examen'].'</a></li>';
    }
} else {
    echo '<li><span class="dropdown-item">No hay exámenes disponibles</span></li>';
}

mysqli_stmt_close($stmt);
mysqli_close($conexion);
?>