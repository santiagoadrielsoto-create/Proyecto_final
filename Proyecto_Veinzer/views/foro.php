<?php
session_start();
include('../db/db.php');
$publicaciones = mysqli_query($connection, "SELECT p.*, u.usuario FROM publicaciones p JOIN usuarios u ON p.id_usuario = u.id_cliente ORDER BY p.fecha DESC");
?>
<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Foro - Veinzer</title></head>
<body>
    <?php include('nav.php'); ?>
    <h2>Foro de la Comunidad</h2>

    <form action="../controllers/foroController.php" method="POST">
        <textarea name="contenido" rows="3" cols="40" placeholder="¿Qué deseas publicar?" required></textarea><br>
        <input type="submit" name="publicar" value="Publicar">
    </form>
    <hr>

    <h3>Publicaciones</h3>
    <?php while($pub = mysqli_fetch_assoc($publicaciones)) { ?>
        <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px; border-radius: 5px;">
            <strong><?php echo $pub['usuario']; ?></strong> <em>(<?php echo $pub['fecha']; ?>)</em>
            <p><?php echo $pub['contenido']; ?></p>
            
            <a href="../controllers/foroController.php?like=<?php echo $pub['id']; ?>">👍 Me gusta</a>
            
            <h4>Comentarios:</h4>
            <?php
            $id_pub = $pub['id'];
            $comentarios = mysqli_query($connection, "SELECT c.*, u.usuario FROM comentarios c JOIN usuarios u ON c.id_usuario = u.id_cliente WHERE c.id_publicacion = $id_pub");
            while($com = mysqli_fetch_assoc($comentarios)) {
                echo "<p style='margin-left: 15px; font-size: 14px;'><strong>{$com['usuario']}:</strong> {$com['comentario']}</p>";
            }
            ?>
            <form action="../controllers/foroController.php" method="POST">
                <input type="hidden" name="id_publicacion" value="<?php echo $pub['id']; ?>">
                <input type="text" name="comentario" placeholder="Escribe un comentario..." required>
                <input type="submit" name="comentar" value="Comentar">
            </form>
        </div>
    <?php } ?>
</body>
</html>