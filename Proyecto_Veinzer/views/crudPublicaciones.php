<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Publicaciones - Admin</title>
    <style>
        .container { max-width: 1000px; width: 92%; margin: 40px auto; padding: 0; }
        .table-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 10px; }
        .table-header h2 { color: #fff; font-size: 1.8rem; }
        
        .table-responsive { width: 100%; background: #1e1e1e; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.5); }
        .crud-table { width: 100%; border-collapse: collapse; }
        .crud-table th, .crud-table td { padding: 14px 18px; text-align: left; border-bottom: 1px solid #2a2a2a; color: #e0e0e0; vertical-align: middle; }
        .crud-table th { background: #252525; color: #ff5722; font-weight: 600; text-transform: uppercase; font-size: 0.85rem; }
        .crud-table tr:hover { background: #242424; }
        .action-link.delete { color: #dc3545; text-decoration: none; font-weight: bold; }
        .action-link.delete:hover { text-decoration: underline; }
        .thumb-img { width: 50px; height: 50px; object-fit: cover; border-radius: 4px; border: 1px solid #333; }

        /* ==========================================================
           RESPONSIVE PARA TABLETS Y CELULARES (Menor o igual a 1024px)
           Transforma cada publicación en un CUADRADO / TARJETÓN INDEPENDIENTE
           ========================================================== */
        @media (max-width: 1024px) {
            .container { width: 95% !important; margin: 20px auto !important; }
            .table-header h2 { font-size: 1.5rem; }
            
            /* Ocultamos la cabecera tradicional */
            .crud-table thead { display: none; }
            
            .table-responsive { background: transparent; box-shadow: none; overflow: visible; }
            .crud-table, .crud-table tbody, .crud-table tr, .crud-table td { display: block; width: 100%; }
            
            /* Cada publicación se convierte en una tarjeta independiente */
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
                padding-top: 15px;
            }
            
            /* Etiquetas automáticas con data-label */
            .crud-table td::before {
                content: attr(data-label);
                font-weight: bold;
                color: #ff5722;
                text-transform: uppercase;
                font-size: 0.8rem;
                text-align: left;
            }
            
            .thumb-img { width: 60px; height: 60px; }
        }
    </style>
</head>
<body>
    <div class="main-wrapper">
        <?php include('nav.php'); ?>

        <div class="container">
            <div class="table-header">
                <h2>Panel CRUD - Publicaciones (Admin)</h2>
            </div>

            <div class="table-responsive">
                <table class="crud-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Autor</th>
                            <th>Contenido</th>
                            <th>Imagen</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($resultado_crud_posts) && mysqli_num_rows($resultado_crud_posts) > 0) { ?>
                            <?php while ($row = mysqli_fetch_assoc($resultado_crud_posts)) { ?>
                            <tr>
                                <td data-label="ID"><?php echo $row['id']; ?></td>
                                <td data-label="Autor"><strong><?php echo htmlspecialchars($row['usuario']); ?></strong></td>
                                <td data-label="Contenido"><?php echo htmlspecialchars(substr($row['contenido'], 0, 50)) . (strlen($row['contenido']) > 50 ? '...' : ''); ?></td>
                                <td data-label="Imagen">
                                    <?php if (!empty($row['imagen'])): ?>
                                        <img src="../uploads/<?php echo htmlspecialchars($row['imagen']); ?>" alt="Post img" class="thumb-img">
                                    <?php else: ?>
                                        <span style="color:#666; font-size:0.85rem;">Sin imagen</span>
                                    <?php endif; ?>
                                </td>
                                <td data-label="Fecha"><?php echo $row['fecha']; ?></td>
                                <td data-label="Acciones">
                                    <a href="crudPublicacionesController.php?eliminar=<?php echo $row['id']; ?>" onclick="return confirm('¿Estás seguro de eliminar esta publicación?');" style="color: #dc3545; text-decoration: none; font-weight: bold;" title="Eliminar">
                                        <i class="fa-solid fa-trash"></i> Eliminar
                                    </a>                        
                                </td>
                            </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="6" style="text-align: center; color: #777; display: block;">No hay publicaciones registradas.</td>
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