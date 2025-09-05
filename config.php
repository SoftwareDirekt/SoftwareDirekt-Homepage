<?php
// --------------------------------------
// BULLETPROOF EMAIL CONFIGURATION
// --------------------------------------
require_once __DIR__ . '/vendor/autoload.php';

declare(strict_types=1);

// --------------------------------------
// PRIMARY SMTP-Settings (Office 365)
// --------------------------------------
define('SMTP_HOST',       'smtp.office365.com');
define('SMTP_PORT',       587);                 // Pflicht bei M365
define('SMTP_ENCRYPTION', 'tls');               // STARTTLS
define('SMTP_USERNAME',   'office@softwaredirekt.at');
define('SMTP_PASSWORD',   'scjnbtzjqpfnplkl'); // App Password (16 chars = correct)

// Email addresses
define('SMTP_FROM',       'office@softwaredirekt.at');
define('SMTP_FROM_NAME',  'SoftwareDirektOG Anfrage');
define('SMTP_TO',         'office@softwaredirekt.at');

// Enhanced settings for reliability
define('SMTP_TIMEOUT',    30);                  // 30 seconds timeout
define('SMTP_KEEPALIVE',  true);               // Keep connection alive
define('SMTP_VERIFY_PEER', false);             // Skip SSL verification if needed
// --------------------------------------
// Google PageSpeed API-Key (nur falls genutzt)
// --------------------------------------
// Optional: Für eigene Tools, nicht für das Kontaktformular nötig
// define('PSI_API_KEY',     'DEIN_GOOGLE_PAGESPEED_API_KEY');

// --------------------------------------
// Optional: Logo-Pfad für PDF-Generierung, falls benötigt
// --------------------------------------
define('LOGO_PATH',       __DIR__ . '/assets/logo/logo.svg');

// --------------------------------------
// Optional: reCAPTCHA Secret (falls irgendwann benötigt, aktuell NICHT AKTIV!)
// --------------------------------------
// define('RECAPTCHA_SECRET_KEY', 'DEIN_RECAPTCHA_SECRET_KEY');
