<?php if (session_status() === PHP_SESSION_NONE) { session_start(); } ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro - Veinzer</title>
    <style>
        body { background: #121212; display: flex; justify-content: center; align-items: center; min-height: 100vh; font-family: 'Segoe UI', Tahoma, sans-serif; color: #fff; margin: 0; }
        .register-card { background: #1e1e1e; padding: 35px; border-radius: 12px; box-shadow: 0 8px 24px rgba(0,0,0,0.6); width: 100%; max-width: 420px; border-top: 4px solid #28a745; margin: 20px; }
        h2 { margin-bottom: 20px; font-size: 1.8rem; text-align: center; }
        label { display: block; margin-bottom: 6px; color: #aaa; font-size: 0.9rem; }
        input { width: 100%; padding: 10px; background: #2a2a2a; border: 1px solid #3d3d3d; border-radius: 6px; color: #fff; margin-bottom: 15px; font-size: 1rem; }
        input:focus { outline: none; border-color: #28a745; }
        .btn-submit { width: 100%; background: #28a745; color: #fff; padding: 12px; border: none; border-radius: 6px; font-size: 1rem; font-weight: bold; cursor: pointer; transition: background 0.3s; }
        .btn-submit:hover { background: #218838; }
        .footer-link { text-align: center; margin-top: 15px; font-size: 0.9rem; color: #888; }
        .footer-link a { color: #28a745; text-decoration: none; }
    </style>
</head>
<body>
    <div class="register-card">
        <h2>Registro de Usuario</h2>
        <form action="../controllers/registroController.php" method="POST">
            <label>Usuario</label>
            <input type="text" name="usuario" required autocomplete="off">

            <label>Contraseña</label>
            <input type="password" name="password" required>

            <label>Correo Electrónico</label>
            <input type="email" name="correo" required>

            <label>Teléfono</label>
            <input type="text" name="telefono" required>

            <button type="submit" name="registrar" class="btn-submit">Registrarse</button>
        </form>
        <div class="footer-link">
            ¿Ya tienes cuenta? <a href="login.php">Iniciar Sesión</a>
        </div>
    </div>
</body>
</html>