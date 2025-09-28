<?php
include('conexion.php');
session_start();

if (!isset($_SESSION['usuario_id'])) {
    echo "Sesión no válida";
    exit;
}

$pregunta_id = $_POST['pregunta_id'] ?? 0;

if ($pregunta_id == 0) {
    echo "ID de pregunta no válido";
    exit;
}

$query_verificar = "SELECT p.id FROM preguntas p 
                    INNER JOIN examen e ON p.id_examen = e.id 
                    WHERE p.id = ? AND e.id_usuarios = ?";
$stmt_verificar = mysqli_prepare($conexion, $query_verificar);
mysqli_stmt_bind_param($stmt_verificar, "ii", $pregunta_id, $_SESSION['usuario_id']);
mysqli_stmt_execute($stmt_verificar);
$result_verificar = mysqli_stmt_get_result($stmt_verificar);

if (mysqli_num_rows($result_verificar) == 0) {
    echo "No tiene permisos para eliminar esta pregunta";
    exit;
}

$query = "DELETE FROM preguntas WHERE id = ?";
$stmt = mysqli_prepare($conexion, $query);
mysqli_stmt_bind_param($stmt, "i", $pregunta_id);

if (mysqli_stmt_execute($stmt)) {
    echo "Pregunta eliminada exitosamente";
} else {
    echo "Error al eliminar pregunta: " . mysqli_error($conexion);
}

mysqli_stmt_close($stmt);
mysqli_close($conexion);
?>