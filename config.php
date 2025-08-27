<?php
// --------------------------------------
// Autoload PHPMailer (Composer)
// --------------------------------------
require_once __DIR__ . '/vendor/autoload.php';

// --------------------------------------
// SMTP-Settings für PHPMailer
// --------------------------------------
// Trage hier deine SMTP-Daten ein (Mailserver, Zugang, Ports etc.)
// Diese Daten erhältst du bei deinem Hoster oder Mailprovider.
define('SMTP_HOST',       'DEIN-SMTP-HOST');
define('SMTP_PORT',       465); // oder 587 für TLS
define('SMTP_USERNAME',   'DEIN-EMAIL-USER');
define('SMTP_PASSWORD',   'DEIN-EMAIL-PASSWORT');
define('SMTP_ENCRYPTION', 'ssl'); // 'tls' oder 'ssl' je nach Provider
define('SMTP_FROM',       'absender@deinedomain.at'); // muss zu deiner Domain passen
define('SMTP_FROM_NAME',  'Name des Absenders / Kontaktformular');
define('SMTP_TO',         'empfaenger@deinedomain.at'); // Empfängeradresse (z.B. für Kontaktanfragen)

// --------------------------------------
// Google PageSpeed API-Key (nur falls genutzt)
// --------------------------------------
// Optional: Für eigene Tools, nicht für das Kontaktformular nötig
define('PSI_API_KEY',     'DEIN_GOOGLE_PAGESPEED_API_KEY');

// --------------------------------------
// Optional: Logo-Pfad für PDF-Generierung, falls benötigt
// --------------------------------------
define('LOGO_PATH',       __DIR__ . '/assets/logo/logo.svg');

// --------------------------------------
// Optional: reCAPTCHA Secret (falls irgendwann benötigt, aktuell NICHT AKTIV!)
// --------------------------------------
// define('RECAPTCHA_SECRET_KEY', 'DEIN_RECAPTCHA_SECRET_KEY');
