<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
$es_admin = isset($_SESSION['rol']) && (strtolower($_SESSION['rol']) === 'admin');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>CRUD - Listado de Usuarios</title>
    <style>
        .container { max-width: 1000px; margin: 40px auto; padding: 0 20px; }
        .table-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .table-header h2 { color: #fff; font-size: 1.8rem; }
        .btn-create { background: #28a745; color: #fff; padding: 10px 18px; text-decoration: none; border-radius: 6px; font-weight: bold; }
        .crud-table { width: 100%; border-collapse: collapse; background: #1e1e1e; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.5); }
        .crud-table th, .crud-table td { padding: 14px 18px; text-align: left; border-bottom: 1px solid #2a2a2a; }
        .crud-table th { background: #252525; color: #ff5722; font-weight: 600; text-transform: uppercase; font-size: 0.85rem; }
        .crud-table tr:hover { background: #242424; }
        .action-link { color: #007bff; text-decoration: none; font-weight: 500; margin-right: 8px; }
        .action-link.edit { color: #ffc107; }
        .action-link.delete { color: #dc3545; }
        .action-link:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="main-wrapper">
        <?php include('nav.php'); ?>

        <div class="container">
            <div class="table-header">
                <h2>Gestión de Usuarios</h2>
                <?php if ($es_admin): ?>
                    <a href="registrar.php" class="btn-create">+ Crear Usuario</a>
                <?php endif; ?>
            </div>

            <table class="crud-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Correo</th>
                        <th>Teléfono</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($resultado)) { ?>
                    <tr>
                        <td><?php echo $row['id_cliente']; ?></td>
                        <td><strong><?php echo htmlspecialchars($row['usuario']); ?></strong></td>
                        <td><?php echo htmlspecialchars($row['correo']); ?></td>
                        <td><?php echo htmlspecialchars($row['telefono']); ?></td>
                        <td><span style="background:#333; padding:3px 8px; border-radius:4px; font-size:0.85rem; color:#aaa;"><?php echo htmlspecialchars($row['rol']); ?></span></td>
                        <td>
                            <a href="verPerfilController.php?id=<?php echo $row['id_cliente']; ?>" class="action-link">Ver perfil</a>
                            <?php if ($es_admin): ?>
                                | <a href="editarController.php?id=<?php echo $row['id_cliente']; ?>" class="action-link edit">Modificar</a> 
                                | <a href="crudController.php?eliminar=<?php echo $row['id_cliente']; ?>" onclick="return confirm('¿Eliminar usuario?');" class="action-link delete">Eliminar</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php include('footer.php'); ?>
</body>
</html>