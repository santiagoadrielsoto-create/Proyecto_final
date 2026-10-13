<?php
session_start();
include('../db/db.php');

if (isset($_POST['usuario']) && isset($_POST['password'])) {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['password'];

    // Usamos 'contrasena' en la consulta
    $query = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND contrasena = '$contrasena'";
    $resultado = mysqli_query($connection, $query);

    if ($row = mysqli_fetch_assoc($resultado)) {
        $_SESSION['id_usuario'] = $row['id_cliente']; 
        $_SESSION['usuario'] = $row['usuario'];     
        $_SESSION['rol'] = $row['rol']; 

        header("Location: miPerfilController.php");
        exit();
    } else {
        echo "Datos incorrectos.";
    }
}
?>