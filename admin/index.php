<?php
define('IN_APP', true);
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/db.php';

requireLogin();

$db = getDB();

// Filtros
$programa  = $_GET['programa']  ?? '';
$status    = $_GET['status']    ?? '';
$busqueda  = $_GET['q']         ?? '';

$where  = [];
$params = [];

if ($programa) { $where[] = 'programa = ?'; $params[] = $programa; }
if ($status)   { $where[] = 'status = ?';   $params[] = $status; }
if ($busqueda) {
    $where[] = "(nombre LIKE ? OR apellido_paterno LIKE ? OR email LIKE ? OR curp LIKE ?)";
    $b = "%$busqueda%";
    array_push($params, $b, $b, $b, $b);
}

$whereSQL = $where ? 'WHERE ' . implode(' AND ', $where) : '';

$registros = $db->prepare("SELECT * FROM preregistros $whereSQL ORDER BY created_at DESC");
$registros->execute($params);
$registros = $registros->fetchAll();

// Stats
$total       = $db->query("SELECT COUNT(*) FROM preregistros")->fetchColumn();
$pendientes  = $db->query("SELECT COUNT(*) FROM preregistros WHERE status='pendiente'")->fetchColumn();
$revisados   = $db->query("SELECT COUNT(*) FROM preregistros WHERE status='revisado'")->fetchColumn();
$hoy         = $db->query("SELECT COUNT(*) FROM preregistros WHERE DATE(created_at)=DATE('now')")->fetchColumn();

// Lista de programas para filtro
global $PROGRAMS;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard · Admin UCIPS</title>
    <link rel="stylesheet" href="<?= siteUrl('assets/css/style.css') ?>">
    <style>
        body { background: var(--light); }
        .pagination { display:flex; gap:6px; justify-content:flex-end; padding:14px 20px; }
        .empty { text-align:center; padding:40px; color:var(--text-light); }
    </style>
</head>
<body>
<div class="admin-layout">

    <!-- Sidebar -->
    <aside class="admin-sidebar">
        <div class="admin-sidebar-header">
            <img src="<?= SITE_LOGO ?>" alt="UCIPS" onerror="this.style.display='none'">
            <div class="name">UCIPS Admin</div>
            <div class="sub">Preregistro</div>
        </div>
        <nav class="admin-nav">
            <a href="index.php" class="active">
                <span class="nav-icon">📋</span> Preregistros
            </a>
            <a href="exportar.php<?= $whereSQL ? '?' . http_build_query(['programa'=>$programa,'status'=>$status,'q'=>$busqueda]) : '' ?>">
                <span class="nav-icon">⬇️</span> Exportar CSV
            </a>
            <hr>
            <a href="<?= siteUrl() ?>" target="_blank">
                <span class="nav-icon">🌐</span> Ver Sitio
            </a>
            <a href="logout.php">
                <span class="nav-icon">🚪</span> Cerrar Sesión
            </a>
        </nav>
    </aside>

    <!-- Content -->
    <main class="admin-content">
        <div class="admin-topbar">
            <div>
                <h1>Preregistros</h1>
                <div class="sub">Bienvenido, <?= h($_SESSION['admin_user']) ?></div>
            </div>
            <a href="exportar.php" class="btn btn-success btn-sm">⬇ Exportar CSV</a>
        </div>

        <!-- Stats -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="val"><?= $total ?></div>
                <div class="label">Total</div>
            </div>
            <div class="stat-card" style="border-color:#FFC107">
                <div class="val"><?= $pendientes ?></div>
                <div class="label">Pendientes</div>
            </div>
            <div class="stat-card" style="border-color:var(--success)">
                <div class="val"><?= $revisados ?></div>
                <div class="label">Revisados</div>
            </div>
            <div class="stat-card" style="border-color:var(--secondary)">
                <div class="val"><?= $hoy ?></div>
                <div class="label">Hoy</div>
            </div>
        </div>

        <!-- Table -->
        <div class="table-card">
            <div class="table-card-header">
                <h2>Lista de Preregistros (<?= count($registros) ?>)</h2>
                <form method="GET" class="filter-bar">
                    <input type="text" name="q" value="<?= h($busqueda) ?>" placeholder="Buscar nombre, email, CURP…">
                    <select name="programa">
                        <option value="">Todos los programas</option>
                        <?php foreach ($PROGRAMS as $prog): ?>
                        <option value="<?= h($prog['id']) ?>" <?= $programa===$prog['id']?'selected':'' ?>>
                            <?= h($prog['nombre']) ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                    <select name="status">
                        <option value="">Todos los estados</option>
                        <option value="pendiente" <?= $status==='pendiente'?'selected':'' ?>>Pendiente</option>
                        <option value="revisado"  <?= $status==='revisado'?'selected':'' ?>>Revisado</option>
                        <option value="rechazado" <?= $status==='rechazado'?'selected':'' ?>>Rechazado</option>
                    </select>
                    <button type="submit" class="btn btn-secondary btn-sm">Filtrar</button>
                    <?php if ($programa || $status || $busqueda): ?>
                    <a href="index.php" class="btn btn-sm" style="background:#eee;color:var(--text)">Limpiar</a>
                    <?php endif; ?>
                </form>
            </div>

            <?php if (empty($registros)): ?>
            <div class="empty">
                <p style="font-size:40px;margin-bottom:10px">📭</p>
                <p>No hay preregistros <?= $busqueda||$programa||$status ? 'con esos filtros' : 'aún' ?>.</p>
            </div>
            <?php else: ?>
            <div style="overflow-x:auto">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Programa</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($registros as $r): ?>
                        <tr>
                            <td><?= $r['id'] ?></td>
                            <td>
                                <strong><?= h($r['nombre'] . ' ' . $r['apellido_paterno'] . ' ' . $r['apellido_materno']) ?></strong>
                                <?php if ($r['telefono']): ?>
                                <br><small style="color:var(--text-light)"><?= h($r['telefono']) ?></small>
                                <?php endif; ?>
                            </td>
                            <td><?= h($r['email']) ?></td>
                            <td><?= h($PROGRAMS[$r['programa']]['nombre'] ?? $r['programa']) ?></td>
                            <td>
                                <span class="badge-status badge-<?= h($r['status']) ?>">
                                    <?= h($r['status']) ?>
                                </span>
                            </td>
                            <td><?= date('d/m/Y H:i', strtotime($r['created_at'])) ?></td>
                            <td>
                                <a href="ver.php?id=<?= $r['id'] ?>" class="btn btn-secondary btn-xs">Ver</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php endif; ?>
        </div>
    </main>
</div>
</body>
</html>
