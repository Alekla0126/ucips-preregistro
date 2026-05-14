<?php
define('IN_APP', true);
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/auth.php';

if (isLoggedIn()) {
    header('Location: ' . adminUrl('index.php'));
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = trim($_POST['username'] ?? '');
    $pass = trim($_POST['password'] ?? '');
    if (attemptLogin($user, $pass)) {
        header('Location: ' . adminUrl('index.php'));
        exit;
    }
    $error = 'Usuario o contraseña incorrectos.';
    sleep(1);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Administrativo · UCIPS</title>
    <link rel="stylesheet" href="<?= siteUrl('assets/css/admin.css') ?>">
</head>
<body>
<div class="login-page">
    <div class="login-card">
        <div class="login-logo">
            <img src="<?= SITE_LOGO ?>" alt="UCIPS" onerror="this.style.display='none'">
            <h1>Panel Administrativo</h1>
            <p>UCIPS · Sistema de Preregistro</p>
        </div>

        <?php if ($error): ?>
        <div class="alert alert-error"><?= h($error) ?></div>
        <?php endif; ?>

        <form method="POST" autocomplete="off">
            <div class="form-group" style="margin-bottom:14px">
                <label for="username">Usuario</label>
                <input type="text" id="username" name="username" required autofocus
                       value="<?= h($_POST['username'] ?? '') ?>" placeholder="admin">
            </div>
            <div class="form-group" style="margin-bottom:22px">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required placeholder="••••••••">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
        </form>

        <p style="text-align:center; margin-top:18px; font-size:13px; color:var(--text-light)">
            <a href="<?= siteUrl() ?>">← Volver al sitio</a>
        </p>
    </div>
</div>
</body>
</html>
