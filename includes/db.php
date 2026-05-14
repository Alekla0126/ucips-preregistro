<?php
require_once __DIR__ . '/../config.php';

function getDB(): PDO {
    static $db = null;
    if ($db === null) {
        $dir = dirname(DB_PATH);
        if (!is_dir($dir)) mkdir($dir, 0755, true);
        $db = new PDO('sqlite:' . DB_PATH);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        initDB($db);
    }
    return $db;
}

function initDB(PDO $db): void {
    $db->exec("
        CREATE TABLE IF NOT EXISTS preregistros (
            id               INTEGER PRIMARY KEY AUTOINCREMENT,
            programa         TEXT NOT NULL,
            nombre           TEXT NOT NULL,
            apellido_paterno TEXT NOT NULL,
            apellido_materno TEXT NOT NULL,
            email            TEXT NOT NULL,
            telefono         TEXT NOT NULL,
            curp             TEXT,
            fecha_nacimiento DATE,
            genero           TEXT,
            municipio        TEXT,
            estado           TEXT DEFAULT 'Puebla',
            grado_estudios   TEXT,
            ocupacion        TEXT,
            institucion      TEXT,
            como_enteraste   TEXT,
            comentarios      TEXT,
            ip_address       TEXT,
            status           TEXT DEFAULT 'pendiente',
            created_at       DATETIME DEFAULT CURRENT_TIMESTAMP
        );

        CREATE TABLE IF NOT EXISTS admin_sessions (
            token      TEXT PRIMARY KEY,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        );
    ");
}
