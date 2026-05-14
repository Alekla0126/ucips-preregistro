<?php
define('IN_APP', true);
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/db.php';

requireLogin();

$id = (int)($_GET['id'] ?? 0);
$db = getDB();
$r  = $db->prepare("SELECT * FROM preregistros WHERE id = ?");
$r->execute([$id]);
$r  = $r->fetch();

if (!$r) { header('Location: index.php'); exit; }

// Cambiar status
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['status'])) {
    verifyCsrf();
    $allowed = ['pendiente', 'revisado', 'rechazado'];
    $ns = in_array($_POST['status'], $allowed) ? $_POST['status'] : 'pendiente';
    $db->prepare("UPDATE preregistros SET status = ? WHERE id = ?")->execute([$ns, $id]);
    $r['status'] = $ns;
}

global $PROGRAMS;
$programa = $PROGRAMS[$r['programa']] ?? ['nombre' => $r['programa']];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preregistro #<?= $id ?> · Admin UCIPS</title>
    <link rel="stylesheet" href="<?= siteUrl('assets/css/admin.css') ?>">
</head>
<body>
<div class="admin-layout">

    <aside class="admin-sidebar">
        <div class="admin-sidebar-header">
            <img src="<?= SITE_LOGO ?>" alt="UCIPS" onerror="this.style.display='none'">
            <div class="name">UCIPS Admin</div>
            <div class="sub">Preregistro</div>
        </div>
        <nav class="admin-nav">
            <a href="index.php"><span class="nav-icon">📋</span> Preregistros</a>
            <a href="exportar.php"><span class="nav-icon">⬇️</span> Exportar CSV</a>
            <hr>
            <a href="<?= siteUrl() ?>" target="_blank"><span class="nav-icon">🌐</span> Ver Sitio</a>
            <a href="logout.php"><span class="nav-icon">🚪</span> Cerrar Sesión</a>
        </nav>
    </aside>

    <main class="admin-content">
        <div class="admin-topbar">
            <div>
                <h1>Preregistro #<?= $id ?></h1>
                <div class="sub">
                    <a href="index.php" style="color:var(--secondary)">← Regresar a la lista</a>
                </div>
            </div>
            <div style="display:flex; gap:10px; align-items:center">
                <form method="POST" style="display:flex; gap:8px; align-items:center">
                    <input type="hidden" name="csrf" value="<?= h(csrfToken()) ?>">
                    <select name="status" style="padding:7px 11px; border:1.5px solid var(--border); border-radius:6px; font-size:13px; background:white;">
                        <option value="pendiente"  <?= $r['status']==='pendiente'?'selected':'' ?>>Pendiente</option>
                        <option value="revisado"   <?= $r['status']==='revisado'?'selected':'' ?>>Revisado</option>
                        <option value="rechazado"  <?= $r['status']==='rechazado'?'selected':'' ?>>Rechazado</option>
                    </select>
                    <button class="btn btn-secondary btn-sm">Actualizar Estado</button>
                </form>
            </div>
        </div>

        <!-- Info card -->
        <div style="background:white; border-radius:var(--radius); padding:24px; margin-bottom:20px; box-shadow:var(--shadow)">
            <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:20px; flex-wrap:wrap; gap:10px">
                <div>
                    <h2 style="font-size:22px; color:var(--primary)">
                        <?= h($r['nombre'] . ' ' . $r['apellido_paterno'] . ' ' . $r['apellido_materno']) ?>
                    </h2>
                    <p style="color:var(--text-light); margin-top:4px">
                        <?= h($programa['nombre']) ?> &nbsp;·&nbsp;
                        Registrado el <?= date('d/m/Y \a \l\a\s H:i', strtotime($r['created_at'])) ?>
                    </p>
                </div>
                <span class="badge-status badge-<?= h($r['status']) ?>" style="font-size:13px; padding:5px 14px">
                    <?= h($r['status']) ?>
                </span>
            </div>

            <h3 style="font-size:15px; font-weight:700; color:var(--primary); margin-bottom:14px; padding-bottom:8px; border-bottom:2px solid var(--border)">
                Datos Personales
            </h3>
            <div class="detail-grid">
                <div class="detail-item">
                    <div class="d-label">Nombre</div>
                    <div class="d-value"><?= h($r['nombre']) ?></div>
                </div>
                <div class="detail-item">
                    <div class="d-label">Apellido Paterno</div>
                    <div class="d-value"><?= h($r['apellido_paterno']) ?></div>
                </div>
                <div class="detail-item">
                    <div class="d-label">Apellido Materno</div>
                    <div class="d-value"><?= h($r['apellido_materno']) ?></div>
                </div>
                <div class="detail-item">
                    <div class="d-label">CURP</div>
                    <div class="d-value"><?= h($r['curp'] ?: '—') ?></div>
                </div>
                <div class="detail-item">
                    <div class="d-label">Fecha de Nacimiento</div>
                    <div class="d-value"><?= $r['fecha_nacimiento'] ? date('d/m/Y', strtotime($r['fecha_nacimiento'])) : '—' ?></div>
                </div>
                <div class="detail-item">
                    <div class="d-label">Género</div>
                    <div class="d-value"><?= h($r['genero'] ?: '—') ?></div>
                </div>
            </div>

            <h3 style="font-size:15px; font-weight:700; color:var(--primary); margin:20px 0 14px; padding-bottom:8px; border-bottom:2px solid var(--border)">
                Contacto
            </h3>
            <div class="detail-grid">
                <div class="detail-item">
                    <div class="d-label">Email</div>
                    <div class="d-value"><a href="mailto:<?= h($r['email']) ?>"><?= h($r['email']) ?></a></div>
                </div>
                <div class="detail-item">
                    <div class="d-label">Teléfono</div>
                    <div class="d-value"><?= h($r['telefono']) ?></div>
                </div>
                <div class="detail-item">
                    <div class="d-label">Municipio</div>
                    <div class="d-value"><?= h($r['municipio'] ?: '—') ?></div>
                </div>
                <div class="detail-item">
                    <div class="d-label">Estado</div>
                    <div class="d-value"><?= h($r['estado'] ?: '—') ?></div>
                </div>
            </div>

            <h3 style="font-size:15px; font-weight:700; color:var(--primary); margin:20px 0 14px; padding-bottom:8px; border-bottom:2px solid var(--border)">
                Información Académica / Laboral
            </h3>
            <div class="detail-grid">
                <div class="detail-item">
                    <div class="d-label">Grado de Estudios</div>
                    <div class="d-value"><?= h($r['grado_estudios'] ?: '—') ?></div>
                </div>
                <div class="detail-item">
                    <div class="d-label">Ocupación</div>
                    <div class="d-value"><?= h($r['ocupacion'] ?: '—') ?></div>
                </div>
                <div class="detail-item">
                    <div class="d-label">Institución / Corporación</div>
                    <div class="d-value"><?= h($r['institucion'] ?: '—') ?></div>
                </div>
                <div class="detail-item">
                    <div class="d-label">¿Cómo se enteró?</div>
                    <div class="d-value"><?= h($r['como_enteraste'] ?: '—') ?></div>
                </div>
            </div>

            <?php if ($r['comentarios']): ?>
            <h3 style="font-size:15px; font-weight:700; color:var(--primary); margin:20px 0 10px; padding-bottom:8px; border-bottom:2px solid var(--border)">
                Comentarios
            </h3>
            <p style="font-size:14px; color:var(--text); background:#F8F9FA; padding:14px; border-radius:6px">
                <?= nl2br(h($r['comentarios'])) ?>
            </p>
            <?php endif; ?>

            <div style="margin-top:20px; padding-top:16px; border-top:1px solid var(--border); font-size:12px; color:var(--text-light)">
                IP: <?= h($r['ip_address'] ?: '—') ?> &nbsp;·&nbsp; ID: <?= $r['id'] ?> &nbsp;·&nbsp; Programa: <?= h($r['programa']) ?>
            </div>
        </div>
    </main>
</div>
</body>
</html>
