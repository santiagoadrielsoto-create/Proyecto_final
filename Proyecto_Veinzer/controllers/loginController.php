<?php
include('../db/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    $query = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND contrasena = '$password'";
    $resultado = mysqli_query($connection, $query);

    if (mysqli_num_rows($resultado) == 1) {
        session_start();
        $_SESSION['usuario'] = $usuario;
        header("Location: ../views/mi_perfil.php");
    } else {
        echo "<script>alert('Usuario o contraseña incorrectos'); window.location='../views/login.php';</script>";
    }
}
mysqli_close($connection);
?>