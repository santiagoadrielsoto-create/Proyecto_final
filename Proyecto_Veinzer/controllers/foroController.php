<?php
session_start();

if (!isset($_SESSION['usuario']) || !isset($_SESSION['id_usuario'])) {
    header("Location: ../views/login.php");
    exit();
}

include('../db/db.php');

$id_usuario_actual = intval($_SESSION['id_usuario']);
$rol_usuario = strtolower($_SESSION['rol'] ?? '');

// 1. Eliminar Publicación (Dueño o Administrador)
if (isset($_GET['eliminar_post'])) {
    $id_post = intval($_GET['eliminar_post']);
    
    $check = mysqli_query($connection, "SELECT * FROM publicaciones WHERE id = '$id_post'");
    if ($post_data = mysqli_fetch_assoc($check)) {
        if ($rol_usuario === 'admin' || $post_data['id_usuario'] == $id_usuario_actual) {
            if (!empty($post_data['imagen']) && file_exists("../uploads/" . $post_data['imagen'])) {
                unlink("../uploads/" . $post_data['imagen']);
            }
            mysqli_query($connection, "DELETE FROM publicaciones WHERE id = '$id_post'");
            mysqli_query($connection, "DELETE FROM comentarios WHERE id_publicacion = '$id_post'");
            mysqli_query($connection, "DELETE FROM likes WHERE id_publicacion = '$id_post'");
        }
    }
    header("Location: foroController.php");
    exit();
}

// 2. Gestionar Me gusta (Toggle) con ancla
if (isset($_GET['like'])) {
    $id_publicacion = intval($_GET['like']);
    $check_like = mysqli_query($connection, "SELECT * FROM likes WHERE id_publicacion = '$id_publicacion' AND id_usuario = '$id_usuario_actual'");

    if (mysqli_num_rows($check_like) > 0) {
        mysqli_query($connection, "DELETE FROM likes WHERE id_publicacion = '$id_publicacion' AND id_usuario = '$id_usuario_actual'");
    } else {
        mysqli_query($connection, "INSERT INTO likes (id_publicacion, id_usuario) VALUES ('$id_publicacion', '$id_usuario_actual')");
    }
    // Redirige manteniendo la posición en la publicación
    header("Location: foroController.php#post-" . $id_publicacion);
    exit();
}

// 3. Crear Publicación con Imagen
if (isset($_POST['publicar'])) {
    $contenido = mysqli_real_escape_string($connection, $_POST['contenido']);
    $fecha = date('Y-m-d H:i:s');
    $nombre_imagen = NULL;

    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['imagen']['tmp_name'];
        $file_name = time() . "_" . basename($_FILES['imagen']['name']);
        $upload_dir = "../uploads/";

        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        if (move_uploaded_file($file_tmp, $upload_dir . $file_name)) {
            $nombre_imagen = $file_name;
        }
    }

    $img_sql = $nombre_imagen ? "'$nombre_imagen'" : "NULL";
    $query_insert = "INSERT INTO publicaciones (id_usuario, contenido, imagen, fecha) VALUES ('$id_usuario_actual', '$contenido', $img_sql, '$fecha')";
    
    if (!mysqli_query($connection, $query_insert)) {
        die("Error SQL: " . mysqli_error($connection));
    }
    
    header("Location: foroController.php");
    exit();
}

// 4. Crear Comentario con ancla
if (isset($_POST['comentar'])) {
    $comentario = mysqli_real_escape_string($connection, $_POST['comentario']);
    $id_publicacion = intval($_POST['id_publicacion']);
    $fecha = date('Y-m-d H:i:s');

    if (!empty($comentario) && $id_publicacion > 0) {
        mysqli_query($connection, "INSERT INTO comentarios (id_publicacion, id_usuario, comentario, fecha) VALUES ('$id_publicacion', '$id_usuario_actual', '$comentario', '$fecha')");
    }

    // Redirige manteniendo la posición en la publicación específica
    header("Location: foroController.php#post-" . $id_publicacion);
    exit();
}

// Consulta de publicaciones incluyendo 'foto_perfil' del usuario autor
$query = "SELECT publicaciones.*, usuarios.usuario, usuarios.foto_perfil FROM publicaciones INNER JOIN usuarios ON publicaciones.id_usuario = usuarios.id_cliente ORDER BY publicaciones.id DESC";
$resultado_foro = mysqli_query($connection, $query);

include('../views/foro.php');
mysqli_close($connection);
?>