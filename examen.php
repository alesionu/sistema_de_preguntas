<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examenes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="imagenes/logo.jpg" type="image/jpg">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-info">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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

    <div class="container mt-5 mb-5 flex-grow-1">
        <div>
            <i class="bi bi-columns-gap"></i>
            <h2 class="mb-4 text-center">Examenes</h2>
        </div>
        <div class="row row-cols-1 row-cols-md-2 g-4">

            
            <div class="col">
                <div class="card h-100">
                  <img src="imagenes/programacion.jpg" class="card-img-top" alt="Examen 2">
                    <div class="card-body">
                        <h5 class="card-title">Programacion</h5>
                        <p class="card-text">Pon a prueba tus conocimientos en programacion.</p>
                        <a href="programacion.php" class="btn btn-info">Comenzar examen</a>
                    </div>
                </div>
            </div>

            
            <div class="col">
                <div class="card h-100">
                  <img src="imagenes/matematica.jpg" class="card-img-top" alt="Examen 2">
                  
                    <div class="card-body">
                        <h5 class="card-title">Matematicas</h5>
                        <p class="card-text">Pon a prueba tus conocimientos en matematicas.</p>
                        <a href="matematicas.php" class="btn btn-success">Comenzar examen</a>
                    </div>
                </div>
            </div>

           
            <div class="col">
                <div class="card h-100">
                  <img src="imagenes/geografia.jpg" class="card-img-top" alt="Examen 2">
                    <div class="card-body">
                        <h5 class="card-title">Geografia</h5>
                        <p class="card-text">Pon a prueba tus conocimientos en geografia.</p>
                        <a href="geografia.php" class="btn btn-primary">Comenzar examen</a>
                    </div>
                </div>
            </div>


            <div class="col">
                <div class="card h-100">
                  <img src="imagenes/arte.jpg" class="card-img-top" alt="Examen 2">
                    <div class="card-body">
                        <h5 class="card-title">Arte</h5>
                        <p class="card-text">Pon a prueba tus conocimientos en arte.</p>
                        <a href="arte.php" class="btn btn-warning">Comenzar examen</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="app.js"></script>
</body>
</html>