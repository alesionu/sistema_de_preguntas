<?php
session_start(); 

if (!isset($_SESSION['id_usuario'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Index</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
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
                
                <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                     <li class="nav-item">
                        <a class="nav-link" href="cerrar_sesion.php">Cerrar Sesión</a>
                     </li>
                </ul>

            </div>
        </div>
    </nav>

    <div class="centered-container">
        <a href="crearexamen.php" class="btn btn-primary btn-start">Comenzar Examen</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="app.js"></script>
</body>
</html>