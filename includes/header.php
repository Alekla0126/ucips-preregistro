<?php
defined('IN_APP') || die('Acceso denegado');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle ?? SITE_NAME) ?></title>
    <meta name="description" content="Sistema de preregistro UCIPS – Universidad de las Ciencias Policiales y de la Seguridad del Estado de Puebla.">
    <link rel="stylesheet" href="<?= siteUrl('assets/css/style.css') ?>">
    <link rel="icon" href="<?= SITE_LOGO ?>" type="image/png">
</head>
<body>

<header class="site-header">
    <div class="header-top">
        Licenciatura Premium &nbsp;·&nbsp; UCIPS Puebla &nbsp;·&nbsp; Modalidad Mixta
    </div>
    <div class="header-main">
        <a href="<?= siteUrl() ?>" class="logo">
            <img src="<?= SITE_LOGO ?>" alt="UCIPS" onerror="this.style.display='none'">
            <div class="logo-text">
                <span class="inst">UCIPS Puebla</span>
                <span class="name">Preregistro</span>
            </div>
        </a>
        <nav>
            <a href="<?= siteUrl() ?>">Inicio</a>
            <a href="<?= siteUrl('#programas') ?>">Programas</a>
            <a href="<?= siteUrl('#contacto') ?>">Contacto</a>
            <a href="<?= siteUrl('admin/login.php') ?>" class="btn btn-primary btn-sm">Admin</a>
        </nav>
    </div>
</header>
