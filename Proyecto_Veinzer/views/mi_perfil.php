<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (!isset($_SESSION['usuario'])) { header("Location: login.php"); exit(); }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Perfil - Veinzer</title>
    <style>
        .container { max-width: 800px; margin: 40px auto; padding: 0 20px; }
        .profile-card { background: #1e1e1e; padding: 30px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.5); border-left: 5px solid #ff5722; margin-bottom: 30px; }
        .profile-card h1 { color: #fff; margin-bottom: 10px; font-size: 2rem; }
        .profile-info { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin: 20px 0; }
        .info-box { background: #252525; padding: 15px; border-radius: 8px; }
        .info-box span { display: block; color: #888; font-size: 0.85rem; margin-bottom: 4px; }
        .info-box strong { color: #fff; font-size: 1.1rem; }
        .btn-edit { background: #007bff; color: #fff; padding: 10px 20px; border-radius: 6px; text-decoration: none; font-weight: bold; display: inline-block; transition: background 0.3s; }
        .btn-edit:hover { background: #0056b3; }
        
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
                <h1>Hola, <?php echo htmlspecialchars($perfil['usuario'] ?? 'Usuario'); ?></h1>
                <p style="color: #aaa;">Panel de control y actividad personal en la plataforma.</p>
                
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

                <a href="editarController.php?id=<?php echo $perfil['id_cliente']; ?>" class="btn-edit">Modificar mis datos</a>
            </div>

            <!-- Actividad: Publicaciones Propias -->
            <div class="activity-section">
                <h3>Mis Publicaciones en el Foro</h3>
                <?php if (mysqli_num_rows($query_posts) > 0) { ?>
                    <?php while ($post = mysqli_fetch_assoc($query_posts)) { ?>
                        <div class="item-card">
                            <p><?php echo htmlspecialchars($post['contenido']); ?></p>
                            <small style="color: #777; display: block; margin-top: 5px;">Fecha: <?php echo $post['fecha']; ?></small>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <p style="color: #777;">Aún no has realizado ninguna publicación.</p>
                <?php } ?>
            </div>

            <!-- Actividad: Comentarios Propios -->
            <div class="activity-section">
                <h3>Mis Comentarios Realizados</h3>
                <?php if (mysqli_num_rows($query_comentarios) > 0) { ?>
                    <?php while ($comentario = mysqli_fetch_assoc($query_comentarios)) { ?>
                        <div class="item-card">
                            <p><?php echo htmlspecialchars($comentario['comentario']); ?></p>
                            <small style="color: #777; display: block; margin-top: 5px;">Fecha: <?php echo $comentario['fecha']; ?></small>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <p style="color: #777;">Aún no has hecho comentarios.</p>
                <?php } ?>
            </div>
        </div>
    </div>

    <?php include('footer.php'); ?>

</body>
</html>