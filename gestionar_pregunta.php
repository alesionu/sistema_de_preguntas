<?php
include('conexion.php');
session_start();

// Forzar la salida como JSON
header('Content-Type: application/json');

// Verificar que hay sesión activa
if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(["success" => false, "message" => "Sesión no válida"]);
    exit;
}

$texto_pregunta = $_POST['texto_pregunta'] ?? '';
$examen_id = $_POST['examen_id'] ?? 0;
$pregunta_id = $_POST['pregunta_id'] ?? '';

if (empty($texto_pregunta) || $examen_id == 0) {
    echo json_encode(["success" => false, "message" => "Datos incompletos"]);
    exit;
}

// Verificar que el examen pertenece al usuario logueado
$query_verificar = "SELECT id FROM examen WHERE id = ? AND id_usuarios = ?";
$stmt_verificar = mysqli_prepare($conexion, $query_verificar);
mysqli_stmt_bind_param($stmt_verificar, "ii", $examen_id, $_SESSION['usuario_id']);
mysqli_stmt_execute($stmt_verificar);
$result_verificar = mysqli_stmt_get_result($stmt_verificar);

if (mysqli_num_rows($result_verificar) == 0) {
    echo json_encode(["success" => false, "message" => "No tiene permisos para modificar este examen"]);
    exit;
}

// Si pregunta_id está vacío, es una nueva pregunta (INSERT)
if (empty($pregunta_id)) {
    $query = "INSERT INTO preguntas (id_examen, texto_pregunta) VALUES (?, ?)";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "is", $examen_id, $texto_pregunta);

    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(["success" => true, "message" => "Pregunta creada exitosamente"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error al crear pregunta: " . mysqli_error($conexion)]);
    }
} else {
    // Es una edición (UPDATE)
    $query_verificar_pregunta = "SELECT p.id FROM preguntas p 
                                 INNER JOIN examen e ON p.id_examen = e.id 
                                 WHERE p.id = ? AND e.id_usuarios = ?";
    $stmt_verificar_pregunta = mysqli_prepare($conexion, $query_verificar_pregunta);
    mysqli_stmt_bind_param($stmt_verificar_pregunta, "ii", $pregunta_id, $_SESSION['usuario_id']);
    mysqli_stmt_execute($stmt_verificar_pregunta);
    $result_verificar_pregunta = mysqli_stmt_get_result($stmt_verificar_pregunta);

    if (mysqli_num_rows($result_verificar_pregunta) == 0) {
        echo json_encode(["success" => false, "message" => "No tiene permisos para modificar esta pregunta"]);
        exit;
    }

    $query = "UPDATE preguntas SET texto_pregunta = ? WHERE id = ?";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "si", $texto_pregunta, $pregunta_id);

    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(["success" => true, "message" => "Pregunta actualizada exitosamente"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error al actualizar pregunta: " . mysqli_error($conexion)]);
    }
}

mysqli_stmt_close($stmt);
mysqli_close($conexion);
?>
