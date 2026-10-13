<?php
include('../db/db.php');

if (isset($_POST['registrar'])) {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['password'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $rol = 'cliente'; // Por defecto todos son clientes al registrarse

    // Cambiamos 'contrasenia' por 'contrasena' para que coincida con tu tabla en la BD
    $query = "INSERT INTO usuarios (usuario, contrasena, correo, telefono, rol) VALUES ('$usuario', '$contrasena', '$correo', '$telefono', '$rol')";
    
    if (mysqli_query($connection, $query)) {
        header("Location: ../views/login.php");
        exit();
    } else {
        echo "Error al registrar el usuario: " . mysqli_error($connection);
    }
}
?>