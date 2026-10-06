<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Si no existe la sesión del usuario, lo mandamos al login de forma segura para evitar errores
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
    <?php include('nav.php'); ?>
    
    <!-- Usamos el operador ?? para que si por alguna razón viniera vacío, muestre 'Invitado' en vez de dar error -->
    <h1>Bienvenido a tu perfil, <?php echo htmlspecialchars($_SESSION['usuario'] ?? 'Invitado'); ?></h1>
    <p>Esta es tu sección de usuario dentro de la plataforma.</p>
    <br>
    <a href="login.php">Cerrar Sesión</a>
</body>
</html>