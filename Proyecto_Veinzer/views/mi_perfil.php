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
        .profile-header { display: flex; align-items: center; gap: 20px; margin-bottom: 20px; flex-wrap: wrap; }
        
        /* Foto de perfil */
        .profile-avatar-wrapper { position: relative; width: 100px; height: 100px; }
        .profile-avatar { width: 100px; height: 100px; border-radius: 50%; object-fit: cover; border: 3px solid #ff5722; background: #252525; display: flex; align-items: center; justify-content: center; }
        .profile-avatar i { font-size: 80px; color: #888; }
        
        .upload-avatar-form { margin-top: 8px; font-size: 0.8rem; }
        .btn-upload { background: #ff5722; color: #fff; border: none; padding: 5px 10px; border-radius: 4px; font-weight: bold; cursor: pointer; margin-top: 5px; transition: background 0.3s; }
        .btn-upload:hover { background: #e64a19; }

        .profile-info { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin: 20px 0; }
        .info-box { background: #252525; padding: 15px; border-radius: 8px; }
        .info-box span { display: block; color: #888; font-size: 0.85rem; margin-bottom: 4px; }
        .info-box strong { color: #fff; font-size: 1.1rem; }
        .btn-edit { background: #007bff; color: #fff; padding: 10px 20px; border-radius: 6px; text-decoration: none; font-weight: bold; display: inline-block; transition: background 0.3s; margin-right: 10px; }
        .btn-edit:hover { background: #0056b3; }
        .btn-fisicos { background: #ff5722; color: #fff; padding: 10px 20px; border-radius: 6px; text-decoration: none; font-weight: bold; display: inline-block; transition: background 0.3s; }
        .btn-fisicos:hover { background: #e64a19; }
        
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
                <div class="profile-header">
                    <div class="profile-avatar-wrapper">
                        <?php if (!empty($perfil['foto_perfil']) && file_exists("../uploads/" . $perfil['foto_perfil'])): ?>
                            <img src="../uploads/<?php echo htmlspecialchars($perfil['foto_perfil']); ?>" alt="Foto Perfil" class="profile-avatar">
                        <?php else: ?>
                            <div class="profile-avatar"><i class="fa-solid fa-circle-user"></i></div>
                        <?php endif; ?>
                    </div>
                    <div>
                        <h1>Hola, <?php echo htmlspecialchars($perfil['usuario'] ?? 'Usuario'); ?></h1>
                        <p style="color: #aaa; margin-bottom: 8px;">Panel de control y actividad personal en la plataforma.</p>
                        
                        <!-- Formulario para subir/cambiar foto de perfil -->
                        <form action="miPerfilController.php" method="POST" enctype="multipart/form-data" class="upload-avatar-form">
                            <input type="file" name="foto_perfil" accept="image/*" required style="color:#aaa; font-size:0.75rem;">
                            <br>
                            <button type="submit" name="cambiar_foto" class="btn-upload">Actualizar Foto</button>
                        </form>
                    </div>
                </div>
                
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

                <!-- Botones de Acción -->
                <div style="margin-top: 20px;">
                    <a href="editarController.php?id=<?php echo $perfil['id_cliente']; ?>" class="btn-edit">Modificar mis datos</a>
                    <a href="datosFisicosController.php" class="btn-fisicos">Actualizar Datos Físicos</a>
                </div>
            </div>

            <!-- Tarjeta de Datos Físicos -->
            <div class="profile-card" style="border-left-color: #28a745;">
                <h2 style="color: #fff; font-size: 1.5rem; margin-bottom: 15px;">Mis Datos Físicos</h2>
                <?php if ($datos_fisicos) { ?>
                    <div class="profile-info">
                        <div class="info-box">
                            <span>Altura</span>
                            <strong><?php echo $datos_fisicos['altura']; ?> m</strong>
                        </div>
                        <div class="info-box">
                            <span>Peso</span>
                            <strong><?php echo $datos_fisicos['peso']; ?> kg</strong>
                        </div>
                        <div class="info-box">
                            <span>Edad</span>
                            <strong><?php echo $datos_fisicos['edad']; ?> años</strong>
                        </div>
                        <div class="info-box">
                            <span>Actividad Física</span>
                            <strong><?php echo htmlspecialchars($datos_fisicos['actividad']); ?></strong>
                        </div>
                    </div>
                <?php } else { ?>
                    <p style="color: #777; margin-bottom: 15px;">Aún no has registrado tus datos físicos en la plataforma.</p>
                    <a href="datosFisicosController.php" class="btn-fisicos" style="padding: 8px 15px; font-size: 0.9rem;">Cargar mis datos físicos ahora</a>
                <?php } ?>
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