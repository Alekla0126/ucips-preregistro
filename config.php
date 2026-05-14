<?php
// Database
define('DB_PATH', __DIR__ . '/data/preregistro.db');

// Site config
define('SITE_NAME', 'UCIPS · Preregistro');
define('SITE_URL', 'https://plataformaucips.com/preregistro');
define('SITE_ADDRESS', 'Camino Vecinal a Santa Cruz Alpuyeca, km 6.5, Chachapa, C.P. 72990, Amozoc, Puebla.');
define('SITE_EMAIL', 'servicios.escolares.ucips@puebla.gob.mx');
define('SITE_PHONE', 'Ext. disponible en horario de oficina');
define('SITE_HOURS', 'Lunes a Viernes, 9:00 AM – 6:00 PM');
define('SITE_COPYRIGHT', '© 2026 UCIPS');
define('SITE_LOGO', 'https://yacdergaming.com/ucips/logo-ucips.png');

// Admin credentials (cambiar contraseña en producción)
define('ADMIN_USER', 'admin');
define('ADMIN_PASS_HASH', '$2y$12$aVTtiYPH.ouk9Zgi29OdEOH21Hmam.XHrtslfg23AH9Ce7qB.SaxG'); // ucips2026

// Programas disponibles
$PROGRAMS = [
    'seguridadyproteccion' => [
        'id'                 => 'seguridadyproteccion',
        'nombre'             => 'Seguridad y Protección Ciudadana',
        'tipo'               => 'Licenciatura Premium',
        'icono'              => '🛡️',
        'color'              => '#1E4D7B',
        'descripcion'        => 'Formación profesional enfocada en prevención, operación institucional, seguridad pública, análisis delictivo y protección ciudadana.',
        'duracion'           => '9 Cuatrimestres',
        'modalidad'          => 'MIXTA',
        'horario_viernes'    => 'Virtual · 6:00 – 10:00 PM',
        'horario_sabado'     => 'Presencial · 9:00 AM – 3:00 PM',
        'costo_inscripcion'  => '$500',
        'google_form'        => 'https://docs.google.com/forms/d/e/1FAIpQLSdnGyPvkzL5ZRZBY6uNUqKU_HV5dUL7vXlWeRig97f-iWjcsg/viewform',
        'plan_estudios'      => [
            '1er Cuatrimestre' => ['Introducción a la Seguridad', 'Fundamentos de Criminología', 'Marco Jurídico de Seguridad', 'Metodología I'],
            '2do Cuatrimestre' => ['Prevención del Delito', 'Derechos Humanos', 'Seguridad Comunitaria', 'Metodología II'],
            '3er Cuatrimestre' => ['Política Criminal', 'Criminalística de Campo', 'Primer Respondiente', 'Manejo de Conflictos'],
            '4to Cuatrimestre' => ['Inteligencia Pública', 'Victimología', 'Seguridad Vial', 'Justicia Cívica'],
            '5to Cuatrimestre' => ['Seguridad Privada', 'Gestión de Riesgos', 'Operación Centros C5', 'Informática Aplicada'],
            '6to Cuatrimestre' => ['Eventos Masivos', 'Protección Civil', 'Infraestructura Crítica', 'Ética Policial'],
            '7mo Cuatrimestre' => ['Planeación Operativa', 'Análisis Delictivo', 'Ciberprevención', 'Gestión de Reportes'],
            '8vo Cuatrimestre' => ['Evaluación de Programas', 'Gestión de Calidad', 'Perspectiva de Género', 'Seminario Titulación I'],
            '9no Cuatrimestre' => ['Seguridad y Cultura de Paz', 'Marco Internacional', 'Proyectos en Seguridad', 'Seminario Titulación II'],
        ],
        'requisitos'         => [
            'Identificación oficial vigente',
            'CURP actualizada (2025 o 2026)',
            'Acta de nacimiento (2025 o 2026)',
            'Certificado de preparatoria',
            'Documentación laboral actual',
            'Carta de recomendación del superior inmediato',
            'Carta de motivos',
        ],
    ],
    // Agregar más programas aquí
];
