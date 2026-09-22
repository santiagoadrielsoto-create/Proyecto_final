<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Perfil - Veinzer</title>
</head>
<body>
    <h1>Bienvenido a tu perfil, <?php echo $_SESSION['usuario']; ?></h1>
    <p>Esta es tu sección de usuario dentro de la plataforma.</p>
    <br>
    <a href="login.php">Cerrar Sesión</a>
</body>
</html>