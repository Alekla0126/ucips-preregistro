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


    // ──────────────────────────────────────────────────────────
    'ciber' => [
        'id'          => 'ciber',
        'nombre'      => 'Ciberseguridad y Procesos Estratégicos de Investigación',
        'tipo'        => 'Maestría Premium',
        'icono'       => '🔐',
        'descripcion' => 'Formación de alto nivel en ciberseguridad, investigación digital, hacking ético e inteligencia estratégica para instituciones de seguridad pública.',
        'dirigido'    => 'Dirigido a Personal de Seguridad Pública y Procuración de Justicia',
        'duracion'    => '4',
        'modalidad'   => 'MIXTA',
        'plan_estudios' => [
            'Primer Semestre' => ['🕵️ Análisis Criminal','⚖️ Marco Normativo','👨‍💼 Gerencia, Alta Dirección y Liderazgo','💻 Introducción a la Estructura de Datos'],
            'Segundo Semestre' => ['🗄️ Base de Datos y Seguridad de Aplicaciones','🔍 Investigación Digital','🛡️ Hacking I','💾 Investigación Forense Digital'],
            'Tercer Semestre' => ['📡 Inteligencia Digital y Operaciones Ofensivas','⚔️ Planificación de Escenarios','🛡️ Hacking II','🚁 Manejo Operativo de APAS (Drones)'],
            'Cuarto Semestre' => ['📊 Elaboración de Productos de Inteligencia','🤖 Inteligencia Predictiva y Prospectiva','🚨 Investigación de Delitos de Alto Impacto','🧠 Optativa (IA Defensiva / C5)'],
        ],
        'requisitos' => [
            'Título y Cédula de nivel Licenciatura',
            'Certificado de estudios de Licenciatura',
            'Identificación oficial vigente',
            'CURP actualizada (2026)',
            'Acta de Nacimiento (2025 o 2026)',
            'Nombramiento laboral vigente',
            'Comprobante de domicilio menor a 3 meses',
            'Comprobante de CUIP (si aplica)',
            '1 Fotografía infantil a color reciente',
        ],
    ],

    // ──────────────────────────────────────────────────────────
    'doctorado' => [
        'id'          => 'doctorado',
        'nombre'      => 'Doctorado en Ciencias Policiales y Seguridad Pública',
        'tipo'        => 'Doctorado',
        'icono'       => '🎓',
        'descripcion' => 'Máximo grado académico orientado a la investigación avanzada en ciencias policiales, política criminal y seguridad pública institucional.',
        'dirigido'    => 'Dirigido a Personal con Grado de Maestría en Instituciones de Seguridad o Procuración de Justicia',
        'duracion'    => '4',
        'modalidad'   => 'MIXTA',
        'plan_estudios' => [
            '1° Semestre' => ['Epistemología de la seguridad pública','La seguridad pública y el rol de la función pública','Análisis y comprensión de textos sobre seguridad'],
            '2° Semestre' => ['Ontología de la seguridad pública','Marco jurídico de la función policial','Directrices para ponencias en congresos'],
            '3° Semestre' => ['Política criminal','Gestión de los órganos de seguridad ciudadana','Seminario de tesis doctoral I'],
            '4° Semestre' => ['Evolución y tendencias de la criminalidad en México','Sistema nacional de seguridad pública','Seminario de tesis doctoral II'],
        ],
        'requisitos' => [
            'Identificación oficial vigente (INE/Pasaporte)',
            'CURP (actualizada menor a 30 días)',
            'Acta de Nacimiento (emisión 2025/2026)',
            'Certificado de estudios de Maestría',
            'Título y Cédula Profesional de Maestría',
            'Comprobante de domicilio (máx. 3 meses)',
            'Fotografía infantil color (JPG, 300 dpi)',
            'Nombramiento o Credencial laboral vigente',
            'Comprobante de CUIP u Oficio de excepción',
            'Carta de postulación del jefe inmediato',
            'Carta de exposición de motivos',
        ],
    ],

    // ──────────────────────────────────────────────────────────
    'gerencia' => [
        'id'          => 'gerencia',
        'nombre'      => 'Gerencia y Administración Policial',
        'tipo'        => 'Maestría',
        'icono'       => '📋',
        'descripcion' => 'Especialización en gestión institucional, administración policial, planeación estratégica y liderazgo en corporaciones de seguridad pública.',
        'dirigido'    => 'Dirigido a Personal de Seguridad Pública y Procuración de Justicia',
        'duracion'    => '4',
        'modalidad'   => 'MIXTA',
        'plan_estudios' => [
            '1° Semestre' => ['Marco jurídico de la función policial','Introducción a la administración','Ética en el servicio público','Liderazgo, comunicación y mando policial'],
            '2° Semestre' => ['Administración pública y proceso administrativo','Planeación estratégica de instituciones de seguridad','Calidad en el servicio policial','Rendición de cuentas de la actuación policial'],
            '3° Semestre' => ['Introducción a las políticas públicas','Mecanismos anticorrupción','Administración de recursos humanos','Recursos financieros en el sector público'],
            '4° Semestre' => ['Control y auditoría en el sector público','Procesos presupuestales','Gestión pública y proyectos de inversión','Metodología de la investigación'],
        ],
        'requisitos' => [
            'Identificación oficial vigente',
            'CURP (impresión no mayor a un mes)',
            'Acta de Nacimiento (emisión 2025/2026)',
            'Certificado de estudios de Licenciatura',
            'Título y Cédula de nivel Licenciatura',
            'Comprobante de domicilio (máx. 3 meses)',
            'Foto infantil color (JPG, 300 dpi)',
            'Nombramiento laboral vigente',
            'Comprobante de CUIP / Oficio institucional',
            'Carta de postulación (Hoja membretada)',
            'Carta de exposición de motivos',
        ],
    ],

    // ──────────────────────────────────────────────────────────
    'juicios' => [
        'id'          => 'juicios',
        'nombre'      => 'Juicios Orales en Materia Penal',
        'tipo'        => 'Maestría',
        'icono'       => '⚖️',
        'descripcion' => 'Formación jurídica especializada en el sistema acusatorio, litigación oral, teoría del caso y actuación estratégica en procesos penales.',
        'dirigido'    => 'Dirigido a Personal de Seguridad Pública y Procuración de Justicia',
        'duracion'    => '4',
        'modalidad'   => 'MIXTA',
        'plan_estudios' => [
            '1° Semestre' => ['Retórica y argumentación jurídica','DDHH y sus mecanismos internacionales','Teoría general del proceso penal','Etapas del proceso penal acusatorio'],
            '2° Semestre' => ['Estrategia de negociación','Teoría del caso y litigación oral','Derecho procesal penal y teoría del delito','La prueba en el sistema acusatorio'],
            '3° Semestre' => ['Medidas cautelares','Procedimientos especiales e impugnación','Etapas del proceso penal acusatorio','El amparo en el sistema acusatorio'],
            '4° Semestre' => ['Taller de seminario de tesis','Interrogatorio y contrainterrogatorio','Justicia restaurativa y alternativa','Taller de audiencias'],
        ],
        'requisitos' => [
            'Título y Cédula de nivel Licenciatura',
            'Certificado de estudios de Licenciatura',
            'Identificación oficial vigente',
            'CURP actualizada',
            'Acta de Nacimiento (Emisión 2025/2026)',
            'Nombramiento laboral vigente',
            'Comprobante de domicilio reciente',
            'Constancia de CUIP (si aplica)',
            'Foto infantil color (JPG, 300 dpi)',
        ],
    ],

    // ──────────────────────────────────────────────────────────
    'metodologia' => [
        'id'          => 'metodologia',
        'nombre'      => 'Metodología de la Investigación Criminalística',
        'tipo'        => 'Maestría',
        'icono'       => '🔬',
        'descripcion' => 'Desarrollo de habilidades avanzadas en criminalística, investigación de campo, análisis forense y metodología de la investigación policial.',
        'dirigido'    => 'Dirigido a Personal de Seguridad Pública y Procuración de Justicia',
        'duracion'    => '4',
        'modalidad'   => 'MIXTA',
        'plan_estudios' => [
            '1° Semestre' => ['Aspectos fundamentales del sistema de justicia penal','Técnicas y actos de investigación criminal','Fotografía y planimetría','El uso de las TIC\'s en la investigación policial'],
            '2° Semestre' => ['Participación del policía en la etapa del juicio oral','Criminalística aplicada a la investigación policial','Balística y dactiloscopia en la investigación policial','Inteligencia policial'],
            '3° Semestre' => ['Proceso de investigación de hechos delictivos','Investigación de hechos de tránsito','Química y biología forense en la investigación policial','Políticas de prevención de la violencia y la delincuencia'],
            '4° Semestre' => ['Perfilación criminal','Investigación de incendios y explosivos','Medicina forense','Metodología de la investigación'],
        ],
        'requisitos' => [
            'Título y Cédula de nivel Licenciatura',
            'Certificado de estudios de Licenciatura',
            'Identificación oficial vigente',
            'CURP actualizada (no mayor a 1 mes)',
            'Acta de Nacimiento (Emisión 2025/2026)',
            'Nombramiento laboral o Constancia de CUIP',
            'Comprobante de domicilio reciente',
            'Foto infantil color (JPG, 300 dpi)',
        ],
    ],

    // ──────────────────────────────────────────────────────────
    'mseguridad' => [
        'id'          => 'mseguridad',
        'nombre'      => 'Maestría en Seguridad Pública',
        'tipo'        => 'Maestría',
        'icono'       => '🏛️',
        'descripcion' => 'Formación de alto nivel en política criminal, gobernanza, prevención del delito y gestión institucional de la seguridad pública.',
        'dirigido'    => 'Dirigido a Personal de Seguridad Pública y Procuración de Justicia',
        'duracion'    => '4',
        'modalidad'   => 'MIXTA',
        'plan_estudios' => [
            '1° Semestre' => ['La Seguridad Pública como objeto de estudio','Seguridad Pública en México','Gobernabilidad y Gobernanza','Estrategia sobre la Prevención de Delito'],
            '2° Semestre' => ['Prevención del Delito y Reinserción Social','Las Policías en el Sistema de Justicia Penal','Políticas Públicas','Víctimas del Delito'],
            '3° Semestre' => ['Modelos de Coordinación Intergubernamentales','La Construcción de la Paz y Justicia Cívica','Políticas Públicas en Materia de Seguridad','Metodología de Investigación I'],
            '4° Semestre' => ['Innovación y Gerencia Policial','Inteligencia y Contrainteligencia Policial','Evaluación de Políticas Públicas','Metodología de la Investigación II'],
        ],
        'requisitos' => [
            'Título y Cédula de nivel Licenciatura',
            'Certificado de estudios de Licenciatura',
            'Identificación oficial vigente',
            'CURP actualizada',
            'Acta de Nacimiento (Emisión 2025/2026)',
            'Nombramiento laboral vigente',
            'Comprobante de domicilio reciente',
            'Comprobante de CUIP (si aplica)',
            'Foto infantil color (JPG, 300 dpi)',
        ],
    ],

];
