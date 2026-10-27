<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (!isset($_SESSION['usuario'])) { header("Location: login.php"); exit(); }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ingresar Datos Físicos - Veinzer</title>
    <style>
        .form-container { max-width: 500px; margin: 40px auto; padding: 0 20px; }
        .form-card { background: #1e1e1e; padding: 40px; border-radius: 12px; box-shadow: 0 8px 25px rgba(0,0,0,0.6); border-top: 5px solid #ff5722; }
        .form-card h2 { color: #fff; margin-bottom: 25px; font-size: 1.8rem; text-align: center; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; color: #aaa; font-size: 0.9rem; margin-bottom: 6px; }
        .form-control { width: 100%; padding: 12px; background: #2a2a2a; border: 1px solid #3a3a3a; border-radius: 6px; color: #fff; font-size: 0.95rem; box-sizing: border-box; }
        .form-control:focus { outline: none; border-color: #ff5722; }
        .btn-submit { width: 100%; background: #ff5722; color: #fff; border: none; padding: 12px; border-radius: 6px; font-weight: bold; font-size: 1rem; cursor: pointer; transition: background 0.3s; margin-top: 10px; }
        .btn-submit:hover { background: #e64a19; }
    </style>
</head>
<body>
    <div class="main-wrapper">
        <?php include('nav.php'); ?>

        <div class="form-container">
            <div class="form-card">
                <h2>Mis Datos Físicos</h2>
                <form action="../controllers/datosFisicosController.php" method="POST">
                    <div class="form-group">
                        <label>Altura (en metros, ej: 1.75)</label>
                        <input type="number" step="0.01" name="altura" class="form-control" value="<?php echo $datos_fisicos['altura'] ?? ''; ?>" required placeholder="Ej: 1.75">
                    </div>
                    <div class="form-group">
                        <label>Peso (en kg, ej: 70.5)</label>
                        <input type="number" step="0.1" name="peso" class="form-control" value="<?php echo $datos_fisicos['peso'] ?? ''; ?>" required placeholder="Ej: 70.5">
                    </div>
                    <div class="form-group">
                        <label>Edad</label>
                        <input type="number" name="edad" class="form-control" value="<?php echo $datos_fisicos['edad'] ?? ''; ?>" required placeholder="Ej: 20">
                    </div>
                    <div class="form-group">
                        <label>Nivel de Actividad Física</label>
                        <select name="actividad" class="form-control" required>
                            <option value="">Selecciona una opción</option>
                            <option value="Sedentario" <?php if(($datos_fisicos['actividad'] ?? '') == 'Sedentario') echo 'selected'; ?>>Sedentario (Poco o ningún ejercicio)</option>
                            <option value="Ligero" <?php if(($datos_fisicos['actividad'] ?? '') == 'Ligero') echo 'selected'; ?>>Ligero (Ejercicio 1-3 días/semana)</option>
                            <option value="Moderado" <?php if(($datos_fisicos['actividad'] ?? '') == 'Moderado') echo 'selected'; ?>>Moderado (Ejercicio 3-5 días/semana)</option>
                            <option value="Intenso" <?php if(($datos_fisicos['actividad'] ?? '') == 'Intenso') echo 'selected'; ?>>Intenso (Ejercicio 6-7 días/semana)</option>
                        </select>
                    </div>
                    <button type="submit" name="guardar_datos" class="btn-submit">Guardar Datos</button>
                </form>
            </div>
        </div>
    </div>

    <?php include('footer.php'); ?>
</body>
</html>