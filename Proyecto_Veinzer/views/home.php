<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Veinzer</title>
    <style>
        .hero { text-align: center; padding: 40px 20px 20px; }
        .hero h1 { font-size: 2.3rem; color: #fff; margin-bottom: 10px; }
        .hero p { color: #888; font-size: 1.05rem; max-width: 600px; margin: 0 auto; }
        
        /* Carrusel Principal de Banners */
        .carousel-container { position: relative; max-width: 850px; width: 92%; margin: 20px auto; overflow: hidden; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.6); border: 1px solid #2a2a2a; }
        .carousel-slide { display: none; position: relative; height: 320px; }
        .carousel-slide.active { display: block; animation: fadeIn 0.8s; }
        .carousel-slide img { width: 100%; height: 100%; object-fit: cover; }
        .carousel-caption { position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(transparent, rgba(0,0,0,0.9)); padding: 25px; border-left: 4px solid #ff5722; }
        .carousel-caption h3 { font-size: 1.5rem; color: #fff; margin-bottom: 5px; }
        .carousel-caption p { color: #ddd; font-size: 0.95rem; }
        .btn-cta { display: inline-block; margin-top: 8px; padding: 7px 16px; background: #ff5722; color: #fff; text-decoration: none; border-radius: 20px; font-weight: bold; font-size: 0.85rem; }
        .btn-cta:hover { background: #e64a19; }

        /* Sección Carrusel de Tarjetas de Ejercicios */
        .section-cards { max-width: 850px; width: 92%; margin: 50px auto; padding: 0; position: relative; }
        .section-cards h2 { color: #fff; font-size: 1.5rem; margin-bottom: 20px; border-left: 4px solid #ff5722; padding-left: 10px; }
        
        .cards-carousel-wrapper { position: relative; overflow: hidden; border-radius: 12px; }
        .cards-track { display: flex; transition: transform 0.5s ease-in-out; }
        
        .exercise-card { min-width: 100%; background: #1e1e1e; border: 1px solid #2a2a2a; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.4); display: flex; flex-direction: column; }
        .exercise-card img { width: 100%; height: 240px; object-fit: cover; }
        .exercise-body { padding: 25px; flex: 1; display: flex; flex-direction: column; justify-content: space-between; }
        .exercise-body h4 { color: #fff; font-size: 1.3rem; margin-bottom: 8px; }
        .exercise-body p { color: #aaa; font-size: 1rem; margin-bottom: 20px; }
        .btn-details { background: #ff5722; color: #fff; border: none; padding: 10px 20px; border-radius: 6px; text-align: center; text-decoration: none; font-weight: bold; font-size: 0.95rem; transition: background 0.3s; display: inline-block; width: fit-content; }
        .btn-details:hover { background: #e64a19; }

        /* Controles de Flechas para el Carrusel de Tarjetas */
        .card-carousel-btn { position: absolute; top: 55%; transform: translateY(-50%); background: rgba(0,0,0,0.7); color: #fff; border: none; font-size: 1.5rem; padding: 10px 15px; cursor: pointer; border-radius: 50%; z-index: 10; transition: background 0.3s; }
        .card-carousel-btn:hover { background: #ff5722; }
        .card-prev { left: 10px; }
        .card-next { right: 10px; }

        @keyframes fadeIn { from { opacity: 0.3; } to { opacity: 1; } }

        /* RESPONSIVE PARA TABLETS Y CELULARES (Menor a 1024px) */
        @media (max-width: 1024px) {
            .hero { padding: 25px 15px 10px; }
            .hero h1 { font-size: 1.8rem; }
            .hero p { font-size: 0.95rem; }
            
            .carousel-container, .section-cards { width: 95% !important; margin: 15px auto !important; }
            .carousel-slide { height: 260px; }
            .carousel-caption h3 { font-size: 1.2rem; }
            .carousel-caption p { font-size: 0.85rem; }
            
            .section-cards h2 { font-size: 1.3rem; }
            .exercise-card img { height: 200px; }
            .exercise-body { padding: 18px; }
            .exercise-body h4 { font-size: 1.15rem; }
            .exercise-body p { font-size: 0.9rem; margin-bottom: 15px; }
            .btn-details { padding: 8px 16px; font-size: 0.85rem; width: 100%; text-align: center; }
            
            .card-carousel-btn { padding: 6px 10px; font-size: 1.2rem; top: 50%; }
        }
    </style>
</head>
<body>
    <div class="main-wrapper">
        <?php include('nav.php'); ?>

        <div class="hero">
            <h1>Bienvenido a la Plataforma Veinzer</h1>
            <p>Conecta con la comunidad, comparte tus opiniones y gestiona tus actividades.</p>
        </div>

        <!-- Carrusel Principal (Banners) -->
        <div class="carousel-container">
            <div class="carousel-slide active">
                <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=1000&q=80" alt="Comunidad">
                <div class="carousel-caption">
                    <h3>¡Participa en la Comunidad!</h3>
                    <p>Vaya a comentar al foro y comparta sus publicaciones con todos.</p>
                    <a href="/Proyecto_Veinzer/controllers/foroController.php" class="btn-cta">Ir al Foro Ahora</a>
                </div>
            </div>
            <div class="carousel-slide">
                <img src="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?auto=format&fit=crop&w=1000&q=80" alt="Debates">
                <div class="carousel-caption">
                    <h3>Opiniones y Debates</h3>
                    <p>Deje su "Me gusta" a las mejores publicaciones y únase a los debates.</p>
                    <a href="/Proyecto_Veinzer/controllers/foroController.php" class="btn-cta">Ver Publicaciones</a>
                </div>
            </div>
        </div>

        <!-- Sección de Carrusel de Tarjetas de Ejercicios -->
        <div class="section-cards">
            <h2>Ejercicios y Rutinas Destacadas</h2>
            <div class="cards-carousel-wrapper">
                <button class="card-carousel-btn card-prev" onclick="moveCard(-1)">&#10094;</button>
                <button class="card-carousel-btn card-next" onclick="moveCard(1)">&#10095;</button>
                
                <div class="cards-track" id="cardsTrack">
                    <!-- Tarjeta 1: Fuerza -->
                    <div class="exercise-card">
                        <img src="https://images.unsplash.com/photo-1581009146145-b5ef050c2e1e?auto=format&fit=crop&w=800&q=80" alt="Entrenamiento de Fuerza">
                        <div class="exercise-body">
                            <div>
                                <h4>Entrenamiento de Fuerza</h4>
                                <p>Rutinas avanzadas para desarrollo de masa muscular, hipertrofia y tonificación general con sobrecarga progresiva.</p>
                            </div>
                            <a href="/Proyecto_Veinzer/controllers/recomendacionesController.php" class="btn-details">Ver Rutinas de Fuerza</a>
                        </div>
                    </div>

                    <!-- Tarjeta 2: Cardio y Resistencia -->
                    <div class="exercise-card">
                        <img src="https://images.unsplash.com/photo-1518611012118-696072aa579a?auto=format&fit=crop&w=800&q=80" alt="Cardio y Resistencia">
                        <div class="exercise-body">
                            <div>
                                <h4>Cardio y Resistencia</h4>
                                <p>Ejercicios aeróbicos y sesiones HIIT enfocados en quemar grasa, acelerar el metabolismo y mejorar la capacidad pulmonar.</p>
                            </div>
                            <a href="/Proyecto_Veinzer/controllers/cardioController.php" class="btn-details">Ver Rutinas de Cardio</a>
                        </div>
                    </div>

                    <!-- Tarjeta 3: Flexibilidad y Yoga -->
                    <div class="exercise-card">
                        <img src="https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?auto=format&fit=crop&w=800&q=80" alt="Flexibilidad y Yoga">
                        <div class="exercise-body">
                            <div>
                                <h4>Flexibilidad y Yoga</h4>
                                <p>Movilidad articular, posturas de descompresión espinal y estiramientos para reducir el estrés y evitar lesiones físicas.</p>
                            </div>
                            <a href="/Proyecto_Veinzer/controllers/yogaController.php" class="btn-details">Ver Sesiones de Yoga</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('footer.php'); ?>

    <script>
        // Script carrusel principal (banners)
        let index = 0;
        const slides = document.querySelectorAll('.carousel-slide');
        setInterval(() => {
            slides[index].classList.remove('active');
            index = (index + 1) % slides.length;
            slides[index].classList.add('active');
        }, 4000);

        // Script carrusel de tarjetas de ejercicios
        let cardIndex = 0;
        const track = document.getElementById('cardsTrack');
        const totalCards = document.querySelectorAll('.exercise-card').length;

        function moveCard(direction) {
            cardIndex = (cardIndex + direction + totalCards) % totalCards;
            track.style.transform = `translateX(-${cardIndex * 100}%)`;
        }

        // Auto-play opcional para el carrusel de tarjetas cada 5 segundos
        setInterval(() => {
            moveCard(1);
        }, 5000);
    </script>
</body>
</html>