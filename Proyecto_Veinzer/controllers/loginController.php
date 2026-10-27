<?php
session_start();
include('../db/db.php');

if (isset($_POST['ingresar'])) {
    $correo = mysqli_real_escape_string($connection, $_POST['correo']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);

    // Usamos 'contrasena' que es el nombre real de la columna en tu base de datos
    $query = "SELECT * FROM usuarios WHERE correo = '$correo' AND contrasena = '$password'";
    $resultado = mysqli_query($connection, $query);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $usuario_data = mysqli_fetch_assoc($resultado);
        
        // Guardar las variables en la sesión
        $_SESSION['usuario'] = $usuario_data['usuario'];
        $_SESSION['id_usuario'] = intval($usuario_data['id_cliente']);
        $_SESSION['rol'] = $usuario_data['rol'];

        header("Location: ../views/home.php");
        exit();
    } else {
        echo "<script>alert('Correo o contraseña incorrectos'); window.location='../views/login.php';</script>";
        exit();
    }
} else {
    header("Location: ../views/login.php");
    exit();
}
mysqli_close($connection);
?>