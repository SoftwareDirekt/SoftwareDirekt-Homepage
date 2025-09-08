<?php

declare(strict_types=1);

/**
 * BULLETPROOF EMAIL CONFIGURATION (Office 365)
 * WICHTIG: Kein BOM, kein schließendes ?>, keinerlei Output.
 */

// PRIMARY SMTP-Settings (Office 365)
define('SMTP_HOST',       'smtp.office365.com');
define('SMTP_PORT',       587);                 // STARTTLS
define('SMTP_ENCRYPTION', 'tls');
define('SMTP_USERNAME',   'office@softwaredirekt.at');
define('SMTP_PASSWORD',   'scjnbtzjqpfnplkl');  // App-Passwort (16-stellig)

// Absender/Empfänger
define('SMTP_FROM',       'office@softwaredirekt.at');   // = Auth-Postfach!
define('SMTP_FROM_NAME',  'SoftwareDirektOG Anfrage');
define('SMTP_TO',         'office@softwaredirekt.at');

// Timeouts (shorter = snappier UX; Office 365 is usually <5s)
define('SMTP_TIMEOUT',     10);
define('SMTP_KEEPALIVE',   false);

// Optional: TLS-Verify toggeln (standard: true). Nur bei Dev-Problemen auf false.
define('SMTP_TLS_VERIFY',  true);

// Network tweaks
define('SMTP_FORCE_IPV4',  true); // Avoid IPv6 DNS/route delays

// Support-Infos für Fehlermeldungen (Frontend-Text)
define('SUPPORT_EMAIL',    'office@softwaredirekt.at');
define('SUPPORT_TEL',      '+43 660 6448088');
