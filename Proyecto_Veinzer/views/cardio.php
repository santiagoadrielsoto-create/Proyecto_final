<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (!isset($_SESSION['usuario'])) { header("Location: login.php"); exit(); }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="icon" type="image/x-icon" href="/Proyecto_Veinzer/assets/img/favicon.ico">
    <meta charset="UTF-8">
    <title>Cardio y Resistencia - Veinzer</title>
    <style>
        .rec-container { max-width: 1000px; margin: 40px auto; padding: 0 20px; }
        .rec-card { background: #1e1e1e; padding: 35px; border-radius: 12px; box-shadow: 0 8px 25px rgba(0,0,0,0.6); border-top: 5px solid #ff5722; margin-bottom: 30px; }
        .rec-card h2 { color: #fff; margin-bottom: 15px; font-size: 2rem; }
        .rec-card p { color: #ccc; font-size: 1rem; line-height: 1.5; margin-bottom: 20px; }
        .alert-box { background: #252525; border-left: 4px solid #ffc107; padding: 25px; border-radius: 8px; text-align: center; }
        .alert-box h3 { color: #ffc107; margin-bottom: 10px; font-size: 1.4rem; }
        .alert-box p { color: #bbb; margin-bottom: 20px; }
        .btn-action { display: inline-block; background: #ff5722; color: #fff; padding: 12px 25px; border-radius: 6px; text-decoration: none; font-weight: bold; transition: background 0.3s; }
        .btn-action:hover { background: #e64a19; }
        
        .routine-section { background: #252525; padding: 25px; border-radius: 10px; margin-bottom: 25px; border-left: 4px solid #ff5722; }
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
                        <p>Para sugerirte la mejor rutina aeróbica según tu edad, altura y peso, primero ingresa tus datos físicos.</p>
                        <a href="datosFisicosController.php" class="btn-action">Ingresar Mis Datos Ahora</a>
                    </div>
                </div>
            <?php } else { ?>
                <div class="rec-card">
                    <h2>Entrenamiento de Cardio y Resistencia</h2>
                    <div class="user-stats">
                        <div>Altura: <span><?php echo $datos_fisicos['altura']; ?> m</span></div>
                        <div>Peso: <span><?php echo $datos_fisicos['peso']; ?> kg</span></div>
                        <div>Edad: <span><?php echo $datos_fisicos['edad']; ?> años</span></div>
                        <div>Actividad: <span><?php echo htmlspecialchars($datos_fisicos['actividad']); ?></span></div>
                    </div>
                    <p>Rutinas orientadas a mejorar tu capacidad pulmonar, quema de grasa y resistencia cardiovascular:</p>

                    <!-- RUTINA HIIT -->
                    <div class="routine-section">
                        <h3>1. Rutina HIIT de Alta Intensidad (Quema Grasa Rapida)</h3>
                        <p class="desc">30 segundos de trabajo activo x 15 segundos de descanso por ejercicio. Realizar 4 rondas.</p>
                        <ul class="exercise-list">
                            <li class="exercise-item">
                                <div class="exercise-info">
                                    <h5>Burpees Completos</h5>
                                    <span>Ejercicio de cuerpo entero para elevación de ritmo cardíaco</span>
                                </div>
                                <a href="https://www.youtube.com/watch?v=auBLPXO8F6U" target="_blank" class="yt-link">▶ Ver Técnica</a>
                            </li>
                            <li class="exercise-item">
                                <div class="exercise-info">
                                    <h5>Mountain Climbers (Escaladores)</h5>
                                    <span>Trabajo aeróbico y fortalecimiento del core</span>
                                </div>
                                <a href="https://www.youtube.com/watch?v=nmwgirgXLYM" target="_blank" class="yt-link">▶ Ver Técnica</a>
                            </li>
                            <li class="exercise-item">
                                <div class="exercise-info">
                                    <h5>Jumping Jacks (Saltos de Tijera)</h5>
                                    <span>Cardio continuo de bajo impacto articular</span>
                                </div>
                                <a href="https://www.youtube.com/watch?v=iSSAk4Xo2X8" target="_blank" class="yt-link">▶ Ver Técnica</a>
                            </li>
                        </ul>
                    </div>

                    <!-- RESISTENCIA MODERADA -->
                    <div class="routine-section" style="border-left-color: #007bff;">
                        <h3>2. Rutina de Resistencia LISS (Bajo Impacto / Larga Duración)</h3>
                        <p class="desc">Ideal para recuperación activa o personas que inician. Mantener pulso estable durante 30-40 mins.</p>
                        <ul class="exercise-list">
                            <li class="exercise-item">
                                <div class="exercise-info">
                                    <h5>Caminata a Paso Ligero / Trote Suave</h5>
                                    <span>Mantener ritmo constante sin llegar al agotamiento total</span>
                                </div>
                                <a href="https://www.youtube.com/watch?v=brFHyOT685U" target="_blank" class="yt-link">▶ Ver Guía</a>
                            </li>
                            <li class="exercise-item">
                                <div class="exercise-info">
                                    <h5>Salto con Cuerda (Soga)</h5>
                                    <span>10 series de 1 minuto continuo con 30 segs de descanso</span>
                                </div>
                                <a href="https://www.youtube.com/watch?v=u3zgHI8QnqE" target="_blank" class="yt-link">▶ Ver Técnica</a>
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