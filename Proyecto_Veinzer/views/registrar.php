<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro - Veinzer</title>
</head>
<body>
    <h2>Registro de Usuarios</h2>
    <form action="../controllers/registroController.php" method="POST">
        <label>Usuario:</label><br>
        <input type="text" name="nombre" required><br><br>

        <label>Correo:</label><br>
        <input type="email" name="correo" required><br><br>

        <label>Teléfono:</label><br>
        <input type="text" name="telefono" required><br><br>

        <label>Contraseña:</label><br>
        <input type="password" name="contra" required><br><br>

        <input type="submit" value="Registrar">
    </form>
</body>
</html>