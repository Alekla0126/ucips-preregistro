<?php
define('IN_APP', true);
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/auth.php';

$pageTitle = 'Preregistro · UCIPS Puebla';
include __DIR__ . '/includes/header.php';
?>

<!-- ── Hero ── -->
<section class="hero">
    <div class="hero-content">
        <span class="badge">Licenciatura Premium · UCIPS Puebla</span>
        <h1>Sistema de Preregistro</h1>
        <p>Accede a nuestros programas de educación superior especializada en seguridad pública, ciencias policiales y protección ciudadana.</p>
        <div class="btn-group">
            <a href="#programas" class="btn btn-primary">Ver Programas</a>
            <a href="#contacto" class="btn btn-outline">Contáctanos</a>
        </div>
    </div>
</section>

<!-- ── Estadísticas ── -->
<section class="bg-white">
    <div class="container">
        <div class="info-cards">
            <div class="info-card">
                <div class="icon">🎓</div>
                <div class="value">9</div>
                <div class="label">Cuatrimestres</div>
            </div>
            <div class="info-card">
                <div class="icon">🏛️</div>
                <div class="value">MIXTA</div>
                <div class="label">Modalidad</div>
            </div>
            <div class="info-card">
                <div class="icon">💻</div>
                <div class="value">Viernes</div>
                <div class="label">Virtual 6–10 PM</div>
            </div>
            <div class="info-card">
                <div class="icon">📍</div>
                <div class="value">Sábados</div>
                <div class="label">Presencial 9 AM–3 PM</div>
            </div>
            <div class="info-card">
                <div class="icon">💰</div>
                <div class="value">$500</div>
                <div class="label">Inscripción</div>
            </div>
        </div>
    </div>
</section>

<!-- ── Programas ── -->
<section class="bg-light" id="programas">
    <div class="container">
        <div class="section-title">
            <h2>Programas Disponibles</h2>
            <p>Selecciona el programa que deseas estudiar y realiza tu preregistro</p>
        </div>

        <div class="programs-grid">
            <?php foreach ($PROGRAMS as $p): ?>
            <div class="program-card">
                <div class="program-card-header" style="background:<?= htmlspecialchars($p['color']) ?>">
                    <div class="icon"><?= $p['icono'] ?></div>
                    <h3><?= htmlspecialchars($p['nombre']) ?></h3>
                    <div class="tipo"><?= htmlspecialchars($p['tipo']) ?></div>
                </div>
                <div class="program-card-body">
                    <div class="program-meta">
                        <span class="meta-item">⏱ <?= htmlspecialchars($p['duracion']) ?></span>
                        <span class="meta-item">📚 <?= htmlspecialchars($p['modalidad']) ?></span>
                    </div>
                    <p class="desc"><?= htmlspecialchars($p['descripcion']) ?></p>
                    <div class="card-actions">
                        <a href="<?= siteUrl('programa.php?id=' . $p['id']) ?>" class="btn btn-secondary btn-sm">Ver Programa</a>
                        <a href="<?= htmlspecialchars($p['google_form']) ?>" target="_blank" class="btn btn-primary btn-sm">Preregistro</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ── CTA ── -->
<section class="cta-section">
    <div class="container">
        <h2>¿Listo para iniciar tu preregistro?</h2>
        <p>Selecciona tu programa y completa el formulario. Nuestro equipo se pondrá en contacto contigo para continuar el proceso.</p>
        <a href="#programas" class="btn btn-primary">Iniciar Preregistro</a>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
