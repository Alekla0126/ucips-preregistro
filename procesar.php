<?php
define('IN_APP', true);
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . siteUrl());
    exit;
}

$programa = preg_replace('/[^a-z0-9]/', '', strtolower($_POST['programa'] ?? ''));

if (!isset($PROGRAMS[$programa])) {
    header('Location: ' . siteUrl());
    exit;
}

$redir = siteUrl('preregistro.php?id=' . $programa);

// Campos requeridos
$required = ['nombre', 'apellido_paterno', 'apellido_materno', 'curp', 'fecha_nacimiento',
             'genero', 'email', 'telefono', 'municipio', 'estado', 'grado_estudios',
             'ocupacion', 'institucion'];

foreach ($required as $field) {
    if (empty(trim($_POST[$field] ?? ''))) {
        $label = str_replace('_', ' ', $field);
        header("Location: $redir&err=" . urlencode("El campo \"$label\" es obligatorio."));
        exit;
    }
}

// Validar email
if (!filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL)) {
    header("Location: $redir&err=" . urlencode('El correo electrónico no es válido.'));
    exit;
}

// Sanitizar
$clean = [];
foreach (['nombre','apellido_paterno','apellido_materno','curp','fecha_nacimiento','genero',
          'email','telefono','municipio','estado','grado_estudios','ocupacion',
          'institucion','como_enteraste','comentarios'] as $f) {
    $clean[$f] = trim(strip_tags($_POST[$f] ?? ''));
}

$clean['curp']         = strtoupper($clean['curp']);
$clean['ip_address']   = $_SERVER['HTTP_CF_CONNECTING_IP']
                      ?? $_SERVER['HTTP_X_FORWARDED_FOR']
                      ?? $_SERVER['REMOTE_ADDR'];

try {
    $db = getDB();
    $db->prepare("
        INSERT INTO preregistros
            (programa, nombre, apellido_paterno, apellido_materno, email, telefono,
             curp, fecha_nacimiento, genero, municipio, estado, grado_estudios,
             ocupacion, institucion, como_enteraste, comentarios, ip_address, status)
        VALUES
            (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'pendiente')
    ")->execute([
        $programa,
        $clean['nombre'],        $clean['apellido_paterno'], $clean['apellido_materno'],
        $clean['email'],         $clean['telefono'],
        $clean['curp'],          $clean['fecha_nacimiento'], $clean['genero'],
        $clean['municipio'],     $clean['estado'],
        $clean['grado_estudios'],$clean['ocupacion'],        $clean['institucion'],
        $clean['como_enteraste'],$clean['comentarios'],      $clean['ip_address'],
    ]);

    header("Location: $redir&ok=1");
    exit;

} catch (Exception $e) {
    header("Location: $redir&err=" . urlencode('Error al guardar. Intenta de nuevo.'));
    exit;
}
