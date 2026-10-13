<?php
session_start();
include('../db/db.php');

// Procesar la actualización cuando se envía el formulario
if (isset($_POST['actualizar'])) {
    $id = intval($_POST['id']);
    $usuario = mysqli_real_escape_string($connection, $_POST['usuario']);
    $correo = mysqli_real_escape_string($connection, $_POST['correo']);
    $telefono = mysqli_real_escape_string($connection, $_POST['telefono']);

    $query_update = "UPDATE usuarios SET usuario = '$usuario', correo = '$correo', telefono = '$telefono' WHERE id_cliente = '$id'";
    mysqli_query($connection, $query_update);

    header("Location: crudController.php");
    exit();
}

// Cargar los datos del usuario a modificar
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "SELECT * FROM usuarios WHERE id_cliente = '$id'";
    $resultado = mysqli_query($connection, $query);
    $usuario_actual = mysqli_fetch_assoc($resultado);

    include('../views/editarUsuario.php');
}
?>