<?php
include('../db/db.php');

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
    <h2>Lista de Usuarios Registrados</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Usuario</th>
            <th>Correo</th>
            <th>Teléfono</th>
            <th>Rol</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($resultado)) { ?>
        <tr>
            <td><?php echo $row['id_cliente']; ?></td>
            <td><?php echo $row['usuario']; ?></td>
            <td><?php echo $row['correo']; ?></td>
            <td><?php echo $row['telefono']; ?></td>
            <td><?php echo $row['rol']; ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
<?php
mysqli_close($connection);
?>