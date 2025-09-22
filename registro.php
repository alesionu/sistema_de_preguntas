<?php 
include ('conexion.php');
   
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];


$verficacion = mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario = '$usuario'");
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

$insertar = mysqli_query($conexion, "INSERT INTO usuarios (usuario, password)

VALUES ('$usuario', '$password' )" );

if ($insertar){
    echo '
    <script>
        alert("Registro exitoso");
        location.href = "login.php";
    </script>
    ';

}
?>