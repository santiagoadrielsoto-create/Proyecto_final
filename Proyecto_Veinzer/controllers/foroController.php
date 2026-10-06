<?php
session_start();
include('../db/db.php');

// Si ni siquiera hay usuario en la sesión, ahí sí lo mandamos al login
if (!isset($_SESSION['usuario'])) {
    header("Location: ../views/login.php");
    exit();
}

// Si la sesión tiene el nombre pero le falta el ID, lo buscamos automáticamente en la base de datos
if (!isset($_SESSION['id_usuario'])) {
    $nombre_usuario = $_SESSION['usuario'];
    $consulta_id = mysqli_query($connection, "SELECT id_cliente FROM usuarios WHERE usuario = '$nombre_usuario'");
    if ($row_id = mysqli_fetch_assoc($consulta_id)) {
        $_SESSION['id_usuario'] = $row_id['id_cliente'];
    }
}

$id_usuario_actual = $_SESSION['id_usuario'];

if (isset($_POST['publicar'])) {
    $contenido = $_POST['contenido'];
    mysqli_query($connection, "INSERT INTO publicaciones (id_usuario, contenido) VALUES ('$id_usuario_actual', '$contenido')");
    header("Location: foroController.php");
    exit();
}

if (isset($_POST['comentar'])) {
    $id_pub = $_POST['id_publicacion'];
    $comentario = $_POST['comentario'];
    mysqli_query($connection, "INSERT INTO comentarios (id_publicacion, id_usuario, comentario) VALUES ('$id_pub', '$id_usuario_actual', '$comentario')");
    header("Location: foroController.php");
    exit();
}

if (isset($_GET['like'])) {
    $id_pub = $_GET['like'];
    mysqli_query($connection, "INSERT INTO likes (id_publicacion, id_usuario) VALUES ('$id_pub', '$id_usuario_actual')");
    header("Location: foroController.php");
    exit();
}

include("../views/foro.php");
?>