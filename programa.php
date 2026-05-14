<?php
define('IN_APP', true);
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/auth.php';

$id = preg_replace('/[^a-z0-9]/', '', strtolower($_GET['id'] ?? ''));

if (!isset($PROGRAMS[$id])) {
    header('Location: ' . siteUrl());
    exit;
}

$p = $PROGRAMS[$id];
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>UCIPS | <?= h($p['nombre']) ?></title>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= siteUrl('assets/css/site.css') ?>">
</head>
<body>

<div class="container">

<!-- NAV -->
<div class="top-nav">
    <a href="<?= siteUrl() ?>" class="top-nav-link">← Todos los programas</a>
    <div class="top-nav-links">
        <a href="#plan" class="top-nav-link">Plan de Estudios</a>
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
            <?= h($p['tipo']) ?> · UCIPS Puebla
        </div>

        <h1><?= h($p['nombre']) ?></h1>

        <p class="subtitle">
            <?= h($p['descripcion']) ?>
        </p>

        <div class="hero-buttons">
            <a href="<?= siteUrl('preregistro.php?id=' . $p['id']) ?>" class="btn-primary">
                HACER PRE-REGISTRO
            </a>
            <a href="#plan" class="btn-secondary">
                VER PLAN DE ESTUDIOS
            </a>
        </div>

    </div>
</header>

<!-- INFO -->
<div class="info-grid">

    <div class="info-card">
        <h2>Duración</h2>
        <div class="valor-destacado"><?= count($p['plan_estudios']) ?></div>
        <p style="margin-top:10px;color:#d8d8d8;letter-spacing:2px;text-transform:uppercase;">
            <?= in_array($p['tipo'], ['Maestría','Maestría Premium','Doctorado']) ? 'Semestres' : 'Cuatrimestres' ?>
        </p>
    </div>

    <div class="info-card">
        <h2>Modalidad</h2>
        <div class="valor-destacado"><?= h($p['modalidad']) ?></div>
        <p style="margin-top:12px;color:#d8d8d8;line-height:1.8;">
            Formación flexible y profesional orientada al fortalecimiento académico y operativo.
        </p>
        <div style="margin-top:22px;padding-top:18px;border-top:1px solid rgba(255,255,255,.08);">
            <div style="color:var(--gold);font-weight:700;letter-spacing:1px;margin-bottom:14px;text-transform:uppercase;font-size:.85rem;">
                Horarios
            </div>
            <div style="color:#d8d8d8;line-height:2;">
                💻 Viernes · Virtual<br>
                18:00 hrs a 22:00 hrs
            </div>
            <div style="color:#d8d8d8;line-height:2;margin-top:12px;">
                🏛️ Sábados · Presencial<br>
                09:00 hrs a 15:00 hrs
            </div>
        </div>
    </div>

    <div class="info-card">
        <h2>Cuotas de Recuperación</h2>
        <table class="tabla-cuotas">
            <tr>
                <td>Inscripción</td>
                <td class="text-right">$500.00</td>
            </tr>
            <tr>
                <td>Mensualidad</td>
                <td class="text-right">$500.00</td>
            </tr>
            <tr>
                <td>Reinscripción</td>
                <td class="text-right">$500.00</td>
            </tr>
        </table>
    </div>

</div>

<!-- PLAN DE ESTUDIOS -->
<div class="section-title" id="plan">
    Plan de Estudios
</div>

<div class="grid-cuatris">
<?php
foreach ($p['plan_estudios'] as $label => $materias):
?>
    <div class="cuatri-card">
        <h3><?= h($label) ?></h3>
        <ul class="materias">
            <?php foreach ($materias as $m): ?>
            <li><?= h($m) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endforeach; ?>
</div>

<!-- REQUISITOS -->
<div class="section-title">
    Requisitos de Ingreso
</div>

<div class="requisitos-box">

    <div class="req-badge">
        Dirigido a Personal de Seguridad Pública y Procuración de Justicia
    </div>

    <div class="doc-list">
        <?php foreach ($p['requisitos'] as $req): ?>
        <div class="doc-item">
            <div class="doc-icon">✓</div>
            <span><?= h($req) ?></span>
        </div>
        <?php endforeach; ?>
    </div>

</div>

<!-- GUÍAS Y DOCUMENTOS -->
<div class="section-title">
    Guías y Documentos
</div>

<div class="requisitos-box">
    <p style="color:#aaa;font-size:.9rem;margin-top:0;border-top:1px solid rgba(255,255,255,.1);padding-top:20px;line-height:1.8;">
        Descarga los formatos guía para tu documentación oficial:
    </p>

    <div class="download-grid">

        <a href="https://yacdergaming.com/preregistro/documentos/motivos.docx"
           class="btn-download">
            <div style="font-size:1.8rem;">📄</div>
            <span>Guía: Carta de Exposición de Motivos</span>
        </a>

        <a href="https://yacdergaming.com/preregistro/documentos/carta_postulacion_jefe_inmediato.docx"
           class="btn-download">
            <div style="font-size:1.8rem;">🎖️</div>
            <span>Guía: Carta de postulación de jefe inmediato</span>
        </a>

    </div>
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
            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15065.111626042456!2d-98.0838964!3d19.051515!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85cf94d49d2eb08d%3A0x9a2caf740a59d52d!2sAcademia%20de%20Formaci%C3%B3n%20y%20Desarrollo%20Policial%20Puebla!5e0!3m2!1ses-419!2smx!4v1715880000000!5m2!1ses-419!2smx"
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
