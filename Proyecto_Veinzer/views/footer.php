<style>
    footer {
        background: #181818;
        color: #888;
        text-align: center;
        padding: 25px 20px;
        border-top: 1px solid #2a2a2a;
        margin-top: auto;
    }
    .footer-content h4 { color: #fff; margin-bottom: 12px; font-size: 1.1rem; }
    .social-links { display: flex; justify-content: center; gap: 15px; margin-bottom: 15px; flex-wrap: wrap; }
    .social-btn { 
        background: #252525; 
        color: #ccc; 
        padding: 8px 16px; 
        border-radius: 6px; 
        text-decoration: none; 
        font-size: 0.9rem; 
        font-weight: 500; 
        display: inline-flex; 
        align-items: center; 
        gap: 8px; 
        transition: all 0.3s ease;
        border: 1px solid #333;
    }
    .social-btn:hover { background: #ff5722; color: #fff; border-color: #ff5722; }
    .footer-copy { font-size: 0.85rem; color: #666; }

    /* RESPONSIVE PARA TABLETS Y CELULARES (Menor a 1024px) */
    @media (max-width: 1024px) {
        footer { padding: 20px 15px; }
        .social-links { gap: 10px; }
        .social-btn { padding: 10px 18px; font-size: 0.95rem; }
    }
</style>

<footer>
    <div class="footer-content">
        <h4>CONTÁCTANOS</h4>
        <div class="social-links">
            <a href="https://github.com" target="_blank" class="social-btn">
                <i class="fa-brands fa-github"></i> GitHub
            </a>
            <a href="https://youtube.com" target="_blank" class="social-btn">
                <i class="fa-brands fa-youtube"></i> YouTube
            </a>
            <a href="https://facebook.com" target="_blank" class="social-btn">
                <i class="fa-brands fa-facebook"></i> Facebook
            </a>
        </div>
        <p class="footer-copy">Todos los derechos reservados a Veinzer &copy; 2026</p>
    </div>
</footer>