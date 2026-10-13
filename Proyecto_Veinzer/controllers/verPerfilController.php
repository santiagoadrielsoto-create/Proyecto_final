<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../views/login.php");
    exit();
}

include('../db/db.php');

$id_cliente = isset($_GET['id']) ? intval($_GET['id']) : $_SESSION['id_usuario'];

// Obtener datos del usuario
$query_usuario = "SELECT * FROM usuarios WHERE id_cliente = '$id_cliente'";
$res_usuario = mysqli_query($connection, $query_usuario);
$perfil = mysqli_fetch_assoc($res_usuario);

// Obtener publicaciones del usuario
$query_posts = "SELECT * FROM publicaciones WHERE id_usuario = '$id_cliente' ORDER BY id DESC";
$query_posts_res = mysqli_query($connection, $query_posts);

// Obtener comentarios del usuario
$query_comentarios = "SELECT * FROM comentarios WHERE id_usuario = '$id_cliente' ORDER BY id DESC";
$query_comentarios_res = mysqli_query($connection, $query_comentarios);

include('../views/ver_perfil.php');
mysqli_close($connection);
?>