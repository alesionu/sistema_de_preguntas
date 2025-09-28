<?php
include 'conexion.php';

session_start();

header('Content-Type: application/json');

try {
    if (!isset($_SESSION['usuario_id'])) {
        echo json_encode([
            'success' => false,
            'error' => 'Usuario no autenticado'
        ]);
        exit;
    }
    
    if (!isset($_POST['examen_id']) || !isset($_POST['cantidad'])) {
        echo json_encode([
            'success' => false,
            'error' => 'Parámetros faltantes'
        ]);
        exit;
    }
    
    $examen_id = intval($_POST['examen_id']);
    $cantidad = intval($_POST['cantidad']);
    $usuario_id = $_SESSION['usuario_id'];
    
    if ($cantidad <= 0) {
        echo json_encode([
            'success' => false,
            'error' => 'La cantidad debe ser mayor a 0'
        ]);
        exit;
    }
    
    $sql_verificar = "SELECT id FROM examen WHERE id = ? AND id_usuarios = ?";
    $stmt_verificar = mysqli_prepare($conexion, $sql_verificar);
    mysqli_stmt_bind_param($stmt_verificar, 'ii', $examen_id, $usuario_id);
    mysqli_stmt_execute($stmt_verificar);
    $resultado_verificar = mysqli_stmt_get_result($stmt_verificar);
    
    if (mysqli_num_rows($resultado_verificar) == 0) {
        echo json_encode([
            'success' => false,
            'error' => 'No tienes permisos para acceder a este examen'
        ]);
        exit;
    }
    
    $sql = "SELECT p.id, p.texto_pregunta FROM preguntas p 
            INNER JOIN examen e ON p.id_examen = e.id 
            WHERE p.id_examen = ? AND e.id_usuarios = ? 
            ORDER BY RAND() LIMIT ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, 'iii', $examen_id, $usuario_id, $cantidad);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    
    $preguntas = [];
    while ($row = mysqli_fetch_assoc($resultado)) {
        $preguntas[] = [
            'id' => $row['id'],
            'pregunta' => $row['texto_pregunta']
        ];
    }
    
    if (count($preguntas) == 0) {
        echo json_encode([
            'success' => false,
            'error' => 'No hay preguntas disponibles para este examen'
        ]);
        exit;
    }
    
    if (count($preguntas) < $cantidad) {
        echo json_encode([
            'success' => true,
            'preguntas' => $preguntas,
            'mensaje' => 'Solo se encontraron ' . count($preguntas) . ' preguntas de las ' . $cantidad . ' solicitadas'
        ]);
    } else {
        echo json_encode([
            'success' => true,
            'preguntas' => $preguntas
        ]);
    }
    
    mysqli_stmt_close($stmt_verificar);
    mysqli_stmt_close($stmt);
    mysqli_close($conexion);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'error' => 'Error interno del servidor'
    ]);
}
?>