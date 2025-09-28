<?php
include 'conexion.php';

session_start();


$usuario_id = $_SESSION['usuario_id'];

$sql = "SELECT id, nombre_examen FROM examen WHERE id_usuarios = ? ORDER BY nombre_examen";
$stmt = mysqli_prepare($conexion, $sql);
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