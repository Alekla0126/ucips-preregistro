<?php
define('IN_APP', true);
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . siteUrl());
    exit;
}

// CSRF
verifyCsrf();

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

// Validar enums
$allowed_genero  = ['Masculino', 'Femenino', 'Prefiero no decir'];
$allowed_estado  = ['Puebla','Tlaxcala','Hidalgo','Morelos','Veracruz','Oaxaca','CDMX','Otro'];
$allowed_grado   = ['Preparatoria','TSU','Licenciatura','Maestría','Doctorado'];
$allowed_enteraste = ['Redes sociales','Compañero de trabajo','Jefe superior','Página web UCIPS','Volante / Cartel','Otro',''];

if (!in_array($_POST['genero'], $allowed_genero, true)) {
    header("Location: $redir&err=" . urlencode('Género no válido.'));
    exit;
}
if (!in_array($_POST['estado'], $allowed_estado, true)) {
    header("Location: $redir&err=" . urlencode('Estado no válido.'));
    exit;
}
if (!in_array($_POST['grado_estudios'], $allowed_grado, true)) {
    header("Location: $redir&err=" . urlencode('Grado de estudios no válido.'));
    exit;
}
if (!in_array($_POST['como_enteraste'] ?? '', $allowed_enteraste, true)) {
    $_POST['como_enteraste'] = '';
}

// Sanitizar
$clean = [];
foreach (['nombre','apellido_paterno','apellido_materno','curp','fecha_nacimiento','genero',
          'email','telefono','municipio','estado','grado_estudios','ocupacion',
          'institucion','como_enteraste','comentarios'] as $f) {
    $clean[$f] = trim(strip_tags($_POST[$f] ?? ''));
}

$clean['curp'] = strtoupper($clean['curp']);
// Limitar longitud de comentarios
$clean['comentarios'] = mb_substr($clean['comentarios'], 0, 600);

$clean['ip_address'] = $_SERVER['HTTP_CF_CONNECTING_IP']
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
        $clean['nombre'],         $clean['apellido_paterno'], $clean['apellido_materno'],
        $clean['email'],          $clean['telefono'],
        $clean['curp'],           $clean['fecha_nacimiento'], $clean['genero'],
        $clean['municipio'],      $clean['estado'],
        $clean['grado_estudios'], $clean['ocupacion'],        $clean['institucion'],
        $clean['como_enteraste'], $clean['comentarios'],      $clean['ip_address'],
    ]);

    // Regenerar token CSRF tras uso exitoso
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

    header("Location: $redir&ok=1");
    exit;

} catch (Exception $e) {
    header("Location: $redir&err=" . urlencode('Error al guardar. Intenta de nuevo.'));
    exit;
}
