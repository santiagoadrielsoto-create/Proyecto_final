<?php
include('../db/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $contrasena = $_POST['contrasena'];
    $rol = 'cliente';

    // Verificar si el usuario ya existe
    $verificacion = mysqli_query($connection, "SELECT * FROM usuarios WHERE usuario = '$usuario'");

    if (mysqli_num_rows($verificacion) > 0) {
        echo "<script>alert('El nombre de usuario ya está en uso'); window.location='../views/registrar.php';</script>";
    } else {
        $insertar = "INSERT INTO usuarios (usuario, contrasena, correo, telefono, rol) VALUES ('$usuario', '$contrasena', '$correo', '$telefono', '$rol')";
        
        if (mysqli_query($connection, $insertar)) {
            echo "<script>alert('¡Registro exitoso!'); window.location='../views/login.php';</script>";
        } else {
            echo "Error al registrar: " . mysqli_error($connection);
        }
    }
}
mysqli_close($connection);
?>