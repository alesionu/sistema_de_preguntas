<?php
session_start(); // <-- ¡ESTA DEBE SER LA LÍNEA 1!
include('conexion.php');

// Comprobar la variable NUEVA ('id_usuario')
if (!isset($_SESSION['id_usuario'])) {
    echo '<tr><td colspan="3" class="text-center text-danger">Error: Sesión no válida (Reinicie la página)</td></tr>';
    exit;
}

// Usar la variable NUEVA
$id_usuario = $_SESSION['id_usuario'];
$examen_id = $_GET['examen_id'] ?? 0;

if ($examen_id == 0) {
    echo '<tr><td colspan="3">ID de examen no válido</td></tr>';
    exit;
}

// Usar la variable NUEVA en la consulta de verificación
$query_verificar = "SELECT id FROM examen WHERE id = ? AND id_usuarios = ?";
$stmt_verificar = mysqli_prepare($conexion, $query_verificar);
mysqli_stmt_bind_param($stmt_verificar, "ii", $examen_id, $id_usuario);
mysqli_stmt_execute($stmt_verificar);
$result_verificar = mysqli_stmt_get_result($stmt_verificar);

if (mysqli_num_rows($result_verificar) == 0) {
    echo '<tr><td colspan="3">No tiene permisos para ver este examen</td></tr>';
    exit;
}

// El resto de tu código
$query = "SELECT id, texto_pregunta FROM preguntas WHERE id_examen = ? ORDER BY id";
$stmt = mysqli_prepare($conexion, $query);
mysqli_stmt_bind_param($stmt, "i", $examen_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td><span class="badge bg-primary">' . $row['id'] . '</span></td>';
        echo '<td>' . htmlspecialchars($row['texto_pregunta']) . '</td>';
        echo '<td>';
        echo '<button class="btn btn-sm btn-outline-warning me-2" onclick="editarPregunta(' . $row['id'] . ', \'' . addslashes(htmlspecialchars($row['texto_pregunta'])) . '\')" title="Editar pregunta">';
        echo ' Editar';
        echo '</button>';
        echo '<button class="btn btn-sm btn-outline-danger" onclick="eliminarPregunta(' . $row['id'] . ')" title="Eliminar pregunta">';
        echo ' Eliminar';
        echo '</button>';
        echo '</td>';
        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="3" class="text-center text-muted">
            No hay preguntas para este examen.<br>
            <small>Haga clic en "Nueva Pregunta" para agregar la primera.</small>
          </td></tr>';
}

mysqli_stmt_close($stmt_verificar);
mysqli_stmt_close($stmt);
mysqli_close($conexion);
?>