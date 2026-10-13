<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$es_admin = isset($_SESSION['rol']) && (strtolower($_SESSION['rol']) === 'admin');
?>
<style>
    * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
    body { background-color: #121212; color: #e0e0e0; min-height: 100vh; display: flex; flex-direction: column; }
    .main-wrapper { flex: 1; }
    nav { background: #181818; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #2a2a2a; box-shadow: 0 4px 12px rgba(0,0,0,0.5); }
    .logo { font-size: 1.4rem; font-weight: 800; color: #ff5722; letter-spacing: 1px; text-decoration: none; }
    .nav-links { display: flex; align-items: center; gap: 20px; }
    .nav-links a { color: #ccc; text-decoration: none; font-size: 0.95rem; font-weight: 500; transition: all 0.3s ease; }
    .nav-links a:hover { color: #ff5722; }
    .btn-logout { background: #d32f2f; color: #fff !important; padding: 6px 14px; border-radius: 6px; }
    .btn-logout:hover { background: #b71c1c !important; }
</style>

<nav>
    <a href="../views/home.php" class="logo">VEINZER</a>
    <div class="nav-links">
        <a href="../views/home.php">Inicio</a>
        <a href="../controllers/miPerfilController.php">Mi Perfil</a>
        <?php if ($es_admin): ?>
            <a href="../controllers/crudController.php">CRUD Usuarios</a>
        <?php endif; ?>
        <a href="../controllers/foroController.php">Foro</a>
        <a href="../controllers/logoutController.php" class="btn-logout">Cerrar Sesión</a>
    </div>
</nav>