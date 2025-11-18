<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="style.css">
</head>
<body class="login-body">

    <div class="login-card">
        <h2>Login</h2>
        <form id="id_form_login" enctype="multipart/form-data">
           
            <label class="form-label mt-2" for="input_usuario">Nombre de Usuario</label>
            <input class="form-control" type="text" name="usuario" id="input_usuario" required>
            
            
            <label class="form-label mt-3" for="input_password">Contraseña</label>
            <input class="form-control" type="password" name="password" id="input_password" required>
            
          
            <button id="btn_cargar_login" class="btn btn-success mt-4" type="submit">Login</button>

           
            <a href="registrar.php" class="btn btn-register mt-2">Registrarse</a>
        </form>
    </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="app.js"></script>
</body>
</html>