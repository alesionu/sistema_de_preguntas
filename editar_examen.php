<?php
include('conexion.php');
session_start();

// Verificar si hay sesión activa
if (!isset($_SESSION['usuario_id'])) {
    die("Error: Debes iniciar sesión para editar un examen.");
}

$id_examen = $_GET['id'];

// Obtener datos del examen
$result = $conexion->query("SELECT nombre_examen FROM examen WHERE id = $id_examen AND id_usuarios = {$_SESSION['usuario_id']}");

if ($result->num_rows == 0) {
    die("Error: No puedes editar este examen.");
}

$row = $result->fetch_assoc();

// Si se envió el formulario para editar
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nuevo_nombre = $_POST['nombre_examen'];

    $sql = "UPDATE examen SET nombre_examen = '$nuevo_nombre' WHERE id = $id_examen";

    if ($conexion->query($sql) === TRUE) {
        header("Location: crearexamen.php?edit=success");
        exit();
    } else {
        echo "Error: " . $conexion->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Examen</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Editar Examen</h2>

        <form method="POST">
            <div class="form-group">
                <label for="nombre_examen">Nuevo Nombre del Examen</label>
                <input type="text" class="form-control" id="nombre_examen" name="nombre_examen" value="<?= $row['nombre_examen'] ?>" required>
            </div>

            <button type="submit" class="btn btn-success">Guardar Cambios</button>
            <a href="crearexamen.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>
