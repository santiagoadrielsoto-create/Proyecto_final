<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (!isset($_SESSION['usuario'])) { header("Location: login.php"); exit(); }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Flexibilidad y Yoga - Veinzer</title>
    <style>
        .rec-container { max-width: 1000px; margin: 40px auto; padding: 0 20px; }
        .rec-card { background: #1e1e1e; padding: 35px; border-radius: 12px; box-shadow: 0 8px 25px rgba(0,0,0,0.6); border-top: 5px solid #28a745; margin-bottom: 30px; }
        .rec-card h2 { color: #fff; margin-bottom: 15px; font-size: 2rem; }
        .rec-card p { color: #ccc; font-size: 1rem; line-height: 1.5; margin-bottom: 20px; }
        .alert-box { background: #252525; border-left: 4px solid #ffc107; padding: 25px; border-radius: 8px; text-align: center; }
        .alert-box h3 { color: #ffc107; margin-bottom: 10px; font-size: 1.4rem; }
        .alert-box p { color: #bbb; margin-bottom: 20px; }
        .btn-action { display: inline-block; background: #ff5722; color: #fff; padding: 12px 25px; border-radius: 6px; text-decoration: none; font-weight: bold; transition: background 0.3s; }
        .btn-action:hover { background: #e64a19; }
        
        .routine-section { background: #252525; padding: 25px; border-radius: 10px; margin-bottom: 25px; border-left: 4px solid #28a745; }
        .routine-section h3 { color: #fff; font-size: 1.4rem; margin-bottom: 10px; }
        .routine-section p.desc { color: #aaa; font-size: 0.95rem; margin-bottom: 15px; }
        
        .exercise-list { list-style: none; padding: 0; }
        .exercise-item { background: #1e1e1e; padding: 12px 18px; border-radius: 6px; margin-bottom: 10px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px; border: 1px solid #333; }
        .exercise-info h5 { color: #fff; font-size: 1rem; margin-bottom: 4px; }
        .exercise-info span { color: #888; font-size: 0.85rem; }
        .yt-link { background: #cc0000; color: #fff; padding: 6px 12px; border-radius: 4px; text-decoration: none; font-size: 0.85rem; font-weight: bold; transition: background 0.3s; display: inline-flex; align-items: center; gap: 5px; }
        .yt-link:hover { background: #990000; }
        .user-stats { background: #252525; padding: 15px; border-radius: 8px; margin-bottom: 20px; display: flex; justify-content: space-around; flex-wrap: wrap; color: #fff; font-size: 0.95rem; }
        .user-stats span { color: #ff5722; font-weight: bold; }
    </style>
</head>
<body>
    <div class="main-wrapper">
        <?php include('nav.php'); ?>

        <div class="rec-container">
            <?php if (!$datos_fisicos) { ?>
                <div class="rec-card">
                    <div class="alert-box">
                        <h3>¡Faltan tus datos físicos!</h3>
                        <p>Para adaptar las sesiones de movilidad y postura según tu constitución corporal, ingresa tus datos primero.</p>
                        <a href="datosFisicosController.php" class="btn-action">Ingresar Mis Datos Ahora</a>
                    </div>
                </div>
            <?php } else { ?>
                <div class="rec-card">
                    <h2>Flexibilidad, Movilidad y Yoga</h2>
                    <div class="user-stats">
                        <div>Altura: <span><?php echo $datos_fisicos['altura']; ?> m</span></div>
                        <div>Peso: <span><?php echo $datos_fisicos['peso']; ?> kg</span></div>
                        <div>Edad: <span><?php echo $datos_fisicos['edad']; ?> años</span></div>
                        <div>Actividad: <span><?php echo htmlspecialchars($datos_fisicos['actividad']); ?></span></div>
                    </div>
                    <p>Sesiones enfocadas en prevención de lesiones, despresurizar columna y mejorar postura:</p>

                    <!-- SESION YOGA DESPRESURIZACION -->
                    <div class="routine-section">
                        <h3>1. Yoga Postural y Movilidad Articular</h3>
                        <p class="desc">Sostener cada postura durante 5 a 8 respiraciones profundas e inhalaciones controladas.</p>
                        <ul class="exercise-list">
                            <li class="exercise-item">
                                <div class="exercise-info">
                                    <h5>Perro Boca Abajo (Adho Mukha Svanasana)</h5>
                                    <span>Estiramiento profundo de cadena posterior y descompresión lumbar</span>
                                </div>
                                <a href="https://www.youtube.com/watch?v=EC7RGJ94528" target="_blank" class="yt-link">▶ Ver Postura</a>
                            </li>
                            <li class="exercise-item">
                                <div class="exercise-info">
                                    <h5>Postura de la Cobras (Bhujangasana)</h5>
                                    <span>Apertura de pecho y fortalecimiento de espalda baja</span>
                                </div>
                                <a href="https://www.youtube.com/watch?v=fO3An87P_0c" target="_blank" class="yt-link">▶ Ver Postura</a>
                            </li>
                            <li class="exercise-item">
                                <div class="exercise-info">
                                    <h5>Postura del Niño (Balasana)</h5>
                                    <span>Relajación articular, caderas y descompresión espinal</span>
                                </div>
                                <a href="https://www.youtube.com/watch?v=2MJGg-dUKh0" target="_blank" class="yt-link">▶ Ver Postura</a>
                            </li>
                        </ul>
                    </div>

                    <!-- SESION MOVILIDAD ARTICULAR -->
                    <div class="routine-section" style="border-left-color: #17a2b8;">
                        <h3>2. Rutina de Movilidad y Flexibilidad para Deportistas</h3>
                        <p class="desc">Ideal para realizar al terminar sesiones intensas de fuerza o cardio.</p>
                        <ul class="exercise-list">
                            <li class="exercise-item">
                                <div class="exercise-info">
                                    <h5>Estiramiento Dinámico de Isquiotibiales y Caderas</h5>
                                    <span>Flexibilidad dinámica de tren inferior</span>
                                </div>
                                <a href="https://www.youtube.com/watch?v=v7SN-d4qL4M" target="_blank" class="yt-link">▶ Ver Técnica</a>
                            </li>
                        </ul>
                    </div>

                    <div style="text-align: center; margin-top: 25px;">
                        <a href="datosFisicosController.php" class="btn-action" style="background: #444; font-size: 0.9rem; padding: 10px 20px;">Modificar mis datos físicos</a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <?php include('footer.php'); ?>
</body>
</html>