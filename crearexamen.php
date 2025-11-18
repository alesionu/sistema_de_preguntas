<?php
session_start();
include('conexion.php');


if (!isset($_SESSION['id_usuario'])) {
    header('Location: login.php');
    exit;
}

$id_usuario = $_SESSION['id_usuario'];
$mensaje = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_examen = $_POST['nombre_examen'];
    
    $sql = "INSERT INTO examen (id_usuarios, nombre_examen) VALUES (?, ?)";
    $stmt = $conexion->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("is", $id_usuario, $nombre_examen);
        
        if ($stmt->execute()) {
            $mensaje = "<div class='alert alert-success'>Examen creado con éxito</div>";
        } else {
            $mensaje = "<div class='alert alert-danger'>Error al crear el examen: " . $stmt->error . "</div>";
        }
        $stmt->close();
    } else {
        $mensaje = "<div class='alert alert-danger'>Error al preparar la consulta: " . $conexion->error . "</div>";
    }
}

$query_select = "SELECT id, nombre_examen, status FROM examen WHERE id_usuarios = ?";
$stmt_select = $conexion->prepare($query_select);

if ($stmt_select) {
    $stmt_select->bind_param("i", $id_usuario);
    $stmt_select->execute();
    $result = $stmt_select->get_result();
} else {
    $result = null;
    echo "Error al preparar la consulta de selección: " . $conexion->error;
}

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
                
                <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="crearexamen.php">Examen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="preguntas.php">Preguntas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="sorteo_preguntas.php">Sorteo de Preguntas</a>
                    </li>
                </ul>

                <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                     <li class="nav-item">
                        <a class="nav-link" href="cerrar_sesion.php">Cerrar Sesión</a>
                     </li>
                </ul>

            </div>
        </div>
    </nav>

    <div class="container-sm">
        <br>

        <h2 class="mb-4">Crear Examen</h2>
        
        <?php 
        echo $mensaje; 
        
        if (isset($_GET['delete']) && $_GET['delete'] == 'success'): 
        ?>
            <div class="alert alert-success">Examen eliminado correctamente.</div>
        <?php endif; ?>

        <form method="POST" action="crearexamen.php"> 
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
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['nombre_examen'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td>
                                <?= $row['status'] == 1 ? "<span class='text-success'>Activo</span>" : "<span class='text-danger'>Inactivo</span>" ?>
                            </td>
                            <td>
                                <a href="editar_examen.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Editar</a>

                                <?php if ($row['status'] == 1): ?>
                                    <a href="baja_examen.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm">Baja</a>
                                <?php else: ?>
                                    <a href="alta_examen.php?id=<?= $row['id'] ?>" class="btn btn-success btn-sm">Alta</a>
                                <?php endif; ?>

                                <a href="eliminar_examen.php?id=<?= $row['id'] ?>" class="btn btn-outline-danger btn-sm"
                                onclick="return confirm('¿Estás seguro de eliminar este examen? Se perderá permanentemente.');">
                                Eliminar
                                </a>
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
<?php 
if (isset($stmt_select)) {
    $stmt_select->close();
}
$conexion->close(); 
?>