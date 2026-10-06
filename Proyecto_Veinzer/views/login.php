<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión - Veinzer</title>
</head>
<body>
    <h2>Iniciar Sesión</h2>
    <form action="../controllers/loginController.php" method="POST">
        <label>Usuario:</label><br>
        <input type="text" name="usuario" required><br><br>

        <label>Contraseña:</label><br>
        <input type="password" name="password" required><br><br>

        <input type="submit" value="Ingresar">
    </form>
</body>
</html>