<?php
session_start();

if (!isset($_SESSION['usuario']) || !isset($_SESSION['id_usuario'])) {
    header("Location: ../views/login.php");
    exit();
}

include('../db/db.php');
$id_usuario = intval($_SESSION['id_usuario']);

// Procesar el formulario al enviar
if (isset($_POST['guardar_datos'])) {
    $altura = floatval($_POST['altura']);
    $peso = floatval($_POST['peso']);
    $edad = intval($_POST['edad']);
    $actividad = mysqli_real_escape_string($connection, $_POST['actividad']);

    // Verificar si ya existen registros previos para este usuario
    $check_query = mysqli_query($connection, "SELECT * FROM datos_fisicos WHERE id_usuario = '$id_usuario'");

    if (mysqli_num_rows($check_query) > 0) {
        // Si ya existen, actualizamos (Sobrescribe)
        $query = "UPDATE datos_fisicos SET altura = '$altura', peso = '$peso', edad = '$edad', actividad = '$actividad' WHERE id_usuario = '$id_usuario'";
    } else {
        // Si no existen, insertamos por primera vez
        $query = "INSERT INTO datos_fisicos (id_usuario, altura, peso, edad, actividad) VALUES ('$id_usuario', '$altura', '$peso', '$edad', '$actividad')";
    }

    if (mysqli_query($connection, $query)) {
        echo "<script>alert('¡Datos físicos guardados con éxito!'); window.location='datosFisicosController.php';</script>";
        exit();
    } else {
        echo "<script>alert('Error al guardar: " . mysqli_error($connection) . "');</script>";
    }
}

// Consultar los datos actuales para rellenar el formulario si ya los cargó antes
$resultado_datos = mysqli_query($connection, "SELECT * FROM datos_fisicos WHERE id_usuario = '$id_usuario'");
$datos_fisicos = mysqli_fetch_assoc($resultado_datos);

include('../views/datosFisicos.php');
mysqli_close($connection);
?>