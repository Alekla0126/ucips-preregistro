<?php
require_once __DIR__ . '/../config.php';

define('SESSION_TIMEOUT',   1800); // 30 minutos de inactividad
define('LOGIN_MAX_TRIES',   5);    // intentos antes de bloqueo
define('LOGIN_LOCKOUT_SEC', 300);  // 5 minutos bloqueado

session_set_cookie_params([
    'lifetime' => 0,
    'path'     => '/preregistro/',
    'secure'   => isset($_SERVER['HTTPS']),
    'httponly' => true,
    'samesite' => 'Strict',
]);
session_start();

function isLoggedIn(): bool {
    if (empty($_SESSION['admin_logged_in'])) return false;

    // Timeout por inactividad
    if (isset($_SESSION['last_activity']) && time() - $_SESSION['last_activity'] > SESSION_TIMEOUT) {
        session_unset();
        session_destroy();
        return false;
    }
    $_SESSION['last_activity'] = time();
    return true;
}

function requireLogin(): void {
    if (!isLoggedIn()) {
        header('Location: ' . adminUrl('login.php'));
        exit;
    }
}

function isLockedOut(): bool {
    if (empty($_SESSION['login_fails'])) return false;
    if ($_SESSION['login_fails'] < LOGIN_MAX_TRIES) return false;
    $wait = (int)$_SESSION['login_fail_time'] + LOGIN_LOCKOUT_SEC - time();
    if ($wait <= 0) {
        unset($_SESSION['login_fails'], $_SESSION['login_fail_time']);
        return false;
    }
    return true;
}

function lockoutSecondsLeft(): int {
    return max(0, (int)($_SESSION['login_fail_time'] ?? 0) + LOGIN_LOCKOUT_SEC - time());
}

function attemptLogin(string $user, string $pass): bool {
    if (isLockedOut()) return false;

    if ($user === ADMIN_USER && password_verify($pass, ADMIN_PASS_HASH)) {
        session_regenerate_id(true); // previene session fixation
        unset($_SESSION['login_fails'], $_SESSION['login_fail_time']);
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_user']      = $user;
        $_SESSION['last_activity']   = time();
        return true;
    }

    $_SESSION['login_fails']     = ($_SESSION['login_fails'] ?? 0) + 1;
    $_SESSION['login_fail_time'] = time();
    return false;
}

function logout(): void {
    session_unset();
    session_destroy();
}

function csrfToken(): string {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function verifyCsrf(): void {
    $stored = $_SESSION['csrf_token'] ?? '';
    $token  = $_POST['csrf'] ?? '';
    if (!$stored || !$token || !hash_equals($stored, $token)) {
        http_response_code(403);
        exit('Solicitud inválida.');
    }
}

function adminUrl(string $page = ''): string {
    return '/preregistro/admin/' . $page;
}

function siteUrl(string $page = ''): string {
    return '/preregistro/' . $page;
}

function h(string $str): string {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
