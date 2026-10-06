<?php
include('../db/db.php');
$id = $_GET['id'];
$resultado = mysqli_query($connection, "SELECT * FROM usuarios WHERE id_cliente = $id");
$usuario = mysqli_fetch_assoc($resultado);
?>
<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Modificar Usuario</title></head>
<body>
    <h2>Modificar Datos de Usuario</h2>
    <form action="../controllers/editarController.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $usuario['id_cliente']; ?>">
        <label>Usuario:</label><br><input type="text" name="usuario" value="<?php echo $usuario['usuario']; ?>" required><br><br>
        <label>Correo:</label><br><input type="email" name="correo" value="<?php echo $usuario['correo']; ?>" required><br><br>
        <label>Teléfono:</label><br><input type="text" name="telefono" value="<?php echo $usuario['telefono']; ?>" required><br><br>
        <label>Rol:</label><br><input type="text" name="rol" value="<?php echo $usuario['rol']; ?>" required><br><br>
        <input type="submit" value="Guardar Cambios">
    </form>
</body>
</html>