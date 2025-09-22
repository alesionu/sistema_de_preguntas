<?php
include 'conexion.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "UPDATE examen SET status = 0 WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $stmt->close();
        $conexion->close();
        header("Location: crearexamen.php?ok=baja");
        exit;
    } else {
        $stmt->close();
        $conexion->close();
        header("Location: crearexamen.php?error=baja");
        exit;
    }
} else {
    header("Location: crearexamen.php?error=id");
    exit;
}
?>