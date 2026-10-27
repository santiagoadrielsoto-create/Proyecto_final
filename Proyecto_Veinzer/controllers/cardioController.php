<?php
session_start();

if (!isset($_SESSION['usuario']) || !isset($_SESSION['id_usuario'])) {
    header("Location: ../views/login.php");
    exit();
}

include('../db/db.php');
$id_usuario = intval($_SESSION['id_usuario']);

// Consultar datos físicos
$query = mysqli_query($connection, "SELECT * FROM datos_fisicos WHERE id_usuario = '$id_usuario'");
$datos_fisicos = mysqli_fetch_assoc($query);

include('../views/cardio.php');
mysqli_close($connection);
?>