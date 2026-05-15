<?php
define('IN_APP', true);
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/auth.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>UCIPS | Sistema de Preregistro</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= siteUrl('assets/css/site.css') ?>">
</head>
<body>

<div class="container">

<!-- NAV -->
<nav class="top-nav">
    <span class="top-nav-logo-text">UCIPS</span>
    <div class="top-nav-links">
        <a href="#programas" class="top-nav-link">Programas</a>
        <a href="#contacto"  class="top-nav-link">Contacto</a>
        <a href="<?= siteUrl('admin/login.php') ?>" class="top-nav-link">⚙ Admin</a>
    </div>
</nav>

<!-- HERO -->
<header>
    <div class="hero-content">
        <img src="<?= SITE_LOGO ?>" class="logo-small" alt="UCIPS">

        <div class="hero-badge">
            Licenciaturas &amp; Posgrados · UCIPS Puebla
        </div>

        <h1>Sistema de<br>Preregistro</h1>

        <p class="subtitle">
            Programas de educación superior especializada en seguridad pública,<br>
            ciencias policiales y protección ciudadana.
        </p>

        <div class="hero-buttons">
            <a href="#programas" class="btn-primary">VER PROGRAMAS</a>
            <a href="#contacto"  class="btn-secondary">CONTACTO</a>
        </div>
    </div>
</header>

<!-- STATS STRIP -->
<div class="stats-strip" data-reveal>
    <div class="stat-block">
        <span class="stat-number">8</span>
        <span class="stat-label">Programas</span>
    </div>
    <div class="stat-block">
        <span class="stat-number">Mixta</span>
        <span class="stat-label">Modalidad</span>
    </div>
    <div class="stat-block">
        <span class="stat-number">$500</span>
        <span class="stat-label">Inscripción</span>
    </div>
    <div class="stat-block">
        <span class="stat-number">2000+</span>
        <span class="stat-label">Egresados</span>
    </div>
</div>

<!-- PROGRAMAS -->
<div class="section-title" id="programas" data-reveal>
    Programas Disponibles
</div>

<div class="programs-grid">
<?php $i = 1; foreach ($PROGRAMS as $p): ?>
    <div class="program-card" data-reveal data-delay="<?= min(($i - 1) * 80, 320) ?>">

        <div class="program-card-number"><?= str_pad($i, 2, '0', STR_PAD_LEFT) ?></div>

        <div class="prog-icon"><?= $p['icono'] ?></div>
        <div class="prog-badge"><?= h($p['tipo']) ?></div>
        <h2><?= h($p['nombre']) ?></h2>
        <p><?= h($p['descripcion']) ?></p>

        <div class="prog-meta">
            <span>⏱ <?= h($p['duracion']) ?> <?= in_array($p['tipo'], ['Maestría','Maestría Premium','Doctorado']) ? 'Semestres' : 'Cuatrimestres' ?></span>
            <span>📚 <?= h($p['modalidad']) ?></span>
            <span>💰 $500 Inscripción</span>
        </div>

        <div class="prog-schedule">
            💻 Viernes · Virtual &nbsp;18:00 – 22:00 hrs<br>
            🏛️ Sábados · Presencial &nbsp;09:00 – 15:00 hrs
        </div>

        <div class="card-buttons">
            <a href="<?= siteUrl('preregistro.php?id=' . $p['id']) ?>" class="btn-card-primary">
                HACER PRE-REGISTRO
            </a>
            <a href="<?= siteUrl('programa.php?id=' . $p['id']) ?>" class="btn-card-secondary">
                VER PROGRAMA
            </a>
        </div>

    </div>
<?php $i++; endforeach; ?>
</div>

<!-- CONTACTO -->
<div class="section-title" id="contacto" data-reveal>
    Ubicación e Informes
</div>

<div class="map-info-grid" data-reveal>

    <div class="contact-box">
        <h3>Contacto</h3>
        <p class="contact-address"><?= SITE_ADDRESS ?></p>
        <div class="contact-item">✉️ <?= SITE_EMAIL ?></div>
        <div class="contact-item">☎️ <?= SITE_PHONE ?></div>
        <div class="contact-item">🕘 <?= SITE_HOURS ?></div>
    </div>

    <div class="map-container">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3771.4!2d-98.0838964!3d19.051515!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85cf94d49d2eb08d%3A0x9a2caf740a59d52d!2sCamino+Vecinal+a+Santa+Cruz+Alpuyeca%2C+Amozoc%2C+Puebla!5e0!3m2!1ses-419!2smx!4v1715880000000!5m2!1ses-419!2smx"
            width="100%" height="100%"
            style="border:0;min-height:380px;"
            allowfullscreen loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>

</div>

</div><!-- /container -->

<footer>
    <div class="container">
        <div class="footer-inner">
            <div class="footer-brand">
                <img src="<?= SITE_LOGO ?>" class="footer-logo" alt="UCIPS">
                <p class="footer-brand-name">UCIPS</p>
                <p>Universidad de las Ciencias Policiales<br>y de la Seguridad del Estado de Puebla</p>
            </div>
            <div class="footer-links">
                <h4>Programas</h4>
                <ul>
                    <?php foreach ($PROGRAMS as $p): ?>
                    <li><a href="<?= siteUrl('programa.php?id=' . $p['id']) ?>"><?= h($p['nombre']) ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="footer-contact">
                <h4>Contacto</h4>
                <p><?= SITE_ADDRESS ?></p>
                <p><a href="mailto:<?= SITE_EMAIL ?>"><?= SITE_EMAIL ?></a></p>
                <p><?= SITE_PHONE ?></p>
                <p><?= SITE_HOURS ?></p>
            </div>
        </div>
        <div class="footer-bottom">
            <p><?= SITE_COPYRIGHT ?> · Universidad de las Ciencias Policiales y de la Seguridad del Estado de Puebla</p>
            <p><a href="mailto:<?= SITE_EMAIL ?>"><?= SITE_EMAIL ?></a></p>
        </div>
    </div>
</footer>

<script src="<?= siteUrl('assets/js/main.js') ?>"></script>
</body>
</html>
