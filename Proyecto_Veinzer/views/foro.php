<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Foro - Veinzer</title>
    <style>
        .container { max-width: 750px; margin: 30px auto; padding: 0 20px; }
        .post-box { background: #1e1e1e; padding: 20px; border-radius: 10px; border: 1px solid #2a2a2a; margin-bottom: 30px; box-shadow: 0 4px 12px rgba(0,0,0,0.4); }
        .post-box h2 { color: #fff; margin-bottom: 15px; font-size: 1.4rem; }
        textarea { width: 100%; height: 80px; background: #2a2a2a; border: 1px solid #3a3a3a; border-radius: 6px; color: #fff; padding: 12px; font-size: 0.95rem; resize: none; margin-bottom: 10px; }
        textarea:focus { outline: none; border-color: #ff5722; }
        .btn-post { background: #ff5722; color: #fff; padding: 9px 20px; border: none; border-radius: 6px; font-weight: bold; cursor: pointer; }
        
        .card-post { background: #1e1e1e; border: 1px solid #2a2a2a; border-radius: 10px; padding: 20px; margin-bottom: 20px; box-shadow: 0 4px 12px rgba(0,0,0,0.3); }
        .post-author { font-weight: bold; color: #ff5722; font-size: 1.05rem; text-decoration: none; }
        .post-author:hover { text-decoration: underline; }
        .post-date { color: #666; font-size: 0.8rem; margin-left: 8px; }
        .post-content { color: #e0e0e0; margin: 12px 0 15px; font-size: 1rem; line-height: 1.4; }
        
        .like-btn { background: #2a2a2a; color: #aaa; border: 1px solid #3a3a3a; padding: 6px 14px; border-radius: 20px; text-decoration: none; font-size: 0.85rem; font-weight: bold; display: inline-flex; align-items: center; gap: 6px; transition: all 0.2s; }
        .like-btn:hover { border-color: #ff5722; color: #fff; }
        .like-btn.liked { background: #ff5722; color: #fff; border-color: #ff5722; }
        
        /* Sección de Comentarios */
        .comments-section { margin-top: 15px; padding-top: 15px; border-top: 1px solid #2a2a2a; }
        .comment-input { display: flex; gap: 8px; margin-top: 10px; margin-bottom: 15px; }
        .comment-input input { flex: 1; background: #2a2a2a; border: 1px solid #3a3a3a; border-radius: 6px; color: #fff; padding: 8px 12px; }
        .btn-comment { background: #ff5722; color: #fff; border: none; padding: 8px 15px; border-radius: 6px; cursor: pointer; font-weight: bold; }
        
        .comments-list { display: flex; flex-direction: column; gap: 8px; }
        .comment-item { background: #252525; padding: 10px 14px; border-radius: 6px; border-left: 3px solid #ff5722; font-size: 0.9rem; }
        .comment-author { font-weight: bold; color: #fff; font-size: 0.85rem; text-decoration: none; }
        .comment-author:hover { text-decoration: underline; color: #ff5722; }
        .comment-text { color: #ccc; margin-top: 3px; }
        .comment-date { color: #666; font-size: 0.75rem; float: right; }
    </style>
</head>
<body>
    <div class="main-wrapper">
        <?php include('nav.php'); ?>

        <div class="container">
            <div class="post-box">
                <h2>Crear una Publicación</h2>
                <form action="foroController.php" method="POST">
                    <textarea name="contenido" placeholder="¿Qué estás pensando hoy?..." required></textarea>
                    <button type="submit" name="publicar" class="btn-post">Publicar</button>
                </form>
            </div>

            <h3 style="color: #888; margin-bottom: 15px; font-size: 1.1rem;">Publicaciones Recientes</h3>

            <?php if (isset($resultado_foro) && mysqli_num_rows($resultado_foro) > 0) { ?>
                <?php while ($post = mysqli_fetch_assoc($resultado_foro)) { 
                    $id_post = $post['id'];
                    $id_user_session = $_SESSION['id_usuario'];

                    // Obtener total de Me gusta de esta publicación
                    $res_likes = mysqli_query($connection, "SELECT COUNT(*) as total FROM likes WHERE id_publicacion = '$id_post'");
                    $data_likes = mysqli_fetch_assoc($res_likes);
                    $total_likes = $data_likes['total'] ?? 0;

                    // Verificar si el usuario en sesión ya dio Me gusta
                    $res_user_like = mysqli_query($connection, "SELECT * FROM likes WHERE id_publicacion = '$id_post' AND id_usuario = '$id_user_session'");
                    $user_gave_like = mysqli_num_rows($res_user_like) > 0;
                ?>
                    <div class="card-post">
                        <div>
                            <!-- Nombre del usuario como enlace al perfil -->
                            <a href="verPerfilController.php?id=<?php echo $post['id_usuario']; ?>" class="post-author">
                                <?php echo htmlspecialchars($post['usuario'] ?? 'Anónimo'); ?>
                            </a>
                            <span class="post-date"><?php echo $post['fecha']; ?></span>
                        </div>
                        <div class="post-content">
                            <?php echo htmlspecialchars($post['contenido']); ?>
                        </div>
                        
                        <!-- Botón Me gusta -->
                        <a href="foroController.php?like=<?php echo $id_post; ?>" class="like-btn <?php echo $user_gave_like ? 'liked' : ''; ?>">
                            👍 Me gusta (<?php echo $total_likes; ?>)
                        </a>

                        <div class="comments-section">
                            <span style="color:#aaa; font-size:0.85rem; font-weight:bold;">Comentarios:</span>
                            
                            <!-- Formulario de comentario -->
                            <form action="foroController.php" method="POST" class="comment-input">
                                <input type="hidden" name="id_publicacion" value="<?php echo $id_post; ?>">
                                <input type="text" name="comentario" placeholder="Escribe un comentario..." required autocomplete="off">
                                <button type="submit" name="comentar" class="btn-comment">Comentar</button>
                            </form>

                            <!-- Lista de comentarios con enlace al perfil -->
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
                <p style="color: #777;">No hay publicaciones todavía. ¡Sé el primero en escribir una!</p>
            <?php } ?>
        </div>
    </div>

    <?php include('footer.php'); ?>
</body>
</html>