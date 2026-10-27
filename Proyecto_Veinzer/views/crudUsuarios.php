<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
$es_admin = isset($_SESSION['rol']) && (strtolower($_SESSION['rol']) === 'admin');
$id_sesion = $_SESSION['id_usuario'] ?? 0;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - Listado de Usuarios</title>
    <style>
        .container { max-width: 1050px; width: 92%; margin: 40px auto; padding: 0; }
        .table-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 10px; }
        .table-header h2 { color: #fff; font-size: 1.8rem; }
        .btn-create { background: #28a745; color: #fff; padding: 10px 18px; text-decoration: none; border-radius: 6px; font-weight: bold; transition: background 0.3s; }
        .btn-create:hover { background: #218838; }
        
        /* Contenedor de la tabla tradicional para PC */
        .table-responsive { width: 100%; background: #1e1e1e; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.5); }
        .crud-table { width: 100%; border-collapse: collapse; }
        .crud-table th, .crud-table td { padding: 14px 18px; text-align: left; border-bottom: 1px solid #2a2a2a; vertical-align: middle; color: #e0e0e0; }
        .crud-table th { background: #252525; color: #ff5722; font-weight: 600; text-transform: uppercase; font-size: 0.85rem; }
        .crud-table tr:hover { background: #242424; }
        
        /* Estilo para el Avatar */
        .table-avatar { width: 40px; height: 40px; border-radius: 50%; object-fit: cover; border: 2px solid #ff5722; background: #252525; display: flex; align-items: center; justify-content: center; }
        .table-avatar i { font-size: 32px; color: #888; }

        .action-link { color: #007bff; text-decoration: none; font-weight: 500; margin-right: 8px; }
        .action-link.edit { color: #ffc107; }
        .action-link.delete { color: #dc3545; }
        .action-link:hover { text-decoration: underline; }

        /* ==========================================================
           RESPONSIVE PARA TABLETS Y CELULARES (Menor o igual a 1024px)
           Transforma cada fila de la tabla en un CUADRADO / TARJETÓN
           ========================================================== */
        @media (max-width: 1024px) {
            .container { width: 95% !important; margin: 20px auto !important; }
            .table-header h2 { font-size: 1.5rem; }
            
            /* Ocultamos la cabecera tradicional de la tabla */
            .crud-table thead { display: none; }
            
            .table-responsive { background: transparent; box-shadow: none; overflow: visible; }
            .crud-table, .crud-table tbody, .crud-table tr, .crud-table td { display: block; width: 100%; }
            
            /* Cada usuario se convierte en un tarjeta/cuadrado independiente */
            .crud-table tr {
                background: #1e1e1e !important;
                border: 1px solid #2a2a2a;
                border-top: 4px solid #ff5722;
                border-radius: 10px;
                margin-bottom: 20px;
                padding: 18px;
                box-shadow: 0 4px 15px rgba(0,0,0,0.5);
            }
            
            .crud-table td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 10px 0;
                border-bottom: 1px solid #282828;
                text-align: right;
            }
            
            .crud-table td:last-child {
                border-bottom: none;
                justify-content: flex-end;
                gap: 10px;
                padding-top: 15px;
            }
            
            /* Simulamos etiquetas con el atributo data-label antes de cada celda */
            .crud-table td::before {
                content: attr(data-label);
                font-weight: bold;
                color: #ff5722;
                text-transform: uppercase;
                font-size: 0.8rem;
                text-align: left;
            }
            
            .table-avatar { width: 50px; height: 50px; }
        }
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

            <div class="table-responsive">
                <table class="crud-table">
                    <thead>
                        <tr>
                            <th>Avatar</th>
                            <th>ID</th>
                            <th>Usuario</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>Rol</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($resultado)) { 
                            $es_usuario_actual = ($row['id_cliente'] == $id_sesion);
                            $es_fila_admin = (strtolower($row['rol']) === 'admin');
                        ?>
                        <tr>
                            <td data-label="Avatar">
                                <?php if (!empty($row['foto_perfil']) && file_exists("../uploads/" . $row['foto_perfil'])): ?>
                                    <img src="../uploads/<?php echo htmlspecialchars($row['foto_perfil']); ?>" alt="Avatar" class="table-avatar">
                                <?php else: ?>
                                    <div class="table-avatar"><i class="fa-solid fa-circle-user"></i></div>
                                <?php endif; ?>
                            </td>
                            <td data-label="ID"><?php echo $row['id_cliente']; ?></td>
                            <td data-label="Usuario"><strong><?php echo htmlspecialchars($row['usuario']); ?></strong></td>
                            <td data-label="Correo"><?php echo htmlspecialchars($row['correo']); ?></td>
                            <td data-label="Teléfono"><?php echo htmlspecialchars($row['telefono']); ?></td>
                            <td data-label="Rol"><span style="background:#333; padding:3px 8px; border-radius:4px; font-size:0.85rem; color:#aaa;"><?php echo htmlspecialchars($row['rol']); ?></span></td>
                            <td data-label="Acciones">
                                <a href="verPerfilController.php?id=<?php echo $row['id_cliente']; ?>" class="action-link">Ver perfil</a>
                                <?php if ($es_admin): ?>
                                    | <a href="editarController.php?id=<?php echo $row['id_cliente']; ?>" class="action-link edit">Modificar</a> 
                                    <?php if (!$es_usuario_actual && !$es_fila_admin): ?>
                                        <a href="crudController.php?eliminar=<?php echo $row['id_cliente']; ?>" onclick="return confirm('¿Estás seguro de eliminar este usuario?');" style="color: #dc3545; text-decoration: none; font-weight: bold; margin-left: 5px;" title="Eliminar">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>                                       
                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php include('footer.php'); ?>
</body>
</html>