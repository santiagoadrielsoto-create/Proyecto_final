<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Usuario</title>
    <style>
        .edit-card { max-width: 450px; margin: 40px auto; background: #1e1e1e; padding: 30px; border-radius: 10px; border: 1px solid #2a2a2a; border-top: 4px solid #007bff; box-shadow: 0 8px 24px rgba(0,0,0,0.5); }
        .edit-card h2 { color: #fff; margin-bottom: 20px; text-align: center; }
        label { color: #aaa; font-size: 0.9rem; display: block; margin-bottom: 5px; }
        input[type="text"], input[type="email"] { width: 100%; padding: 10px; background: #2a2a2a; border: 1px solid #3a3a3a; border-radius: 6px; color: #fff; margin-bottom: 15px; }
        .btn-save { width: 100%; background: #007bff; color: #fff; padding: 12px; border: none; border-radius: 6px; font-weight: bold; cursor: pointer; }
        .btn-save:hover { background: #0056b3; }
    </style>
</head>
<body>
    <div class="main-wrapper">
        <?php include('nav.php'); ?>

        <div class="edit-card">
            <h2>Modificar Datos de Usuario</h2>
            <form action="../controllers/editarController.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $usuario_actual['id_cliente']; ?>">

                <label>Usuario:</label>
                <input type="text" name="usuario" value="<?php echo htmlspecialchars($usuario_actual['usuario'] ?? ''); ?>" required>

                <label>Correo:</label>
                <input type="email" name="correo" value="<?php echo htmlspecialchars($usuario_actual['correo'] ?? ''); ?>" required>

                <label>Teléfono:</label>
                <input type="text" name="telefono" value="<?php echo htmlspecialchars($usuario_actual['telefono'] ?? ''); ?>" required>

                <label>Rol:</label>
                <input type="text" value="<?php echo htmlspecialchars($usuario_actual['rol'] ?? ''); ?>" disabled style="opacity:0.6;">

                <button type="submit" name="actualizar" class="btn-save">Guardar Cambios</button>
            </form>
        </div>
    </div>

    <?php include('footer.php'); ?>
</body>
</html>