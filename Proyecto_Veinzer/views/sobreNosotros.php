<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre Nosotros - Veinzer</title>
    <style>
        .about-container { max-width: 950px; width: 92%; margin: 40px auto; padding: 0; }
        .about-card { background: #1e1e1e; border-radius: 12px; box-shadow: 0 8px 25px rgba(0,0,0,0.6); border-top: 5px solid #ff5722; overflow: hidden; margin-bottom: 30px; }
        
        /* Imagen grande de Gimnasio */
        .gym-banner { width: 100%; height: 320px; object-fit: cover; filter: brightness(0.75); border-bottom: 4px solid #ff5722; }
        
        .about-content { padding: 35px; }
        .about-card h2 { color: #fff; margin-bottom: 15px; font-size: 2rem; }
        
        /* CORREGIDO: Texto ordenado y alineado a la izquierda para evitar espacios raros en móvil */
        .about-card p { color: #ccc; font-size: 0.98rem; line-height: 1.7; margin-bottom: 20px; text-align: left; }
        
        .badges-info { display: flex; gap: 15px; margin-bottom: 30px; flex-wrap: wrap; }
        .badge-tag { background: #252525; padding: 8px 16px; border-radius: 6px; color: #ff5722; font-weight: bold; border: 1px solid #333; }
        
        /* Integrantes y Avatares */
        h3.team-title { color: #fff; font-size: 1.4rem; margin-bottom: 20px; border-left: 4px solid #ff5722; padding-left: 10px; }
        .team-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 20px; }
        .team-member { background: #252525; padding: 20px; border-radius: 10px; text-align: center; border: 1px solid #333; transition: transform 0.3s, border-color 0.3s; }
        .team-member:hover { transform: translateY(-5px); border-color: #ff5722; }
        
        .avatar-img { width: 100px; height: 100px; border-radius: 50%; object-fit: cover; object-position: center; border: 3px solid #ff5722; margin-bottom: 12px; background: #181818; box-shadow: 0 4px 10px rgba(0,0,0,0.5); }
        .team-member h4 { color: #fff; font-size: 1.1rem; margin: 0; }

        /* RESPONSIVE PARA TABLETS Y CELULARES */
        @media (max-width: 1024px) {
            .about-container { width: 95% !important; margin: 20px auto !important; }
            .about-content { padding: 20px !important; }
            .gym-banner { height: 200px !important; }
            .about-card h2 { font-size: 1.6rem; }
            .about-card p { font-size: 0.95rem; text-align: left !important; }
            .team-grid { grid-template-columns: repeat(2, 1fr) !important; gap: 12px; }
        }
    </style>
</head>
<body>
    <div class="main-wrapper">
        <?php include('nav.php'); ?>

        <div class="about-container">
            <div class="about-card">
                <!-- Foto grande de gimnasio -->
                <img src="https://images.unsplash.com/photo-1534438327276-14e5300c3a48?auto=format&fit=crop&w=1200&q=80" alt="Gimnasio Veinzer" class="gym-banner">
                
                <div class="about-content">
                    <h2>Sobre el Proyecto - Veinzer</h2>
                    <p><strong>Veinzer</strong> es una plataforma web dinámica e interactiva desarrollada bajo arquitectura MVC-lite y conectada a una base de datos MySQL, diseñada específicamente para la comunidad apasionada por el fitness, el entrenamiento físico y la vida saludable.</p>
                    <p>El sistema integra módulos especializados de entrenamiento en <strong>Fuerza, Cardio y Yoga</strong>, ofreciendo guías de ejercicios con reproducción integrada de videos de YouTube. Cuenta con un robusto <strong>foro comunitario</strong> donde los usuarios pueden realizar publicaciones con imágenes adjuntas, interactuar mediante comentarios en tiempo real, dar "Me gusta" y navegar eficientemente gracias a un sistema de anclas (anchors).</p>
                    <p>Además, la plataforma ofrece una <strong>gestión completa de perfiles personalizados</strong> (con subida permanente de avatares y control de datos físicos como peso, altura y nivel de actividad), complementado por un panel de control administrativo (CRUDs) para la gestión segura de usuarios y publicaciones con roles diferenciados.</p>

                    <div class="badges-info">
                        <div class="badge-tag">Curso: 4°12</div>
                        <div class="badge-tag">Turno: Mañana</div>
                    </div>

                    <h3 class="team-title">Integrantes del Equipo de Desarrollo</h3>
                    
                    <div class="team-grid">
                        <!-- Santiago Soto -->
                        <div class="team-member">
                            <img src="../IMG/jonesy.jpg" alt="Santiago Soto" class="avatar-img" onerror="this.src='https://via.placeholder.com/100?text=Soto'">
                            <h4>Santiago Soto</h4>
                        </div>
                        
                        <!-- Lorenzo Lovato -->
                        <div class="team-member">
                            <img src="../IMG/deriva.jpg" alt="Lorenzo Lovato" class="avatar-img" onerror="this.src='https://via.placeholder.com/100?text=Lovato'">
                            <h4>Lorenzo Lovato</h4>
                        </div>

                        <!-- Pablo Luque -->
                        <div class="team-member">
                            <img src="../IMG/ikonik.jpg" alt="Pablo Luque" class="avatar-img" onerror="this.src='https://via.placeholder.com/100?text=Luque'">
                            <h4>Pablo Luque</h4>
                        </div>
                        
                        <!-- Santiago Guerrero -->
                        <div class="team-member">
                            <img src="../IMG/psaiko.jpg" alt="Santiago Guerrero" class="avatar-img" onerror="this.src='https://via.placeholder.com/100?text=Guerrero'">
                            <h4>Santiago Guerrero</h4>
                        </div>
                        
                        <!-- Diego Gomez -->
                        <div class="team-member">
                            <img src="../IMG/zombi.jpg" alt="Diego Gomez" class="avatar-img" onerror="this.src='https://via.placeholder.com/100?text=Gomez'">
                            <h4>Diego Gomez</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('footer.php'); ?>
</body>
</html>