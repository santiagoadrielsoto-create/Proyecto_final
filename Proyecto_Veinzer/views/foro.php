<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
$id_usuario_actual = $_SESSION['id_usuario'] ?? 0;
$rol_actual = strtolower($_SESSION['rol'] ?? '');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foro - Veinzer</title>
    <style>
        .container { max-width: 750px; width: 92%; margin: 30px auto; padding: 0; }
        .post-box { background: #1e1e1e; padding: 20px; border-radius: 10px; border: 1px solid #2a2a2a; margin-bottom: 30px; box-shadow: 0 4px 12px rgba(0,0,0,0.4); }
        .post-box h2 { color: #fff; margin-bottom: 15px; font-size: 1.4rem; }
        textarea { width: 100%; height: 80px; background: #2a2a2a; border: 1px solid #3a3a3a; border-radius: 6px; color: #fff; padding: 12px; font-size: 0.95rem; resize: none; margin-bottom: 10px; box-sizing: border-box; }
        textarea:focus { outline: none; border-color: #ff5722; }
        .file-input-wrapper { margin-bottom: 12px; color: #aaa; font-size: 0.9rem; }
        .btn-post { background: #ff5722; color: #fff; padding: 9px 20px; border: none; border-radius: 6px; font-weight: bold; cursor: pointer; }
        
        .card-post { background: #1e1e1e; border: 1px solid #2a2a2a; border-radius: 10px; padding: 20px; margin-bottom: 20px; box-shadow: 0 4px 12px rgba(0,0,0,0.3); position: relative; scroll-margin-top: 20px; }
        .post-header { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px; }
        .author-info { display: flex; align-items: center; gap: 12px; }
        
        /* Mini Avatar en el Foro */
        .forum-avatar { width: 40px; height: 40px; border-radius: 50%; object-fit: cover; border: 2px solid #ff5722; background: #252525; display: flex; align-items: center; justify-content: center; }
        .forum-avatar i { font-size: 30px; color: #888; }
        
        .post-author { font-weight: bold; color: #ff5722; font-size: 1.05rem; text-decoration: none; }
        .post-author:hover { text-decoration: underline; }
        .post-date { color: #666; font-size: 0.8rem; margin-left: 8px; display: block; }
        .post-content { color: #e0e0e0; margin: 12px 0; font-size: 1rem; line-height: 1.4; word-break: break-word; }
        .post-img { width: 100%; max-height: 350px; object-fit: cover; border-radius: 6px; margin-bottom: 15px; }
        
        .delete-post { color: #dc3545; font-size: 0.85rem; text-decoration: none; font-weight: bold; }
        .delete-post:hover { text-decoration: underline; }

        .like-btn { background: #2a2a2a; color: #aaa; border: 1px solid #3a3a3a; padding: 6px 14px; border-radius: 20px; text-decoration: none; font-size: 0.85rem; font-weight: bold; display: inline-flex; align-items: center; gap: 6px; transition: background 0.3s; }
        .like-btn.liked { background: #ff5722; color: #fff; border-color: #ff5722; }
        
        .comments-section { margin-top: 15px; padding-top: 15px; border-top: 1px solid #2a2a2a; }
        .comment-input { display: flex; gap: 8px; margin-top: 10px; margin-bottom: 15px; flex-wrap: wrap; }
        .comment-input input { flex: 1; min-width: 180px; background: #2a2a2a; border: 1px solid #3a3a3a; border-radius: 6px; color: #fff; padding: 8px 12px; }
        .btn-comment { background: #ff5722; color: #fff; border: none; padding: 8px 15px; border-radius: 6px; cursor: pointer; font-weight: bold; }
        
        .comments-list { display: flex; flex-direction: column; gap: 8px; }
        .comment-item { background: #252525; padding: 10px 14px; border-radius: 6px; border-left: 3px solid #ff5722; font-size: 0.9rem; }
        .comment-author { font-weight: bold; color: #fff; font-size: 0.85rem; text-decoration: none; }
        .comment-text { color: #ccc; margin-top: 3px; word-break: break-word; }
        .comment-date { color: #666; font-size: 0.75rem; float: right; }

        /* ==========================================================
           RESPONSIVE PARA TABLETS Y CELULARES (Menor o igual a 1024px)
           ========================================================== */
        @media (max-width: 1024px) {
            .container { width: 95% !important; margin: 20px auto !important; padding: 0 10px !important; }
            .post-box, .card-post { padding: 15px; }
            .post-header { align-items: flex-start; }
            .comment-input { flex-direction: column; }
            .btn-comment { width: 100%; text-align: center; padding: 10px; }
        }
    </style>
</head>
<body>
    <div class="main-wrapper">
        <?php include('nav.php'); ?>

        <div class="container">
            <!-- Formulario con soporte para archivos de imagen -->
            <div class="post-box">
                <h2>Crear una Publicación</h2>
                <form action="foroController.php" method="POST" enctype="multipart/form-data">
                    <textarea name="contenido" placeholder="¿Qué estás pensando hoy?..." required></textarea>
                    <div class="file-input-wrapper">
                        <label>Adjuntar Imagen:</label>
                        <input type="file" name="imagen" accept="image/*" style="color:#aaa; margin-top:5px; width:100%;">
                    </div>
                    <button type="submit" name="publicar" class="btn-post">Publicar</button>
                </form>
            </div>

            <h3 style="color: #888; margin-bottom: 15px; font-size: 1.1rem;">Publicaciones Recientes</h3>

            <?php if (isset($resultado_foro) && mysqli_num_rows($resultado_foro) > 0) { ?>
                <?php while ($post = mysqli_fetch_assoc($resultado_foro)) { 
                    $id_post = $post['id'];

                    // Obtener total de Me gusta
                    $res_likes = mysqli_query($connection, "SELECT COUNT(*) as total FROM likes WHERE id_publicacion = '$id_post'");
                    $data_likes = mysqli_fetch_assoc($res_likes);
                    $total_likes = $data_likes['total'] ?? 0;

                    // Verificar Me gusta del usuario actual
                    $res_user_like = mysqli_query($connection, "SELECT * FROM likes WHERE id_publicacion = '$id_post' AND id_usuario = '$id_usuario_actual'");
                    $user_gave_like = mysqli_num_rows($res_user_like) > 0;
                ?>
                    <!-- Agregamos el id dinámico para el ancla -->
                    <div class="card-post" id="post-<?php echo $id_post; ?>">
                        <div class="post-header">
                            <div class="author-info">
                                <!-- Avatar del usuario en el Foro -->
                                <?php if (!empty($post['foto_perfil']) && file_exists("../uploads/" . $post['foto_perfil'])): ?>
                                    <img src="../uploads/<?php echo htmlspecialchars($post['foto_perfil']); ?>" alt="Avatar" class="forum-avatar">
                                <?php else: ?>
                                    <div class="forum-avatar"><i class="fa-solid fa-circle-user"></i></div>
                                <?php endif; ?>
                                
                                <div>
                                    <a href="verPerfilController.php?id=<?php echo $post['id_usuario']; ?>" class="post-author">
                                        <?php echo htmlspecialchars($post['usuario'] ?? 'Anónimo'); ?>
                                    </a>
                                    <span class="post-date"><?php echo $post['fecha']; ?></span>
                                </div>
                            </div>
                            
                            <?php if ($rol_actual === 'admin' || $post['id_usuario'] == $id_usuario_actual): ?>
                                <a href="foroController.php?eliminar_post=<?php echo $id_post; ?>" onclick="return confirm('¿Eliminar esta publicación?');" class="delete-post" title="Eliminar">
                                    <i class="fa-solid fa-trash"></i> Eliminar
                                </a>                                        
                            <?php endif; ?>
                        </div>

                        <div class="post-content">
                            <?php echo htmlspecialchars($post['contenido']); ?>
                        </div>

                        <?php if (!empty($post['imagen'])): ?>
                            <img src="../uploads/<?php echo htmlspecialchars($post['imagen']); ?>" alt="Imagen de publicación" class="post-img">
                        <?php endif; ?>
                        
                        <a href="foroController.php?like=<?php echo $id_post; ?>" class="like-btn <?php echo $user_gave_like ? 'liked' : ''; ?>">
                            👍 Me gusta (<?php echo $total_likes; ?>)
                        </a>

                        <div class="comments-section">
                            <span style="color:#aaa; font-size:0.85rem; font-weight:bold;">Comentarios:</span>
                            
                            <form action="foroController.php" method="POST" class="comment-input">
                                <input type="hidden" name="id_publicacion" value="<?php echo $id_post; ?>">
                                <input type="text" name="comentario" placeholder="Escribe un comentario..." required autocomplete="off">
                                <button type="submit" name="comentar" class="btn-comment">Comentar</button>
                            </form>

                            <div class="comments-list">
                                <?php
                                $query_comm = "SELECT comentarios.*, usuarios.usuario FROM comentarios INNER JOIN usuarios ON comentarios.id_usuario = usuarios.id_cliente WHERE comentarios.id_publicacion = '$id_post' ORDER BY comentarios.id ASC";
                                $res_comm = mysqli_query($connection, $query_comm);
                                
                                if ($res_comm && mysqli_num_rows($res_comm) > 0) {
                                    while ($comm = mysqli_fetch_assoc($res_comm)) {
                                ?>
                                        <div class="comment-item">
                                            <span class="comment-date"><?php echo $comm['fecha']; ?></span>
                                            <a href="verPerfilController.php?id=<?php echo $comm['id_usuario']; ?>" class="comment-author">
                                                <?php echo htmlspecialchars($comm['usuario']); ?>
                                            </a>
                                            <div class="comment-text"><?php echo htmlspecialchars($comm['comentario']); ?></div>
                                        </div>
                                <?php 
                                    }
                                } 
                                ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <p style="color: #777; text-align: center;">No hay publicaciones todavía.</p>
            <?php } ?>
        </div>
    </div>

    <?php include('footer.php'); ?>
</body>
</html>