<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../views/login.php");
    exit();
}

include("../db/db.php");

$id_usuario = $_SESSION['id_usuario'];

// Consulta segura para obtener los datos actualizados del usuario en sesión
$query_user = mysqli_query($connection, "SELECT * FROM usuarios WHERE id_cliente = '$id_usuario'");
$perfil = mysqli_fetch_assoc($query_user);

// Consultar publicaciones y comentarios propios para mostrarlos en el perfil
$query_posts = mysqli_query($connection, "SELECT * FROM publicaciones WHERE id_usuario = '$id_usuario' ORDER BY id DESC");
$query_comentarios = mysqli_query($connection, "SELECT * FROM comentarios WHERE id_usuario = '$id_usuario'");

include("../views/mi_perfil.php");
?>