<?php
// Alternative Gmail configuration for testing
require_once __DIR__ . '/vendor/autoload.php';
declare(strict_types=1);

// Gmail SMTP Settings (for testing)
define('SMTP_HOST',       'smtp.gmail.com');
define('SMTP_PORT',       587);
define('SMTP_ENCRYPTION', 'tls');
define('SMTP_USERNAME',   'your-gmail@gmail.com');
define('SMTP_PASSWORD',   'your-app-password'); // Gmail App Password

define('SMTP_FROM',       'your-gmail@gmail.com');
define('SMTP_FROM_NAME',  'SoftwareDirektOG Anfrage');
define('SMTP_TO',         'office@softwaredirekt.at');

define('LOGO_PATH',       __DIR__ . '/assets/logo/logo.svg');
?>
