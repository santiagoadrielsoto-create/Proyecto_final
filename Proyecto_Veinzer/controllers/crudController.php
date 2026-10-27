<?php
session_start();

if (!isset($_SESSION['usuario']) || strtolower($_SESSION['rol']) !== 'admin') {
    header("Location: ../views/home.php");
    exit();
}

include('../db/db.php');

// Lógica de eliminación segura
if (isset($_GET['eliminar'])) {
    $id_a_eliminar = intval($_GET['eliminar']);
    $id_usuario_actual = intval($_SESSION['id_usuario']);

    // Consultar el rol del usuario que se quiere eliminar
    $query_verificar = mysqli_query($connection, "SELECT rol FROM usuarios WHERE id_cliente = '$id_a_eliminar'");
    $usuario_a_borrar = mysqli_fetch_assoc($query_verificar);

    if ($usuario_a_borrar) {
        $rol_a_borrar = strtolower($usuario_a_borrar['rol']);

        // REGLA: No eliminarse a sí mismo y que los admins no puedan borrar a otros admins
        if ($id_a_eliminar !== $id_usuario_actual && $rol_a_borrar !== 'admin') {
            mysqli_query($connection, "DELETE FROM usuarios WHERE id_cliente = '$id_a_eliminar'");
        } else {
            echo "<script>alert('Acción no permitida: No puedes eliminar a otro administrador o a ti mismo.');</script>";
        }
    }
    
    header("Refresh:0; url=crudController.php");
    exit();
}

$query = "SELECT * FROM usuarios";
$resultado = mysqli_query($connection, $query);

include('../views/crudUsuarios.php');
mysqli_close($connection);
?>