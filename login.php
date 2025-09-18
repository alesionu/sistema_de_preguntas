<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <h2 class="display-4">Login</h2>
                
                <form id="id_form_login" enctype="multipart/form-data">
                    <!-- carga de nombre -->
                    <label class="form-label mt-4" for="input_usuario">Nombre de Usuario</label>
                    <br>
                    <input class="form-control" type="text" name="usuario" id="input_usuario" required>
                    
                    <!-- carga de contraseña -->
                    <label class="form-label mt-4" for="input_password">Contraseña</label>
                    <br>
                    <input class="form-control" type="password" name="password" id="input_password" required>
                    
                    <button id="btn_cargar_login" class="btn btn-success mt-3" type="submit">Login</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="app.js"></script>
</body>
</html>
