<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sorteo de Preguntas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="imagenes/logo.jpg" type="image/jpg">
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
                        <a class="nav-link" href="examen.php">Examen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="preguntas.php">Preguntas</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h1>Sorteo de Preguntas</h1>
        <br>
        <h2>Seleccione el examen</h2>

        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="btn_desplegable_examen"
                data-bs-toggle="dropdown" aria-expanded="false">
                Examenes
            </button>

            <ul class="dropdown-menu" id="listaExamenes" aria-labelledby="btn_desplegable_examen">
                <li><span class="dropdown-item">Cargando...</span></li>
            </ul>
        </div>

        <br>
        <!-- Apartado de ingreso de cantida de preguntas para el examen determinado -->
        <form id="form_cantidad_preguntas" action="">
            <label for="">Ingresar la cantidad de preguntas</label>
            <br>
            <input type="text">
        </form>



        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- Bootstrap 5 Bundle con Popper incluido -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Tu archivo JavaScript -->
        <script src="app.js"></script>
</body>

</html>