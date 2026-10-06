<?php
session_start();
include('../db/db.php');

if (isset($_POST['usuario']) && isset($_POST['contrasenia'])) {
    $usuario = $_POST['usuario'];
    $contrasenia = $_POST['contrasenia'];

    $query = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND contrasenia = '$contrasenia'";
    $resultado = mysqli_query($connection, $query);

    if ($row = mysqli_fetch_assoc($resultado)) {
        // --- GUARDA AMBAS VARIABLES AQUÍ ---
        $_SESSION['id_usuario'] = $row['id_cliente']; // El ID numérico para las tablas relacionales (foro, etc.)
        $_SESSION['usuario'] = $row['usuario'];     // El nombre para mostrar en tu perfil

        // Redirigimos al perfil
        header("Location: miPerfilController.php");
        exit();
    } else {
        echo "Datos incorrectos.";
    }
}
?>