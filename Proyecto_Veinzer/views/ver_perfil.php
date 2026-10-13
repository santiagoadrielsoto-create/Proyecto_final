<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
$es_admin = isset($_SESSION['rol']) && (strtolower($_SESSION['rol']) === 'admin');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perfil de <?php echo htmlspecialchars($perfil['usuario'] ?? 'Usuario'); ?> - Veinzer</title>
    <style>
        .container { max-width: 800px; margin: 40px auto; padding: 0 20px; }
        .profile-card { background: #1e1e1e; padding: 30px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.5); border-left: 5px solid #ff5722; margin-bottom: 30px; }
        .profile-card h1 { color: #fff; margin-bottom: 10px; font-size: 2rem; }
        .profile-info { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin: 20px 0; }
        .info-box { background: #252525; padding: 15px; border-radius: 8px; }
        .info-box span { display: block; color: #888; font-size: 0.85rem; margin-bottom: 4px; }
        .info-box strong { color: #fff; font-size: 1.1rem; }
        .btn-back { background: #333; color: #fff; padding: 10px 20px; border-radius: 6px; text-decoration: none; font-weight: bold; display: inline-block; transition: background 0.3s; }
        .btn-back:hover { background: #444; }
        
        /* Secciones de Actividad */
        .activity-section { background: #1e1e1e; padding: 25px; border-radius: 12px; margin-bottom: 20px; }
        .activity-section h3 { border-bottom: 1px solid #333; padding-bottom: 10px; margin-bottom: 15px; color: #ff5722; }
        .item-card { background: #252525; padding: 12px 18px; border-radius: 6px; margin-bottom: 10px; font-size: 0.95rem; }
    </style>
</head>
<body>

    <div class="main-wrapper">
        <?php include('nav.php'); ?>

        <div class="container">
            <!-- Tarjeta de Perfil -->
            <div class="profile-card">
                <h1>Perfil de: <?php echo htmlspecialchars($perfil['usuario'] ?? 'Usuario'); ?></h1>
                <p style="color: #aaa;">Información general y actividad del usuario en la plataforma.</p>
                
                <div class="profile-info">
                    <div class="info-box">
                        <span>Correo Electrónico</span>
                        <strong><?php echo htmlspecialchars($perfil['correo'] ?? ''); ?></strong>
                    </div>
                    <div class="info-box">
                        <span>Teléfono</span>
                        <strong><?php echo htmlspecialchars($perfil['telefono'] ?? ''); ?></strong>
                    </div>
                    <div class="info-box">
                        <span>Rol Asignado</span>
                        <strong><?php echo htmlspecialchars($perfil['rol'] ?? ''); ?></strong>
                    </div>
                </div>

                <!-- Botón dinámico según el rol del usuario -->
                <?php if ($es_admin): ?>
                    <a href="crudController.php" class="btn-back">&larr; Volver al CRUD</a>
                <?php else: ?>
                    <a href="foroController.php" class="btn-back">&larr; Volver al Foro</a>
                <?php endif; ?>
            </div>

            <!-- Actividad: Publicaciones -->
            <div class="activity-section">
                <h3>Publicaciones en el Foro</h3>
                <?php if (mysqli_num_rows($query_posts_res) > 0) { ?>
                    <?php while ($post = mysqli_fetch_assoc($query_posts_res)) { ?>
                        <div class="item-card">
                            <p><?php echo htmlspecialchars($post['contenido']); ?></p>
                            <small style="color: #777; display: block; margin-top: 5px;">Fecha: <?php echo $post['fecha']; ?></small>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <p style="color: #777;">Este usuario aún no ha realizado ninguna publicación.</p>
                <?php } ?>
            </div>

            <!-- Actividad: Comentarios -->
            <div class="activity-section">
                <h3>Comentarios Realizados</h3>
                <?php if (mysqli_num_rows($query_comentarios_res) > 0) { ?>
                    <?php while ($comentario = mysqli_fetch_assoc($query_comentarios_res)) { ?>
                        <div class="item-card">
                            <p><?php echo htmlspecialchars($comentario['comentario']); ?></p>
                            <small style="color: #777; display: block; margin-top: 5px;">Fecha: <?php echo $comentario['fecha']; ?></small>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <p style="color: #777;">Este usuario aún no ha hecho comentarios.</p>
                <?php } ?>
            </div>
        </div>
    </div>

    <?php include('footer.php'); ?>

</body>
</html>