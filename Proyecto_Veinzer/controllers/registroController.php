<?php
session_start();
include('../db/db.php');

if (isset($_POST['registrar'])) {
    $usuario = mysqli_real_escape_string($connection, $_POST['usuario']);
    $correo = mysqli_real_escape_string($connection, $_POST['correo']);
    $telefono = mysqli_real_escape_string($connection, $_POST['telefono']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    $rol = 'cliente'; // Rol predeterminado

    // 1. Verificación de formato de correo electrónico en el backend
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('El correo electrónico no tiene un formato válido.'); window.location='../views/registrar.php';</script>";
        exit();
    }

    // 2. Comprobar si el correo ya está registrado
    $check_email = mysqli_query($connection, "SELECT * FROM usuarios WHERE correo = '$correo'");
    if (mysqli_num_rows($check_email) > 0) {
        echo "<script>alert('Este correo ya se encuentra registrado.'); window.location='../views/registrar.php';</script>";
        exit();
    }

    // 3. Insertar usuario usando 'contrasena' (columna real de la base de datos)
    $query = "INSERT INTO usuarios (usuario, correo, telefono, contrasena, rol) VALUES ('$usuario', '$correo', '$telefono', '$password', '$rol')";
    
    if (mysqli_query($connection, $query)) {
        echo "<script>alert('Registro exitoso. ¡Inicia sesión!'); window.location='../views/login.php';</script>";
    } else {
        echo "<script>alert('Error al registrar usuario: " . mysqli_error($connection) . "'); window.location='../views/registrar.php';</script>";
    }
}
mysqli_close($connection);
?>