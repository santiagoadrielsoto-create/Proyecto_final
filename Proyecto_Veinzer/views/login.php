<?php if (session_status() === PHP_SESSION_NONE) { session_start(); } ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión - Veinzer</title>
    <style>
        body { background: #121212; display: flex; justify-content: center; align-items: center; height: 100vh; font-family: 'Segoe UI', Tahoma, sans-serif; color: #fff; }
        .login-card { background: #1e1e1e; padding: 40px; border-radius: 12px; box-shadow: 0 8px 24px rgba(0,0,0,0.6); width: 100%; max-width: 400px; border-top: 4px solid #ff5722; }
        h2 { margin-bottom: 25px; font-size: 1.8rem; text-align: center; }
        label { display: block; margin-bottom: 8px; color: #aaa; font-size: 0.9rem; }
        input[type="text"], input[type="password"] { width: 100%; padding: 12px; background: #2a2a2a; border: 1px solid #3d3d3d; border-radius: 6px; color: #fff; margin-bottom: 20px; font-size: 1rem; }
        input:focus { outline: none; border-color: #ff5722; }
        .btn-submit { width: 100%; background: #ff5722; color: #fff; padding: 12px; border: none; border-radius: 6px; font-size: 1rem; font-weight: bold; cursor: pointer; transition: background 0.3s; }
        .btn-submit:hover { background: #e64a19; }
        .footer-link { text-align: center; margin-top: 20px; font-size: 0.9rem; color: #888; }
        .footer-link a { color: #ff5722; text-decoration: none; }
    </style>
</head>
<body>
    <div class="login-card">
        <h2>Iniciar Sesión</h2>
        <form action="../controllers/loginController.php" method="POST">
            <label>Usuario</label>
            <input type="text" name="usuario" required autocomplete="off">

            <label>Contraseña</label>
            <input type="password" name="password" required>

            <button type="submit" class="btn-submit">Ingresar</button>
        </form>
        <div class="footer-link">
            ¿No tienes cuenta? <a href="registrar.php">Regístrate aquí</a>
        </div>
    </div>
</body>
</html>