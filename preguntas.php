<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preguntas</title>

    <!-- Bootstrap 5 CSS -->
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
        <h1>Gestión de preguntas</h1>
        <br>
        <h2>Seleccione el examen</h2>

        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="btn_desplegable_examen"
                data-bs-toggle="dropdown" aria-expanded="false">
                Examenes
            </button>

            <ul class="dropdown-menu" id="listaExamenes" aria-labelledby="btn_desplegable_examen">
                <!-- Los exámenes se cargarán aquí por AJAX -->
                <li><span class="dropdown-item">Cargando...</span></li>
            </ul>
        </div>

        <!-- Sección que aparecerá cuando se seleccione un examen -->
        <div id="seccionPreguntas" style="display: none;" class="mt-4">
            <hr>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 id="tituloExamen">Preguntas de: </h3>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalPregunta" onclick="limpiarModal()">
                    <i class="fas fa-plus"></i> Nueva Pregunta
                </button>
            </div>

            <!-- Tabla de preguntas -->
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Pregunta</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tablaPreguntas">
                        <!-- Las preguntas se cargarán aquí -->
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal para agregar/editar preguntas -->
        <div class="modal fade" id="modalPregunta" tabindex="-1" aria-labelledby="modalPreguntaLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalPreguntaLabel">Nueva Pregunta</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="formPregunta">
                        <div class="modal-body">
                            <input type="hidden" id="preguntaId" name="pregunta_id">
                            <input type="hidden" id="examenId" name="examen_id">
                            
                            <div class="mb-3">
                                <label for="textoPregunta" class="form-label">Texto de la pregunta</label>
                                <textarea class="form-control" id="textoPregunta" name="texto_pregunta" rows="3" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary" id="btnGuardarPregunta">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <!-- jQuery - IMPORTANTE: debe ir antes de Bootstrap y app.js -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap 5 Bundle con Popper incluido -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Tu archivo JavaScript -->
    <script src="app.js"></script>
</body>

</html>