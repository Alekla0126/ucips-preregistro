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
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= siteUrl('assets/css/site.css') ?>">
</head>
<body>

<div class="container">

<!-- NAV -->
<div class="top-nav">
    <div></div>
    <div class="top-nav-links">
        <a href="#programas" class="top-nav-link">Programas</a>
        <a href="#contacto" class="top-nav-link">Contacto</a>
        <a href="<?= siteUrl('admin/login.php') ?>" class="top-nav-link">⚙ Admin</a>
    </div>
</div>

<!-- HERO -->
<header>
    <div class="hero-content">

        <img src="https://yacdergaming.com/preregistro/imagenes/logo.png"
             class="logo-small" alt="UCIPS">

        <div class="hero-badge">
            Licenciatura Premium · UCIPS Puebla
        </div>

        <h1>Sistema de Preregistro</h1>

        <p class="subtitle">
            Accede a nuestros programas de educación superior especializada<br>
            en seguridad pública, ciencias policiales y protección ciudadana.
        </p>

        <div class="hero-buttons">
            <a href="#programas" class="btn-primary">VER PROGRAMAS</a>
            <a href="#contacto" class="btn-secondary">CONTACTO</a>
        </div>

    </div>
</header>

<!-- PROGRAMAS -->
<div class="section-title" id="programas">
    Programas Disponibles
</div>

<div class="programs-grid">
<?php foreach ($PROGRAMS as $p): ?>
    <div class="program-card">

        <div class="prog-icon"><?= $p['icono'] ?></div>

        <div class="prog-badge"><?= h($p['tipo']) ?></div>

        <h2><?= h($p['nombre']) ?></h2>

        <p><?= h($p['descripcion']) ?></p>

        <div class="prog-meta">
            <span>⏱ <?= h($p['duracion']) ?> <?= in_array($p['tipo'], ['Maestría','Maestría Premium','Doctorado']) ? 'Semestres' : 'Cuatrimestres' ?></span>
            <span>📚 <?= h($p['modalidad']) ?></span>
            <span>💰 $500 Inscripción</span>
        </div>

        <div style="
        margin-top:8px;
        padding-top:18px;
        border-top:1px solid rgba(255,255,255,.08);
        color:#d8d8d8;
        font-size:.88rem;
        line-height:1.9;">
            💻 Viernes · Virtual &nbsp; 18:00 – 22:00 hrs<br>
            🏛️ Sábados · Presencial &nbsp; 09:00 – 15:00 hrs
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
<?php endforeach; ?>
</div>

<!-- CONTACTO -->
<div class="section-title" id="contacto">
    Ubicación e Informes
</div>

<div class="map-info-grid">

    <div class="contact-box">

        <h3>Contacto</h3>

        <p style="font-size:.95rem;line-height:1.9;color:#d8d8d8;">
            <?= SITE_ADDRESS ?>
        </p>

        <div class="contact-item">
            ✉️ <?= SITE_EMAIL ?>
        </div>

        <div class="contact-item">
            ☎️ Tel. 222 144 1000 ext. 32134
        </div>

        <div class="contact-item">
            🕘 Lunes a Viernes · 09:00 – 18:00 hrs
        </div>

    </div>

    <div class="map-container">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3771.4!2d-98.0838964!3d19.051515!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85cf94d49d2eb08d%3A0x9a2caf740a59d52d!2sCamino+Vecinal+a+Santa+Cruz+Alpuyeca%2C+Amozoc%2C+Puebla!5e0!3m2!1ses-419!2smx!4v1715880000000!5m2!1ses-419!2smx"
            width="100%"
            height="100%"
            style="border:0;min-height:350px;"
            allowfullscreen=""
            loading="lazy">
        </iframe>
    </div>

</div>

</div><!-- /container -->

<footer>
    <?= SITE_COPYRIGHT ?> · Universidad de las Ciencias Policiales y de la Seguridad del Estado de Puebla<br>
    <a href="mailto:<?= SITE_EMAIL ?>"><?= SITE_EMAIL ?></a>
</footer>

</body>
</html>
