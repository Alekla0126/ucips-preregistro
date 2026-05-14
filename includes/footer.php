<?php defined('IN_APP') || die('Acceso denegado'); ?>

<!-- ── Contacto & Mapa ── -->
<section class="bg-dark" id="contacto">
    <div class="container">
        <div class="section-title">
            <h2>Ubicación y Contacto</h2>
            <p>Visítanos o contáctanos para más información</p>
        </div>
        <div class="contact-grid">
            <div class="contact-info">
                <h3>Información de Contacto</h3>
                <div class="contact-item">
                    <span class="ci-icon">📍</span>
                    <div class="ci-content">
                        <strong>Dirección</strong>
                        <p><?= SITE_ADDRESS ?></p>
                    </div>
                </div>
                <div class="contact-item">
                    <span class="ci-icon">✉️</span>
                    <div class="ci-content">
                        <strong>Correo Electrónico</strong>
                        <p><a href="mailto:<?= SITE_EMAIL ?>" style="color:var(--accent)"><?= SITE_EMAIL ?></a></p>
                    </div>
                </div>
                <div class="contact-item">
                    <span class="ci-icon">🕘</span>
                    <div class="ci-content">
                        <strong>Horario de Atención</strong>
                        <p><?= SITE_HOURS ?></p>
                    </div>
                </div>
            </div>
            <div class="map-container">
                <iframe
                    src="https://www.google.com/maps?q=Camino+Vecinal+a+Santa+Cruz+Alpuyeca+km+6.5+Chachapa+Amozoc+Puebla&output=embed"
                    width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </div>
</section>

<footer class="site-footer">
    <?= SITE_COPYRIGHT ?> &nbsp;|&nbsp; Universidad de las Ciencias Policiales y de la Seguridad del Estado de Puebla
    &nbsp;|&nbsp; <a href="mailto:<?= SITE_EMAIL ?>"><?= SITE_EMAIL ?></a>
</footer>

</body>
</html>
