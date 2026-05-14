<?php
// Base de datos
define('DB_PATH', __DIR__ . '/data/preregistro.db');

// Configuración del sitio
define('SITE_NAME',      'UCIPS · Preregistro');
define('SITE_URL',       'https://plataformaucips.com/preregistro');
define('SITE_ADDRESS',   'Camino Vecinal a Santa Cruz Alpuyeca, km 6.5, Chachapa, C.P. 72990, Amozoc, Puebla.');
define('SITE_EMAIL',     'servicios.escolares.ucips@puebla.gob.mx');
define('SITE_PHONE',     'Tel. 222 144 1000 ext. 32134');
define('SITE_HOURS',     'Lunes a Viernes · 09:00 – 18:00 hrs');
define('SITE_COPYRIGHT', '© 2026 UCIPS');
define('SITE_LOGO',      'https://yacdergaming.com/preregistro/imagenes/logo.png');

// Admin (usuario: admin / contraseña: ucips2026)
define('ADMIN_USER',      'admin');
define('ADMIN_PASS_HASH', '$2y$12$aVTtiYPH.ouk9Zgi29OdEOH21Hmam.XHrtslfg23AH9Ce7qB.SaxG');

// ══════════════════════════════════════════════════════════════
//  PROGRAMAS
// ══════════════════════════════════════════════════════════════
$PROGRAMS = [

    // ──────────────────────────────────────────────────────────
    'seguridadyproteccion' => [
        'id'          => 'seguridadyproteccion',
        'nombre'      => 'Seguridad y Protección Ciudadana',
        'tipo'        => 'Licenciatura Premium',
        'icono'       => '🛡️',
        'descripcion' => 'Formación profesional enfocada en prevención, operación institucional, seguridad pública, análisis delictivo y protección ciudadana.',
        'dirigido'    => 'Dirigido a Personal de Seguridad Pública y Procuración de Justicia',
        'duracion'    => '9',
        'modalidad'   => 'MIXTA',
        'plan_estudios' => [
            '1° Cuatrimestre' => ['Introducción a la Seguridad','Fundamentos de Criminología','Marco Jurídico de Seguridad','Metodología I'],
            '2° Cuatrimestre' => ['Prevención del Delito','Derechos Humanos','Seguridad Comunitaria','Metodología II'],
            '3° Cuatrimestre' => ['Política Criminal','Criminalística de Campo','Primer Respondiente','Manejo de Conflictos'],
            '4° Cuatrimestre' => ['Inteligencia Pública','Victimología','Seguridad Vial','Justicia Cívica'],
            '5° Cuatrimestre' => ['Seguridad Privada','Gestión de Riesgos','Operación Centros C5','Informática Aplicada'],
            '6° Cuatrimestre' => ['Eventos Masivos','Protección Civil','Infraestructura Crítica','Ética Policial'],
            '7° Cuatrimestre' => ['Planeación Operativa','Análisis Delictivo','Ciberprevención','Gestión de Reportes'],
            '8° Cuatrimestre' => ['Evaluación de Programas','Gestión de Calidad','Perspectiva de Género','Seminario Titulación I'],
            '9° Cuatrimestre' => ['Seguridad y Cultura de Paz','Marco Internacional','Proyectos en Seguridad','Seminario Titulación II'],
        ],
        'requisitos' => [
            'Identificación oficial vigente',
            'CURP actualizada (2025 o 2026)',
            'Acta de Nacimiento (2025 o 2026)',
            'Certificado de Bachillerato',
            'Nombramiento laboral vigente',
            'Carta de postulación de jefe inmediato',
            'Carta de exposición de motivos',
        ],
    ],

    // ──────────────────────────────────────────────────────────
    'derecho' => [
        'id'          => 'derecho',
        'nombre'      => 'Derecho y Seguridad Pública',
        'tipo'        => 'Licenciatura',
        'icono'       => '⚖️',
        'descripcion' => 'Formación profesional de alto nivel orientada al ámbito jurídico, policial y estratégico para el fortalecimiento institucional, la investigación y la seguridad pública.',
        'dirigido'    => 'Dirigido a Personal de Seguridad Pública y Procuración de Justicia',
        'duracion'    => '9',
        'modalidad'   => 'MIXTA',
        'plan_estudios' => [
            '1° Cuatrimestre' => ['Investigación Social','Filosofía del Derecho','Estudio del Derecho','Seguridad Pública'],
            '2° Cuatrimestre' => ['Derecho Penal','Historia del Derecho','Garantías Constitucionales','Modelos de Seguridad'],
            '3° Cuatrimestre' => ['Sistema Penal Acusatorio','Sociología Jurídica','Persona y Familia','Derecho Corporativo'],
            '4° Cuatrimestre' => ['Derecho Administrativo','Criminología','Derechos Humanos','Investigación Criminal'],
            '5° Cuatrimestre' => ['Derecho Procesal Penal','Seguridad Institucional','Psicología Criminal','Derecho Constitucional'],
            '6° Cuatrimestre' => ['Juicios Orales','Litigación Estratégica','Investigación Jurídica','Seguridad Estratégica'],
            '7° Cuatrimestre' => ['Política Criminal','Delitos Especiales','Derecho Internacional','Inteligencia Institucional'],
            '8° Cuatrimestre' => ['Gestión Institucional','Seguridad Nacional','Ética Profesional','Administración Pública'],
            '9° Cuatrimestre' => ['Seminario de Titulación','Investigación Aplicada','Planeación Estratégica','Proyecto Profesional'],
        ],
        'requisitos' => [
            'Identificación oficial vigente',
            'CURP actualizada (2025 o 2026)',
            'Acta de Nacimiento (Emisión 2025 o 2026)',
            'Certificado de Bachillerato',
            'Nombramiento laboral vigente',
            'Carta de postulación de jefe inmediato',
            'Carta de exposición de motivos',
        ],
    ],

];
