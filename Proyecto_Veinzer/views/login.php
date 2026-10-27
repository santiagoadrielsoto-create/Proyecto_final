<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión - Veinzer</title>
    <style>
        body { background-color: #121212; color: #e0e0e0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .login-card { background: #1e1e1e; padding: 40px; border-radius: 12px; box-shadow: 0 8px 25px rgba(0,0,0,0.6); border-top: 5px solid #ff5722; width: 100%; max-width: 400px; text-align: center; }
        .login-card h2 { color: #fff; margin-bottom: 25px; font-size: 1.8rem; }
        .form-group { margin-bottom: 20px; text-align: left; }
        .form-group label { display: block; color: #aaa; font-size: 0.9rem; margin-bottom: 6px; }
        .form-control { width: 100%; padding: 12px; background: #2a2a2a; border: 1px solid #3a3a3a; border-radius: 6px; color: #fff; font-size: 0.95rem; }
        .form-control:focus { outline: none; border-color: #ff5722; }
        .btn-submit { width: 100%; background: #ff5722; color: #fff; border: none; padding: 12px; border-radius: 6px; font-weight: bold; font-size: 1rem; cursor: pointer; transition: background 0.3s; margin-top: 10px; }
        .btn-submit:hover { background: #e64a19; }
        .login-footer { margin-top: 20px; font-size: 0.9rem; color: #888; }
        .login-footer a { color: #ff5722; text-decoration: none; }
        .login-footer a:hover { text-decoration: underline; }
    </style>
</head>
<body>

    <div class="login-card">
        <h2>Iniciar Sesión</h2>
        <form action="../controllers/loginController.php" method="POST">
            <div class="form-group">
                <label>Correo Electrónico</label>
                <input type="email" name="correo" class="form-control" required placeholder="ejemplo@gmail.com">
            </div>
            <div class="form-group">
                <label>Contraseña</label>
                <input type="password" name="password" class="form-control" required placeholder="********">
            </div>
            <button type="submit" name="ingresar" class="btn-submit">Ingresar</button>
        </form>
        <div class="login-footer">
            ¿No tienes cuenta? <a href="registrar.php">Regístrate aquí</a>
        </div>
    </div>

</body>
</html>