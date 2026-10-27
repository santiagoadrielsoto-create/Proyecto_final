<?php
session_start();

// Validar que el usuario haya iniciado sesión y sea estrictamente administrador
if (!isset($_SESSION['usuario']) || strtolower($_SESSION['rol'] !== 'admin')) {
    header("Location: ../views/home.php");
    exit();
}

include('../db/db.php');

// Lógica de eliminación de publicaciones desde el panel de Admin
if (isset($_GET['eliminar'])) {
    $id_post = intval($_GET['eliminar']);
    
    // Buscar la publicación para borrar su imagen física si existe
    $check = mysqli_query($connection, "SELECT * FROM publicaciones WHERE id = '$id_post'");
    if ($post_data = mysqli_fetch_assoc($check)) {
        if (!empty($post_data['imagen']) && file_exists("../uploads/" . $post_data['imagen'])) {
            unlink("../uploads/" . $post_data['imagen']);
        }
        mysqli_query($connection, "DELETE FROM publicaciones WHERE id = '$id_post'");
        mysqli_query($connection, "DELETE FROM comentarios WHERE id_publicacion = '$id_post'");
        mysqli_query($connection, "DELETE FROM likes WHERE id_publicacion = '$id_post'");
    }
    header("Location: crudPublicacionesController.php");
    exit();
}

// Consultar todas las publicaciones junto con el nombre del usuario autor
$query = "SELECT publicaciones.*, usuarios.usuario FROM publicaciones INNER JOIN usuarios ON publicaciones.id_usuario = usuarios.id_cliente ORDER BY publicaciones.id DESC";
$resultado_crud_posts = mysqli_query($connection, $query);

include('../views/crudPublicaciones.php');
mysqli_close($connection);
?>