<?php
include('../db/db.php');


if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    mysqli_query($connection, "DELETE FROM usuarios WHERE id_cliente = $id");
    header("Location: crudController.php");
    exit();
}

$query = "SELECT * FROM usuarios";
$resultado = mysqli_query($connection, $query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>CRUD - Listado de Usuarios</title>
</head>
<body>
    <?php include('../views/nav.php'); ?>
    <h2>Gestión de Usuarios (CRUD)</h2>
    <a href="../views/registrar.php">+ Crear Nuevo Usuario</a><br><br>
    
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Usuario</th>
            <th>Correo</th>
            <th>Teléfono</th>
            <th>Rol</th>
            <th>Acciones</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($resultado)) { ?>
        <tr>
            <td><?php echo $row['id_cliente']; ?></td>
            <td><?php echo $row['usuario']; ?></td>
            <td><?php echo $row['correo']; ?></td>
            <td><?php echo $row['telefono']; ?></td>
            <td><?php echo $row['rol']; ?></td>
            <td>
                <a href="../views/editarUsuario.php?id=<?php echo $row['id_cliente']; ?>">Modificar</a> | 
                <a href="crudController.php?eliminar=<?php echo $row['id_cliente']; ?>" onclick="return confirm('¿Seguro que deseas eliminar este usuario?');">Eliminar</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
<?php mysqli_close($connection); ?>