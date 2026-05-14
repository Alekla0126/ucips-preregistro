<?php
define('IN_APP', true);
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/db.php';

requireLogin();

$db = getDB();

$where  = [];
$params = [];

if (!empty($_GET['programa'])) { $where[] = 'programa = ?'; $params[] = $_GET['programa']; }
if (!empty($_GET['status']))   { $where[] = 'status = ?';   $params[] = $_GET['status']; }

$whereSQL  = $where ? 'WHERE ' . implode(' AND ', $where) : '';
$registros = $db->prepare("SELECT * FROM preregistros $whereSQL ORDER BY created_at DESC");
$registros->execute($params);
$registros = $registros->fetchAll();

$filename = 'preregistros_ucips_' . date('Ymd_His') . '.csv';

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="' . $filename . '"');

$out = fopen('php://output', 'w');
fprintf($out, chr(0xEF).chr(0xBB).chr(0xBF)); // UTF-8 BOM

fputcsv($out, [
    'ID', 'Programa', 'Nombre', 'Apellido Paterno', 'Apellido Materno',
    'Email', 'Teléfono', 'CURP', 'Fecha Nacimiento', 'Género',
    'Municipio', 'Estado', 'Grado Estudios', 'Ocupación', 'Institución',
    'Cómo se enteró', 'Comentarios', 'Estado Registro', 'Fecha Registro',
]);

foreach ($registros as $r) {
    fputcsv($out, [
        $r['id'], $r['programa'], $r['nombre'], $r['apellido_paterno'], $r['apellido_materno'],
        $r['email'], $r['telefono'], $r['curp'], $r['fecha_nacimiento'], $r['genero'],
        $r['municipio'], $r['estado'], $r['grado_estudios'], $r['ocupacion'], $r['institucion'],
        $r['como_enteraste'], $r['comentarios'], $r['status'], $r['created_at'],
    ]);
}

fclose($out);
exit;
