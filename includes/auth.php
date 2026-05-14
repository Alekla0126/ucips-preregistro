<?php
require_once __DIR__ . '/../config.php';

session_start();

function isLoggedIn(): bool {
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

function requireLogin(): void {
    if (!isLoggedIn()) {
        header('Location: ' . adminUrl('login.php'));
        exit;
    }
}

function attemptLogin(string $user, string $pass): bool {
    if ($user === ADMIN_USER && password_verify($pass, ADMIN_PASS_HASH)) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_user'] = $user;
        return true;
    }
    return false;
}

function logout(): void {
    session_destroy();
}

function adminUrl(string $page = ''): string {
    $base = '/preregistro/admin/';
    return $base . $page;
}

function siteUrl(string $page = ''): string {
    return '/preregistro/' . $page;
}

function h(string $str): string {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
