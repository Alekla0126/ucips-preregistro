<?php
define('IN_APP', true);
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/auth.php';

// Agrupar programas por categoría
$licenciaturas = array_filter($PROGRAMS, fn($p) => $p['categoria'] === 'licenciatura');
$maestrias     = array_filter($PROGRAMS, fn($p) => $p['categoria'] === 'maestria');
$doctorados    = array_filter($PROGRAMS, fn($p) => $p['categoria'] === 'doctorado');
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>UCIPS | Oferta Académica · Preregistro</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= siteUrl('assets/css/site.css') ?>">
</head>
<body>

<div class="container">

<!-- ── NAV PRINCIPAL ──────────────────────────────────────── -->
<nav class="top-nav">
    <span class="top-nav-logo-text">UCIPS</span>
    <div class="top-nav-links">
        <a href="#licenciaturas" class="top-nav-link">Licenciaturas</a>
        <a href="#maestrias"     class="top-nav-link">Maestrías</a>
        <a href="#doctorado"     class="top-nav-link">Doctorado</a>
        <a href="#contacto"      class="top-nav-link">Contacto</a>
        <a href="<?= siteUrl('admin/login.php') ?>" class="top-nav-link top-nav-link--admin">⚙</a>
    </div>
</nav>

<!-- ── HERO ───────────────────────────────────────────────── -->
<header>
    <div class="hero-content">
        <img src="<?= SITE_LOGO ?>" class="logo-small" alt="UCIPS">

        <div class="hero-badge">Oferta Académica · UCIPS Puebla</div>

        <h1>Formación<br>de Alto Nivel</h1>

        <p class="subtitle">
            Programas de educación superior especializados en seguridad pública,<br>
            ciencias policiales, derecho y protección ciudadana.
        </p>

        <div class="hero-buttons">
            <a href="#licenciaturas" class="btn-primary">VER PROGRAMAS</a>
            <a href="#contacto"      class="btn-secondary">CONTACTO</a>
        </div>
    </div>
</header>

<!-- ── STATS STRIP ────────────────────────────────────────── -->
<div class="stats-strip" data-reveal>
    <div class="stat-block">
        <span class="stat-number">8</span>
        <span class="stat-label">Programas</span>
    </div>
    <div class="stat-block">
        <span class="stat-number">3</span>
        <span class="stat-label">Niveles Académicos</span>
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

<!-- ── NAV DE CATEGORÍAS (sticky) ─────────────────────────── -->
<nav class="cat-nav" id="cat-nav">
    <a href="#licenciaturas" class="cat-tab cat-tab--lic" data-target="licenciaturas">
        <span class="cat-tab-num">01</span>
        <span class="cat-tab-label">Licenciaturas</span>
        <span class="cat-tab-count"><?= count($licenciaturas) ?></span>
    </a>
    <a href="#maestrias" class="cat-tab cat-tab--mae" data-target="maestrias">
        <span class="cat-tab-num">02</span>
        <span class="cat-tab-label">Maestrías</span>
        <span class="cat-tab-count"><?= count($maestrias) ?></span>
    </a>
    <a href="#doctorado" class="cat-tab cat-tab--doc" data-target="doctorado">
        <span class="cat-tab-num">03</span>
        <span class="cat-tab-label">Doctorado</span>
        <span class="cat-tab-count"><?= count($doctorados) ?></span>
    </a>
</nav>

<!-- ════════════════════════════════════════════════════════
     01 · LICENCIATURAS
════════════════════════════════════════════════════════ -->
<section class="cat-section" id="licenciaturas" data-cat="licenciatura">

    <div class="cat-section-header" data-reveal>
        <div class="cat-section-eyebrow">
            <span class="cat-section-num">01</span>
            <span class="cat-section-tag cat-tag--lic">Licenciatura</span>
        </div>
        <h2 class="cat-section-title">Licenciaturas</h2>
        <p class="cat-section-desc">
            Formación profesional de 9 cuatrimestres en modalidad mixta.
            Diseñadas para personal activo en instituciones de seguridad pública.
        </p>
    </div>

    <div class="programs-grid programs-grid--lic">
    <?php $i = 1; foreach ($licenciaturas as $p): ?>
        <div class="program-card program-card--lic" data-reveal data-delay="<?= ($i - 1) * 100 ?>">
            <div class="program-card-number"><?= str_pad($i, 2, '0', STR_PAD_LEFT) ?></div>
            <div class="prog-icon"><?= $p['icono'] ?></div>
            <div class="prog-badge prog-badge--lic"><?= h($p['tipo']) ?></div>
            <h2><?= h($p['nombre']) ?></h2>
            <p><?= h($p['descripcion']) ?></p>
            <div class="prog-meta">
                <span>⏱ <?= h($p['duracion']) ?> Cuatrimestres</span>
                <span>📚 <?= h($p['modalidad']) ?></span>
                <span>💰 $500 Inscripción</span>
            </div>
            <div class="prog-schedule">
                💻 Viernes · Virtual &nbsp;18:00 – 22:00 hrs<br>
                🏛️ Sábados · Presencial &nbsp;09:00 – 15:00 hrs
            </div>
            <div class="card-buttons">
                <a href="<?= siteUrl('preregistro.php?id=' . $p['id']) ?>" class="btn-card-primary">HACER PRE-REGISTRO</a>
                <a href="<?= siteUrl('programa.php?id='    . $p['id']) ?>" class="btn-card-secondary">VER PROGRAMA</a>
            </div>
        </div>
    <?php $i++; endforeach; ?>
    </div>

</section>

<!-- ════════════════════════════════════════════════════════
     02 · MAESTRÍAS
════════════════════════════════════════════════════════ -->
<section class="cat-section" id="maestrias" data-cat="maestria">

    <div class="cat-section-header" data-reveal>
        <div class="cat-section-eyebrow">
            <span class="cat-section-num">02</span>
            <span class="cat-section-tag cat-tag--mae">Posgrado</span>
        </div>
        <h2 class="cat-section-title">Maestrías</h2>
        <p class="cat-section-desc">
            Programas de 4 semestres a nivel maestría en modalidad mixta.
            Requieren título y cédula de licenciatura.
        </p>
    </div>

    <div class="programs-grid programs-grid--mae">
    <?php $i = 1; foreach ($maestrias as $p): ?>
        <div class="program-card program-card--mae" data-reveal data-delay="<?= min(($i - 1) * 80, 320) ?>">
            <div class="program-card-number"><?= str_pad($i, 2, '0', STR_PAD_LEFT) ?></div>
            <div class="prog-icon"><?= $p['icono'] ?></div>
            <div class="prog-badge prog-badge--mae"><?= h($p['tipo']) ?></div>
            <h2><?= h($p['nombre']) ?></h2>
            <p><?= h($p['descripcion']) ?></p>
            <div class="prog-meta">
                <span>⏱ <?= h($p['duracion']) ?> Semestres</span>
                <span>📚 <?= h($p['modalidad']) ?></span>
                <span>💰 $500 Inscripción</span>
            </div>
            <div class="prog-schedule">
                💻 Viernes · Virtual &nbsp;18:00 – 22:00 hrs<br>
                🏛️ Sábados · Presencial &nbsp;09:00 – 15:00 hrs
            </div>
            <div class="card-buttons">
                <a href="<?= siteUrl('preregistro.php?id=' . $p['id']) ?>" class="btn-card-primary">HACER PRE-REGISTRO</a>
                <a href="<?= siteUrl('programa.php?id='    . $p['id']) ?>" class="btn-card-secondary">VER PROGRAMA</a>
            </div>
        </div>
    <?php $i++; endforeach; ?>
    </div>

</section>

<!-- ════════════════════════════════════════════════════════
     03 · DOCTORADO
════════════════════════════════════════════════════════ -->
<section class="cat-section" id="doctorado" data-cat="doctorado">

    <div class="cat-section-header" data-reveal>
        <div class="cat-section-eyebrow">
            <span class="cat-section-num">03</span>
            <span class="cat-section-tag cat-tag--doc">Doctorado</span>
        </div>
        <h2 class="cat-section-title">Doctorado</h2>
        <p class="cat-section-desc">
            El máximo grado académico. Investigación avanzada de 4 semestres
            orientada al liderazgo institucional y la ciencia policial.
        </p>
    </div>

    <?php foreach ($doctorados as $p): ?>
    <div class="program-card--doc-featured" data-reveal>
        <div class="doc-featured-left">
            <div class="prog-badge prog-badge--doc"><?= h($p['tipo']) ?></div>
            <div class="doc-icon"><?= $p['icono'] ?></div>
            <h2><?= h($p['nombre']) ?></h2>
            <p><?= h($p['descripcion']) ?></p>
            <div class="prog-meta" style="margin-top:28px;">
                <span>⏱ <?= h($p['duracion']) ?> Semestres</span>
                <span>📚 <?= h($p['modalidad']) ?></span>
            </div>
        </div>
        <div class="doc-featured-right">
            <div class="doc-req-title">Requisito de acceso</div>
            <div class="doc-req-item">🎓 Título y Cédula de Maestría</div>
            <div class="doc-req-item">🏛 Personal de Instituciones de Seguridad</div>
            <div class="doc-req-item">📋 Carta de postulación del jefe inmediato</div>
            <div class="doc-req-item">✍️ Carta de exposición de motivos</div>
            <div class="doc-schedule">
                <div style="color:var(--gold);font-weight:700;font-size:.78rem;letter-spacing:1.5px;text-transform:uppercase;margin-bottom:14px;">Horarios</div>
                <div>💻 Viernes · Virtual · 18:00 – 22:00 hrs</div>
                <div>🏛️ Sábados · Presencial · 09:00 – 15:00 hrs</div>
            </div>
            <div class="card-buttons" style="margin-top:32px;">
                <a href="<?= siteUrl('preregistro.php?id=' . $p['id']) ?>" class="btn-card-primary">HACER PRE-REGISTRO</a>
                <a href="<?= siteUrl('programa.php?id='    . $p['id']) ?>" class="btn-card-secondary">VER PROGRAMA</a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>

</section>

<!-- ── CONTACTO ───────────────────────────────────────────── -->
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

<!-- ── FOOTER ─────────────────────────────────────────────── -->
<footer>
    <div class="container">
        <div class="footer-inner">
            <div class="footer-brand">
                <img src="<?= SITE_LOGO ?>" class="footer-logo" alt="UCIPS">
                <p class="footer-brand-name">UCIPS</p>
                <p>Universidad de las Ciencias Policiales<br>y de la Seguridad del Estado de Puebla</p>
            </div>
            <div class="footer-links">
                <h4>Licenciaturas</h4>
                <ul>
                    <?php foreach ($licenciaturas as $p): ?>
                    <li><a href="<?= siteUrl('programa.php?id=' . $p['id']) ?>"><?= h($p['nombre']) ?></a></li>
                    <?php endforeach; ?>
                </ul>
                <h4 style="margin-top:20px;">Maestrías &amp; Doctorado</h4>
                <ul>
                    <?php foreach (array_merge($maestrias, $doctorados) as $p): ?>
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
