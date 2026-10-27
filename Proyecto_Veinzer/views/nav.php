<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$es_admin = isset($_SESSION['rol']) && (strtolower($_SESSION['rol']) === 'admin');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- FontAwesome para los iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: #121212; color: #e0e0e0; min-height: 100vh; display: flex; flex-direction: column; }
        .main-wrapper { flex: 1; }
        nav { background: #181818; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #2a2a2a; box-shadow: 0 4px 12px rgba(0,0,0,0.5); }
        .logo { font-size: 1.4rem; font-weight: 800; color: #ff5722; letter-spacing: 1px; text-decoration: none; }
        .nav-links { display: flex; align-items: center; gap: 18px; flex-wrap: wrap; }
        .nav-links a { color: #ccc; text-decoration: none; font-size: 0.95rem; font-weight: 500; transition: all 0.3s ease; }
        .nav-links a:hover { color: #ff5722; }
        .btn-logout { background: #d32f2f; color: #fff !important; padding: 6px 14px; border-radius: 6px; }
        .btn-logout:hover { background: #b71c1c !important; }

        /* RESPONSIVE PARA TABLETS Y CELULARES (Pantallas menores a 1024px) */
        @media (max-width: 1024px) {
            nav { flex-direction: column; padding: 12px 15px; text-align: center; gap: 10px; }
            .nav-links { justify-content: center; gap: 10px; }
            .nav-links a { font-size: 0.9rem; padding: 4px 8px; }
        }
    </style>
</head>
<body>
<nav>
    <a href="/Proyecto_Veinzer/views/home.php" class="logo">VEINZER</a>
    <div class="nav-links">
        <a href="/Proyecto_Veinzer/views/home.php">Inicio</a>
        <a href="/Proyecto_Veinzer/views/sobreNosotros.php">Sobre Nosotros</a>
        <a href="/Proyecto_Veinzer/controllers/miPerfilController.php">Mi Perfil</a>
        <a href="/Proyecto_Veinzer/controllers/datosFisicosController.php">Ingresar Datos</a>
        <a href="/Proyecto_Veinzer/controllers/recomendacionesController.php">Fuerza</a>
        <a href="/Proyecto_Veinzer/controllers/cardioController.php">Cardio</a>
        <a href="/Proyecto_Veinzer/controllers/yogaController.php">Yoga</a>
        <?php if ($es_admin): ?>
            <a href="/Proyecto_Veinzer/controllers/crudController.php">CRUD Usuarios</a>
            <a href="/Proyecto_Veinzer/controllers/crudPublicacionesController.php">CRUD Publicaciones</a>
        <?php endif; ?>
        <a href="/Proyecto_Veinzer/controllers/foroController.php">Foro</a>
        <a href="/Proyecto_Veinzer/controllers/logoutController.php" class="btn-logout">Cerrar Sesión</a>
    </div>
</nav>