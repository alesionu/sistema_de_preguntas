
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Index</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>

<body>
        <body style="
        background-image: url('imagenes/biblioteca2.jpg'); 
        background-size: cover; 
        background-position: center; 
        background-repeat: no-repeat;
        height: 100vh;
        margin: 0;
    ">

    <style>
            html, body {
                height: 100%;
                margin: 0;
            }

            body {
                background-image: url('imagenes/biblioteca2.jpg');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
            }

            
            .centered-container {
                height: calc(100vh - 56px); 
                display: flex;
                justify-content: center;
                align-items: center;
            }

            
            .btn-start {
                font-size: 2.5rem;
                padding: 1.5rem 4rem;
                border-radius: 1rem;
                box-shadow: 0 8px 15px rgba(0,0,0,0.3);
                transition: transform 0.2s, box-shadow 0.2s;
            }

            .btn-start:hover {
                transform: translateY(-5px);
                box-shadow: 0 12px 20px rgba(0,0,0,0.4);
            }
        </style>
    </head>

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

    <div class="centered-container">
        <a href="crearexamen.php" class="btn btn-primary btn-start">Comenzar Examen</a>
    </div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="app.js"></script>
</body>

</html>