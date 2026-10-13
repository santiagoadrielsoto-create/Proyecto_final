<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../views/login.php");
    exit();
}

include('../db/db.php');

// 1. Guardar o quitar "Me gusta" (1 por usuario por publicación)
if (isset($_GET['like'])) {
    $id_publicacion = intval($_GET['like']);
    $id_usuario = $_SESSION['id_usuario'];

    // Verificar si ya le dio me gusta previamente
    $check_like = mysqli_query($connection, "SELECT * FROM likes WHERE id_publicacion = '$id_publicacion' AND id_usuario = '$id_usuario'");

    if (mysqli_num_rows($check_like) > 0) {
        // Si ya existe, quitar el me gusta (toggle)
        mysqli_query($connection, "DELETE FROM likes WHERE id_publicacion = '$id_publicacion' AND id_usuario = '$id_usuario'");
    } else {
        // Si no existe, registrar el me gusta
        mysqli_query($connection, "INSERT INTO likes (id_publicacion, id_usuario) VALUES ('$id_publicacion', '$id_usuario')");
    }

    header("Location: foroController.php");
    exit();
}

// 2. Guardar nueva publicación
if (isset($_POST['publicar'])) {
    $contenido = mysqli_real_escape_string($connection, $_POST['contenido']);
    $id_usuario = $_SESSION['id_usuario'];
    $fecha = date('Y-m-d H:i:s');

    $query_insert = "INSERT INTO publicaciones (id_usuario, contenido, fecha) VALUES ('$id_usuario', '$contenido', '$fecha')";
    mysqli_query($connection, $query_insert);
    
    header("Location: foroController.php");
    exit();
}

// 3. Guardar nuevo comentario
if (isset($_POST['comentar'])) {
    $comentario = mysqli_real_escape_string($connection, $_POST['comentario']);
    $id_publicacion = intval($_POST['id_publicacion']);
    $id_usuario = $_SESSION['id_usuario'];
    $fecha = date('Y-m-d H:i:s');

    if (!empty($comentario) && $id_publicacion > 0) {
        $query_comentario = "INSERT INTO comentarios (id_publicacion, id_usuario, comentario, fecha) VALUES ('$id_publicacion', '$id_usuario', '$comentario', '$fecha')";
        mysqli_query($connection, $query_comentario);
    }

    header("Location: foroController.php");
    exit();
}

// 4. Consultar publicaciones
$query = "SELECT publicaciones.*, usuarios.usuario FROM publicaciones INNER JOIN usuarios ON publicaciones.id_usuario = usuarios.id_cliente ORDER BY publicaciones.id DESC";
$resultado_foro = mysqli_query($connection, $query);

// Incluir la vista del foro
include('../views/foro.php');

mysqli_close($connection);
?>