<?php
session_start();

if (!isset($_SESSION['usuario']) || !isset($_SESSION['id_usuario'])) {
    header("Location: ../views/login.php");
    exit();
}

include('../db/db.php');
$id_usuario = intval($_SESSION['id_usuario']);

// Lógica para procesar el cambio de foto de perfil
if (isset($_POST['cambiar_foto']) && isset($_FILES['foto_perfil'])) {
    if ($_FILES['foto_perfil']['error'] === UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['foto_perfil']['tmp_name'];
        $file_name = "avatar_" . $id_usuario . "_" . time() . "_" . basename($_FILES['foto_perfil']['name']);
        $upload_dir = "../uploads/";

        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        if (move_uploaded_file($file_tmp, $upload_dir . $file_name)) {
            mysqli_query($connection, "UPDATE usuarios SET foto_perfil = '$file_name' WHERE id_cliente = '$id_usuario'");
        }
    }
    header("Location: miPerfilController.php");
    exit();
}

// 1. Datos principales del usuario
$query_perfil = mysqli_query($connection, "SELECT * FROM usuarios WHERE id_cliente = '$id_usuario'");
$perfil = mysqli_fetch_assoc($query_perfil);

// 2. Datos físicos
$query_datos_fisicos = mysqli_query($connection, "SELECT * FROM datos_fisicos WHERE id_usuario = '$id_usuario'");
$datos_fisicos = mysqli_fetch_assoc($query_datos_fisicos);

// 3. Publicaciones y comentarios
$query_posts = mysqli_query($connection, "SELECT * FROM publicaciones WHERE id_usuario = '$id_usuario' ORDER BY id DESC");
$query_comentarios = mysqli_query($connection, "SELECT * FROM comentarios WHERE id_usuario = '$id_usuario' ORDER BY id DESC");

include('../views/mi_perfil.php');
mysqli_close($connection);
?>