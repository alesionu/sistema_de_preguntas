<?php
include('conexion.php');
session_start();

if (!isset($_SESSION['usuario_id'])) {
    die("Error: No tienes permiso para eliminar.");
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM examen WHERE id = $id AND id_usuarios = {$_SESSION['usuario_id']}";

    if ($conexion->query($sql) === TRUE) {
        header("Location: crearexamen.php?delete=success");
    } else {
        echo "Error al eliminar: " . $conexion->error;
    }
} else {
    echo "Falta el ID del examen.";
}
