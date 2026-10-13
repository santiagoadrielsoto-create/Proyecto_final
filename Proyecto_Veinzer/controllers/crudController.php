<?php
session_start();

// Si no inició sesión o NO es administrador, redirigir
if (!isset($_SESSION['usuario']) || strtolower($_SESSION['rol']) !== 'admin') {
    header("Location: ../views/home.php");
    exit();
}

include('../db/db.php');

// Lógica de eliminación si aplica
if (isset($_GET['eliminar'])) {
    $id = intval($_GET['eliminar']);
    mysqli_query($connection, "DELETE FROM usuarios WHERE id_cliente = '$id'");
    header("Location: crudController.php");
    exit();
}

// Consulta de usuarios
$query = "SELECT * FROM usuarios";
$resultado = mysqli_query($connection, $query);

include('../views/crudUsuarios.php');
mysqli_close($connection);
?>