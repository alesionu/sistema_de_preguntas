<?php
include ('conexion.php');


// Si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_usuario = $_POST['id_usuario'];
    $nombre_examen = $_POST['nombre_examen'];


    // Insertar en la base de datos
    $sql = "INSERT INTO examen (id_usuarios, nombre_examen) VALUES ('$id_usuario', '$nombre_examen')";

    if ($conexion->query($sql) === TRUE) {
        echo "<p style='color:green;'>Examen creado con éxito</p>";
    } else {
        echo "Error: " . $conexion->error;
    }
}

// Obtener exámenes guardados
$result = $conexion->query("SELECT id, id_usuarios, nombre_examen, status FROM examen");

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
            <a class="navbar-brand" href="index.php">Gestion de Examenes</a>
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
    </nav>


      <div class="container-sm">
        <br>

       <h2 class="mb-4">Crear Examen</h2>

        <!-- Formulario -->
        <form method="POST" action="">
            <div class="form-group">
                <label for="id_usuario">ID Usuario</label>
                <input type="number" class="form-control" id="id_usuario" name="id_usuario" required>
            </div>

            <div class="form-group">
                <label for="nombre_examen">Nombre del Examen</label>
                <input type="text" class="form-control" id="nombre_examen" name="nombre_examen" required>
            </div>

            <button type="submit" class="btn btn-primary">Guardar Examen</button>
        </form>

        <hr>

        <!-- Mostrar exámenes -->
        <h3>Exámenes guardados</h3>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>ID Usuario</th>
                    <th>Nombre del Examen</th>
                    <th>status</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['id_usuarios'] ?></td>
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
                    <td colspan="5">No hay exámenes registrados</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>

      </div>
       


    </body>

</html>

<?php $conexion->close(); ?>