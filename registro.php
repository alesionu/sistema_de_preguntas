<?php 
include ('conexion.php');
   
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];
    $gmail = $_POST['gmail'];
    $telefono = $_POST['telefono'];

$verficacion = mysqli_query($conexion, "SELECT * FROM registro WHERE usuario = '$usuario'");
$r = mysqli_num_rows($verficacion);

if ($r > 0) {

    echo '
        <script>
        alert("El nombre de usuario ya esta siendo utilizado");
        location.href = "registrar.php";
        </script>
    ';
exit;
}

$insertar = mysqli_query($conexion, "INSERT INTO registro (usuario, contraseña, gmail, telefono)

VALUES ('$usuario', '$contraseña', '$gmail', '$telefono' )" );

if ($insertar){
    echo '
    <script>
        alert("Registro exitoso");
        location.href = "login.php";
    </script>
    ';

}
?>