<?php
define('IN_APP', true);
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/auth.php';

$id = preg_replace('/[^a-z0-9]/', '', strtolower($_GET['id'] ?? ''));

if (!isset($PROGRAMS[$id])) {
    header('Location: ' . siteUrl());
    exit;
}

$p = $PROGRAMS[$id];
$ok  = $_GET['ok']  ?? '';
$err = $_GET['err'] ?? '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pre-Registro · <?= h($p['nombre']) ?> · UCIPS</title>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= siteUrl('assets/css/site.css') ?>">
<style>
/* ── Formulario glassmorphism ── */
.form-section {
    padding: 60px 0 100px;
}

.form-header {
    text-align: center;
    margin-bottom: 50px;
}

.form-header h2 {
    font-size: 2.4rem;
    font-weight: 900;
    color: var(--gold);
    text-transform: uppercase;
    letter-spacing: 3px;
    margin-bottom: 12px;
}

.form-header p {
    color: #d8d8d8;
    font-size: 1rem;
    letter-spacing: 1px;
}

.glass-form {
    background: rgba(255,255,255,.05);
    border: 1px solid rgba(255,255,255,.10);
    border-radius: 32px;
    backdrop-filter: blur(20px);
    padding: 50px;
    box-shadow: 0 20px 60px rgba(0,0,0,.35);
}

.form-block {
    margin-bottom: 40px;
}

.form-block-title {
    font-size: .75rem;
    font-weight: 800;
    color: var(--gold);
    text-transform: uppercase;
    letter-spacing: 3px;
    margin-bottom: 22px;
    padding-bottom: 12px;
    border-bottom: 1px solid rgba(212,175,55,.25);
    display: flex;
    align-items: center;
    gap: 10px;
}

.form-block-title::before {
    content: '';
    width: 4px;
    height: 20px;
    background: linear-gradient(var(--gold), var(--gold-light));
    border-radius: 4px;
    flex-shrink: 0;
}

.form-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 18px;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.form-group.full {
    grid-column: 1 / -1;
}

.form-group label {
    font-size: .78rem;
    font-weight: 700;
    color: rgba(255,255,255,.75);
    text-transform: uppercase;
    letter-spacing: 1.5px;
}

.form-group label .req {
    color: #f7a;
}

.form-group input,
.form-group select,
.form-group textarea {
    background: rgba(255,255,255,.07);
    border: 1px solid rgba(255,255,255,.15);
    border-radius: 12px;
    color: white;
    padding: 14px 18px;
    font-size: .95rem;
    font-family: 'Montserrat', sans-serif;
    transition: .3s;
    -webkit-appearance: none;
}

.form-group input::placeholder,
.form-group textarea::placeholder {
    color: rgba(255,255,255,.35);
}

.form-group select option {
    background: #07111d;
    color: white;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none;
    border-color: rgba(212,175,55,.6);
    background: rgba(255,255,255,.10);
    box-shadow: 0 0 0 3px rgba(212,175,55,.12);
}

.form-group textarea {
    min-height: 110px;
    resize: vertical;
}

.btn-submit {
    display: block;
    width: 100%;
    margin-top: 32px;
    padding: 20px;
    border-radius: 60px;
    background: linear-gradient(45deg, var(--gold), var(--gold-light));
    color: #000;
    font-size: 1rem;
    font-weight: 900;
    letter-spacing: 3px;
    text-transform: uppercase;
    border: none;
    cursor: pointer;
    font-family: 'Montserrat', sans-serif;
    transition: .4s;
}

.btn-submit:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 40px rgba(212,175,55,.4);
}

.msg-ok {
    background: rgba(39,174,96,.12);
    border: 1px solid rgba(39,174,96,.35);
    border-radius: 16px;
    padding: 20px 28px;
    color: #7effa0;
    font-size: .95rem;
    margin-bottom: 28px;
    font-weight: 600;
    letter-spacing: .5px;
}

.msg-err {
    background: rgba(231,76,60,.12);
    border: 1px solid rgba(231,76,60,.35);
    border-radius: 16px;
    padding: 20px 28px;
    color: #ffa7a0;
    font-size: .95rem;
    margin-bottom: 28px;
    font-weight: 600;
    letter-spacing: .5px;
}

@media(max-width:768px) {
    .glass-form { padding: 28px 20px; }
    .form-header h2 { font-size: 1.6rem; }
}
</style>
</head>
<body>

<div class="container">

<!-- NAV -->
<div class="top-nav">
    <a href="<?= siteUrl('programa.php?id=' . $p['id']) ?>" class="top-nav-link">← Volver al programa</a>
    <div class="top-nav-links">
        <a href="<?= siteUrl() ?>" class="top-nav-link">Todos los programas</a>
    </div>
</div>

<!-- HERO -->
<header style="min-height:40vh; margin-bottom:0; border-radius:40px 40px 0 0;">
    <div class="hero-content">
        <img src="https://yacdergaming.com/preregistro/imagenes/logo.png"
             class="logo-small" alt="UCIPS">
        <div class="hero-badge"><?= h($p['tipo']) ?> · UCIPS Puebla</div>
        <h1 style="font-size:3rem;">PRE-REGISTRO</h1>
        <p class="subtitle"><?= h($p['nombre']) ?></p>
    </div>
</header>

<!-- FORMULARIO -->
<div class="form-section">
    <div class="form-header">
        <h2>Completa tu Solicitud</h2>
        <p>Todos los campos marcados con <span style="color:#f7a">*</span> son obligatorios</p>
    </div>

    <?php if ($ok): ?>
    <div class="msg-ok">
        ✅ &nbsp;¡Tu preregistro fue enviado exitosamente! En breve nos pondremos en contacto contigo.
    </div>
    <?php endif; ?>

    <?php if ($err): ?>
    <div class="msg-err">
        ⚠️ &nbsp;<?= h(urldecode($err)) ?>
    </div>
    <?php endif; ?>

    <form class="glass-form" method="POST" action="<?= siteUrl('procesar.php') ?>">
        <input type="hidden" name="programa" value="<?= h($id) ?>">
        <input type="hidden" name="csrf" value="<?= h(csrfToken()) ?>">

        <!-- Datos personales -->
        <div class="form-block">
            <div class="form-block-title">Datos Personales</div>
            <div class="form-grid">
                <div class="form-group">
                    <label>Nombre(s) <span class="req">*</span></label>
                    <input type="text" name="nombre" required placeholder="Ej. Juan Carlos" maxlength="80">
                </div>
                <div class="form-group">
                    <label>Apellido Paterno <span class="req">*</span></label>
                    <input type="text" name="apellido_paterno" required placeholder="Ej. García" maxlength="60">
                </div>
                <div class="form-group">
                    <label>Apellido Materno <span class="req">*</span></label>
                    <input type="text" name="apellido_materno" required placeholder="Ej. López" maxlength="60">
                </div>
                <div class="form-group">
                    <label>CURP <span class="req">*</span></label>
                    <input type="text" name="curp" required placeholder="18 caracteres" maxlength="18"
                           style="text-transform:uppercase" oninput="this.value=this.value.toUpperCase()">
                </div>
                <div class="form-group">
                    <label>Fecha de Nacimiento <span class="req">*</span></label>
                    <input type="date" name="fecha_nacimiento" required>
                </div>
                <div class="form-group">
                    <label>Género <span class="req">*</span></label>
                    <select name="genero" required>
                        <option value="">Selecciona…</option>
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
                        <option value="Prefiero no decir">Prefiero no decir</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Contacto -->
        <div class="form-block">
            <div class="form-block-title">Información de Contacto</div>
            <div class="form-grid">
                <div class="form-group">
                    <label>Correo Electrónico <span class="req">*</span></label>
                    <input type="email" name="email" required placeholder="correo@ejemplo.com" maxlength="120">
                </div>
                <div class="form-group">
                    <label>Teléfono / Celular <span class="req">*</span></label>
                    <input type="tel" name="telefono" required placeholder="10 dígitos" maxlength="15">
                </div>
                <div class="form-group">
                    <label>Municipio de Residencia <span class="req">*</span></label>
                    <input type="text" name="municipio" required placeholder="Ej. Amozoc" maxlength="80">
                </div>
                <div class="form-group">
                    <label>Estado <span class="req">*</span></label>
                    <select name="estado" required>
                        <option value="">Selecciona…</option>
                        <option value="Puebla" selected>Puebla</option>
                        <option value="Tlaxcala">Tlaxcala</option>
                        <option value="Hidalgo">Hidalgo</option>
                        <option value="Morelos">Morelos</option>
                        <option value="Veracruz">Veracruz</option>
                        <option value="Oaxaca">Oaxaca</option>
                        <option value="CDMX">Ciudad de México</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Datos laborales -->
        <div class="form-block">
            <div class="form-block-title">Datos Académicos y Laborales</div>
            <div class="form-grid">
                <div class="form-group">
                    <label>Grado Máximo de Estudios <span class="req">*</span></label>
                    <select name="grado_estudios" required>
                        <option value="">Selecciona…</option>
                        <option value="Preparatoria">Preparatoria / Bachillerato</option>
                        <option value="TSU">Técnico Superior Universitario</option>
                        <option value="Licenciatura">Licenciatura</option>
                        <option value="Maestría">Maestría</option>
                        <option value="Doctorado">Doctorado</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Ocupación / Cargo Actual <span class="req">*</span></label>
                    <input type="text" name="ocupacion" required placeholder="Ej. Oficial de Policía" maxlength="100">
                </div>
                <div class="form-group full">
                    <label>Institución / Corporación donde labora <span class="req">*</span></label>
                    <input type="text" name="institucion" required placeholder="Ej. Secretaría de Seguridad Pública de Puebla" maxlength="150">
                </div>
                <div class="form-group full">
                    <label>¿Cómo te enteraste del programa?</label>
                    <select name="como_enteraste">
                        <option value="">Selecciona…</option>
                        <option value="Redes sociales">Redes sociales</option>
                        <option value="Compañero de trabajo">Compañero de trabajo</option>
                        <option value="Jefe superior">Jefe superior</option>
                        <option value="Página web UCIPS">Página web UCIPS</option>
                        <option value="Volante / Cartel">Volante / Cartel</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>
                <div class="form-group full">
                    <label>Comentarios adicionales</label>
                    <textarea name="comentarios" placeholder="Escribe aquí cualquier información adicional relevante…" maxlength="600"></textarea>
                </div>
            </div>
        </div>

        <!-- Aviso -->
        <div style="
        background:rgba(212,175,55,.06);
        border:1px solid rgba(212,175,55,.18);
        border-radius:16px;
        padding:18px 22px;
        font-size:.83rem;
        color:rgba(255,255,255,.6);
        line-height:1.7;
        margin-bottom:8px;">
            Al enviar este formulario autorizas a la UCIPS a contactarte con información
            sobre el programa seleccionado. Tus datos son tratados con confidencialidad
            conforme a la Ley Federal de Protección de Datos Personales.
        </div>

        <button type="submit" class="btn-submit">
            ENVIAR PRE-REGISTRO
        </button>
    </form>
</div>

</div><!-- /container -->

<footer>
    <div class="container">
        <div class="footer-bottom">
            <p><?= SITE_COPYRIGHT ?> · Universidad de las Ciencias Policiales y de la Seguridad del Estado de Puebla</p>
            <p><a href="mailto:<?= SITE_EMAIL ?>"><?= SITE_EMAIL ?></a></p>
        </div>
    </div>
</footer>

<script src="<?= siteUrl('assets/js/main.js') ?>"></script>
</body>
</html>
