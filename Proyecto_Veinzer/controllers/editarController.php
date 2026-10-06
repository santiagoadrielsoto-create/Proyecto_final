<?php
include('../db/db.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $usuario = $_POST['usuario'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $rol = $_POST['rol'];

    $update = "UPDATE usuarios SET usuario='$usuario', correo='$correo', telefono='$telefono', rol='$rol' WHERE id_cliente=$id";
    if (mysqli_query($connection, $update)) {
        echo "<script>alert('Modificado con éxito'); window.location='crudController.php';</script>";
    } else {
        echo "Error al modificar: " . mysqli_error($connection);
    }
}
mysqli_close($connection);
?>