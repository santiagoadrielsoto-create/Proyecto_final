<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (!isset($_SESSION['usuario'])) { header("Location: login.php"); exit(); }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Recomendaciones y Rutinas Detalladas - Veinzer</title>
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
        
        /* Secciones de Rutinas Detalladas */
        .routine-section { background: #252525; padding: 25px; border-radius: 10px; margin-bottom: 25px; border-left: 4px solid #007bff; }
        .routine-section.volumen { border-left-color: #28a745; }
        .routine-section.definicion { border-left-color: #ffc107; }
        .routine-section.fuerza { border-left-color: #17a2b8; }
        .routine-section h3 { color: #fff; font-size: 1.4rem; margin-bottom: 10px; }
        .routine-section p.desc { color: #aaa; font-size: 0.95rem; margin-bottom: 15px; }
        
        /* Listado de Ejercicios */
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
                <!-- Si NO tiene datos físicos cargados -->
                <div class="rec-card">
                    <div class="alert-box">
                        <h3>¡Faltan tus datos físicos!</h3>
                        <p>Para poder ofrecerte rutinas de entrenamiento adaptadas exactamente a tu peso, altura y objetivos, primero necesitamos conocerte mejor.</p>
                        <a href="datosFisicosController.php" class="btn-action">Ingresar Mis Datos Ahora</a>
                    </div>
                </div>
            <?php } else { ?>
                <!-- Si SÍ tiene datos cargados -->
                <div class="rec-card">
                    <h2>Catálogo de Rutinas Especializadas</h2>
                    <div class="user-stats">
                        <div>Altura: <span><?php echo $datos_fisicos['altura']; ?> m</span></div>
                        <div>Peso: <span><?php echo $datos_fisicos['peso']; ?> kg</span></div>
                        <div>Edad: <span><?php echo $datos_fisicos['edad']; ?> años</span></div>
                        <div>Actividad: <span><?php echo htmlspecialchars($datos_fisicos['actividad']); ?></span></div>
                    </div>
                    <p>En base a tu perfil, te presentamos rutinas altamente detalladas con ejercicios reales, series, repeticiones y enlaces directos a videos explicativos de técnica:</p>

                    <!-- OPCIÓN 1: VOLUMEN -->
                    <div class="routine-section volumen">
                        <h3>1. Rutina de Hipertrofia y Volumen Muscular</h3>
                        <p class="desc">Enfoque en sobrecarga progresiva. Descansa de 2 a 3 minutos entre series pesadas.</p>
                        <ul class="exercise-list">
                            <li class="exercise-item">
                                <div class="exercise-info">
                                    <h5>Press de Banca Plano con Barra</h5>
                                    <span>4 series x 8-10 repeticiones (Pecho y Tríceps)</span>
                                </div>
                                <a href="https://www.youtube.com/watch?v=gRVjAtPip0Y" target="_blank" class="yt-link">▶ Ver Técnica</a>
                            </li>
                            <li class="exercise-item">
                                <div class="exercise-info">
                                    <h5>Sentadilla Libre con Barra</h5>
                                    <span>4 series x 6-8 repeticiones (Cuádriceps y Glúteos)</span>
                                </div>
                                <a href="https://www.youtube.com/watch?v=nTehyq_X8g0" target="_blank" class="yt-link">▶ Ver Técnica</a>
                            </li>
                            <li class="exercise-item">
                                <div class="exercise-info">
                                    <h5>Dominadas Lastradas o Libres</h5>
                                    <span>3 series x al fallo técnico (Espalda y Bíceps)</span>
                                </div>
                                <a href="https://www.youtube.com/watch?v=eGo4IYlbE5g" target="_blank" class="yt-link">▶ Ver Técnica</a>
                            </li>
                            <li class="exercise-item">
                                <div class="exercise-info">
                                    <h5>Press Militar con Barra de Pie</h5>
                                    <span>3 series x 8-10 repeticiones (Hombros)</span>
                                </div>
                                <a href="https://www.youtube.com/watch?v=2yjw-jA0Ie8" target="_blank" class="yt-link">▶ Ver Técnica</a>
                            </li>
                        </ul>
                    </div>

                    <!-- OPCIÓN 2: DEFINICIÓN -->
                    <div class="routine-section definicion">
                        <h3>2. Rutina de Definición y Quema de Grasa</h3>
                        <p class="desc">Ritmo dinámico con superseries y menor tiempo de descanso (60-90 segundos) para maximizar gasto calórico.</p>
                        <ul class="exercise-list">
                            <li class="exercise-item">
                                <div class="exercise-info">
                                    <h5>Peso Muerto Rumano con Mancuernas</h5>
                                    <span>4 series x 12 repeticiones (Isquiotibiales y Glúteos)</span>
                                </div>
                                <a href="https://www.youtube.com/watch?v=JCXfY_yPpiM" target="_blank" class="yt-link">▶ Ver Técnica</a>
                            </li>
                            <li class="exercise-item">
                                <div class="exercise-info">
                                    <h5>Remo con Barra Inclinado</h5>
                                    <span>4 series x 12 repeticiones (Espalda alta)</span>
                                </div>
                                <a href="https://www.youtube.com/watch?v=VK2gC6W672I" target="_blank" class="yt-link">▶ Ver Técnica</a>
                            </li>
                            <li class="exercise-item">
                                <div class="exercise-info">
                                    <h5>Zancadas Caminando (Lunges)</h5>
                                    <span>3 series x 20 pasos totales (Piernas)</span>
                                </div>
                                <a href="https://www.youtube.com/watch?v=D7KaRcUTQeE" target="_blank" class="yt-link">▶ Ver Técnica</a>
                            </li>
                            <li class="exercise-item">
                                <div class="exercise-info">
                                    <h5>Plancha Abdominal Isométrica</h5>
                                    <span>3 series x 45 segundos (Core)</span>
                                </div>
                                <a href="https://www.youtube.com/watch?v=ASdvN_XEl_c" target="_blank" class="yt-link">▶ Ver Técnica</a>
                            </li>
                        </ul>
                    </div>

                    <!-- OPCIÓN 3: FUERZA PURA -->
                    <div class="routine-section fuerza">
                        <h3>3. Rutina de Fuerza Máxima (Powerbuilding)</h3>
                        <p class="desc">Bajas repeticiones, alta intensidad y descansos prolongados (3 a 4 minutos).</p>
                        <ul class="exercise-list">
                            <li class="exercise-item">
                                <div class="exercise-info">
                                    <h5>Peso Muerto Convencional</h5>
                                    <span>5 series x 5 repeticiones (Fuerza general)</span>
                                </div>
                                <a href="https://www.youtube.com/watch?v=op9kVnSso6Q" target="_blank" class="yt-link">▶ Ver Técnica</a>
                            </li>
                            <li class="exercise-item">
                                <div class="exercise-info">
                                    <h5>Press de Banca Inclinado</h5>
                                    <span>4 series x 6 repeticiones (Pecho superior)</span>
                                </div>
                                <a href="https://www.youtube.com/watch?v=Srqx_Zs3acg" target="_blank" class="yt-link">▶ Ver Técnica</a>
                            </li>
                            <li class="exercise-item">
                                <div class="exercise-info">
                                    <h5>Fondos en Paralelas (Dips)</h5>
                                    <span>3 series x 8 repeticiones (Tríceps y Pecho)</span>
                                </div>
                                <a href="https://www.youtube.com/watch?v=2z8JmcrW-As" target="_blank" class="yt-link">▶ Ver Técnica</a>
                            </li>
                        </ul>
                    </div>

                    <div style="margin-top: 25px; text-align: center;">
                        <a href="datosFisicosController.php" class="btn-action" style="background: #444; font-size: 0.9rem; padding: 10px 20px;">Modificar mis datos físicos</a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <?php include('footer.php'); ?>
</body>
</html>