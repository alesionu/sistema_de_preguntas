<?php
include('conexion.php');
session_start();



$id_usuario = $_SESSION['usuario_id'];  

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_examen = $_POST['nombre_examen'];
    
    $sql = "INSERT INTO examen (id_usuarios, nombre_examen) VALUES ('$id_usuario', '$nombre_examen')";

    if ($conexion->query($sql) === TRUE) {
        echo "<p style='color:green;'>Examen creado con éxito</p>";
    } else {
        echo "Error: " . $conexion->error;
    }
}

$result = $conexion->query("SELECT id, nombre_examen, status FROM examen WHERE id_usuarios = '$id_usuario'");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Crear Examen</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-info">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Gestión de Exámenes</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="crearexamen.php">Examen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="preguntas.php">Preguntas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="sorteo_preguntas.php">Sorteo de Preguntas</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-sm">
        <br>

        <h2 class="mb-4">Crear Examen</h2>

        <form method="POST" action="">
            <div class="form-group">
                <label for="nombre_examen">Nombre del Examen</label>
                <input type="text" class="form-control" id="nombre_examen" name="nombre_examen" required>
            </div>

            <button type="submit" class="btn btn-primary">Guardar Examen</button>
        </form>

        <hr>

        <h3>Mis Exámenes</h3>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Nombre del Examen</th>
                    <th>Status</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['nombre_examen'] ?></td>
                            <td>
                                <?= $row['status'] == 1 ? "<span class='text-success'>Activo</span>" : "<span class='text-danger'>Inactivo</span>" ?>
                            </td>
                            <td>
                                <?php if ($row['status'] == 1): ?>
                                    <a href="baja_examen.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm">Baja</a>
                                <?php else: ?>
                                    <a href="alta_examen.php?id=<?= $row['id'] ?>" class="btn btn-success btn-sm">Alta</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">No tienes exámenes registrados</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>

</html>

<?php $conexion->close(); ?>