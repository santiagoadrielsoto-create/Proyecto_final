<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio - Veinzer</title>
    <style>
        .hero { text-align: center; padding: 50px 20px 30px; }
        .hero h1 { font-size: 2.5rem; color: #fff; margin-bottom: 10px; }
        .hero p { color: #888; font-size: 1.1rem; max-width: 600px; margin: 0 auto; }
        
        /* Carrusel */
        .carousel-container { position: relative; max-width: 900px; margin: 30px auto; overflow: hidden; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.6); border: 1px solid #2a2a2a; }
        .carousel-slide { display: none; position: relative; height: 380px; }
        .carousel-slide.active { display: block; animation: fadeIn 0.8s; }
        .carousel-slide img { width: 100%; height: 100%; object-fit: cover; }
        .carousel-caption { position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(transparent, rgba(0,0,0,0.9)); padding: 30px 25px 20px; border-left: 4px solid #ff5722; }
        .carousel-caption h3 { font-size: 1.6rem; color: #fff; margin-bottom: 5px; }
        .carousel-caption p { color: #ddd; font-size: 1rem; }
        .btn-call-to-action { display: inline-block; margin-top: 10px; padding: 8px 18px; background: #ff5722; color: #fff; text-decoration: none; border-radius: 20px; font-weight: bold; font-size: 0.9rem; }
        .btn-call-to-action:hover { background: #e64a19; }
        @keyframes fadeIn { from { opacity: 0.3; } to { opacity: 1; } }
    </style>
</head>
<body>
    <div class="main-wrapper">
        <?php include('nav.php'); ?>

        <div class="hero">
            <h1>Bienvenido a la Plataforma Veinzer</h1>
            <p>Conecta con la comunidad, comparte tus opiniones y gestiona tus actividades en un solo lugar.</p>
        </div>

        <!-- Carrusel con enlaces corregidos hacia los controladores -->
        <div class="carousel-container">
            <div class="carousel-slide active">
                <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=1000&q=80" alt="Comunidad">
                <div class="carousel-caption">
                    <h3>¡Participa en la Comunidad!</h3>
                    <p>¡Vayan a comentar al foro y compartan sus publicaciones con todos!</p>
                    <a href="../controllers/foroController.php" class="btn-call-to-action">Ir al Foro Ahora</a>
                </div>
            </div>
            <div class="carousel-slide">
                <img src="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?auto=format&fit=crop&w=1000&q=80" alt="Debates">
                <div class="carousel-caption">
                    <h3>Opiniones y Debates</h3>
                    <p>Déjale tu "Me gusta" a las mejores publicaciones y únete a las conversaciones cotidianas.</p>
                    <a href="../controllers/foroController.php" class="btn-call-to-action">Ver Publicaciones</a>
                </div>
            </div>
        </div>
    </div>

    <?php include('footer.php'); ?>

    <script>
        let index = 0;
        const slides = document.querySelectorAll('.carousel-slide');
        setInterval(() => {
            slides[index].classList.remove('active');
            index = (index + 1) % slides.length;
            slides[index].classList.add('active');
        }, 4000);
    </script>
</body>
</html>