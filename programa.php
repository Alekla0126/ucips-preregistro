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
$pageTitle = htmlspecialchars($p['nombre']) . ' · UCIPS';

include __DIR__ . '/includes/header.php';
?>

<!-- ── Hero del programa ── -->
<section class="hero" style="background: linear-gradient(135deg, <?= h($p['color']) ?> 0%, #0B1C2D 100%)">
    <div class="hero-content">
        <span class="badge"><?= h($p['tipo']) ?></span>
        <h1>
            <?= h($p['icono']) ?> <?= h($p['nombre']) ?>
            <small><?= h($p['descripcion']) ?></small>
        </h1>
        <div class="btn-group">
            <a href="<?= h($p['google_form']) ?>" target="_blank" class="btn btn-primary">
                📋 Hacer Pre-Registro
            </a>
            <a href="#plan" class="btn btn-outline">Ver Plan de Estudios</a>
        </div>
    </div>
</section>

<!-- ── Info cards ── -->
<section class="bg-white">
    <div class="container">
        <div class="info-cards">
            <div class="info-card">
                <div class="icon">⏱</div>
                <div class="value"><?= h($p['duracion']) ?></div>
                <div class="label">Duración</div>
            </div>
            <div class="info-card">
                <div class="icon">📚</div>
                <div class="value"><?= h($p['modalidad']) ?></div>
                <div class="label">Modalidad</div>
            </div>
            <div class="info-card">
                <div class="icon">💻</div>
                <div class="value">Viernes</div>
                <div class="label"><?= h($p['horario_viernes']) ?></div>
            </div>
            <div class="info-card">
                <div class="icon">🏛️</div>
                <div class="value">Sábados</div>
                <div class="label"><?= h($p['horario_sabado']) ?></div>
            </div>
            <div class="info-card">
                <div class="icon">💰</div>
                <div class="value"><?= h($p['costo_inscripcion']) ?></div>
                <div class="label">Inscripción</div>
            </div>
        </div>
    </div>
</section>

<!-- ── Plan de estudios ── -->
<section class="bg-light" id="plan">
    <div class="container">
        <div class="section-title">
            <h2>Plan de Estudios</h2>
            <p><?= count($p['plan_estudios']) ?> cuatrimestres · <?= array_sum(array_map('count', $p['plan_estudios'])) ?> materias en total</p>
        </div>
        <div class="plan-grid">
            <?php foreach ($p['plan_estudios'] as $cuatri => $materias): ?>
            <div class="cuatrimestre-card">
                <h4><?= h($cuatri) ?></h4>
                <ul>
                    <?php foreach ($materias as $m): ?>
                    <li><?= h($m) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ── Requisitos ── -->
<section class="bg-white" id="requisitos">
    <div class="container">
        <div class="section-title">
            <h2>Requisitos de Admisión</h2>
            <p>Documentos necesarios para realizar tu preregistro</p>
        </div>
        <div class="requisitos-list">
            <?php foreach ($p['requisitos'] as $i => $req): ?>
            <div class="requisito-item">
                <div class="requisito-num"><?= $i + 1 ?></div>
                <span><?= h($req) ?></span>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ── CTA ── -->
<section class="cta-section">
    <div class="container">
        <h2>¡Inicia tu Preregistro Ahora!</h2>
        <p>Completa el formulario de preregistro y da el primer paso hacia tu carrera en seguridad pública.</p>
        <a href="<?= h($p['google_form']) ?>" target="_blank" class="btn btn-primary" style="font-size:16px; padding:15px 36px;">
            📋 Hacer Pre-Registro — <?= h($p['nombre']) ?>
        </a>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
