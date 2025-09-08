<?php
// send_mail.php – BULLETPROOF EMAIL SYSTEM with multiple fallbacks
declare(strict_types=1);
session_start();
header('Content-Type: application/json; charset=UTF-8');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config.php';

// Debug optional via ?debug=1
define('DEBUG_MODE', isset($_GET['debug']) && $_GET['debug'] === '1');

// Multiple SMTP configurations for fallback
$smtp_configs = [
    'primary' => [
        'host' => SMTP_HOST,
        'port' => SMTP_PORT,
        'encryption' => SMTP_ENCRYPTION,
        'username' => SMTP_USERNAME,
        'password' => SMTP_PASSWORD,
        'name' => 'Primary (Office 365)'
    ],
    'gmail' => [
        'host' => 'smtp.gmail.com',
        'port' => 587,
        'encryption' => 'tls',
        'username' => 'your-gmail@gmail.com', // Replace with your Gmail
        'password' => 'your-gmail-app-password', // Replace with Gmail App Password
        'name' => 'Gmail Fallback'
    ],
    'sendgrid' => [
        'host' => 'smtp.sendgrid.net',
        'port' => 587,
        'encryption' => 'tls',
        'username' => 'apikey',
        'password' => 'your-sendgrid-api-key', // Replace with SendGrid API key
        'name' => 'SendGrid Fallback'
    ]
];

function json_fail(int $code, string $msg): void
{
  http_response_code($code);
  echo json_encode(['success' => false, 'message' => $msg], JSON_UNESCAPED_UNICODE);
  exit;
}
function json_ok(string $msg): void
{
  echo json_encode(['success' => true, 'message' => $msg], JSON_UNESCAPED_UNICODE);
  exit;
}
function has_crlf(string $s): bool
{
  return preg_match('/\r|\n/', $s) === 1;
}

// Method + Throttle
if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') json_fail(405, 'Ungültige Anfrage');
$now = time();
$last = (int)($_SESSION['last_submit_ts'] ?? 0);
if ($now - $last < 10) json_fail(429, 'Bitte kurz warten und erneut senden.');
$_SESSION['last_submit_ts'] = $now;

// Honeypot
if (trim((string)($_POST['website'] ?? '')) !== '') json_ok('Danke.');

// Input
$nameRaw    = (string)($_POST['name']    ?? '');
$emailRaw   = (string)($_POST['email']   ?? '');
$messageRaw = (string)($_POST['message'] ?? '');

if (has_crlf($nameRaw) || has_crlf($emailRaw)) json_fail(400, 'Ungültige Zeichen.');
$name    = trim(filter_var($nameRaw, FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES));
$email   = trim($emailRaw);
$message = trim($messageRaw);

if ($name === '' || $email === '' || $message === '') json_fail(400, 'Bitte alle Pflichtfelder korrekt ausfüllen.');
if (!filter_var($email, FILTER_VALIDATE_EMAIL))       json_fail(400, 'Bitte eine gültige E-Mail angeben.');
if (mb_strlen($name) > 200)     $name    = mb_substr($name, 0, 200);
if (mb_strlen($email) > 254)    $email   = mb_substr($email, 0, 254);
if (mb_strlen($message) > 5000) $message = mb_substr($message, 0, 5000);

// BULLETPROOF EMAIL SENDING with multiple fallbacks
$email_sent = false;
$last_error = '';

// Prepare email content
$subject = 'Kontaktformular – ' . $name;
$plain   = "Name: {$name}\nE-Mail: {$email}\n\nNachricht:\n{$message}\n";
$html    = '<p><strong>Name:</strong> ' . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . '</p>'
  . '<p><strong>E-Mail:</strong> ' . htmlspecialchars($email, ENT_QUOTES, 'UTF-8') . '</p>'
  . '<p><strong>Nachricht:</strong><br>' . nl2br(htmlspecialchars($message, ENT_QUOTES, 'UTF-8')) . '</p>';

// Try each SMTP configuration until one works
foreach ($smtp_configs as $config_name => $config) {
  // Skip if credentials are not set (placeholder values)
  if (strpos($config['username'], 'your-') === 0 || strpos($config['password'], 'your-') === 0) {
    continue;
  }
  
  try {
    $mail = new PHPMailer(true);
    $mail->CharSet  = 'UTF-8';
    $mail->Encoding = 'base64';
    $mail->setLanguage('de');

    $mail->isSMTP();
    $mail->Host       = $config['host'];
    $mail->SMTPAuth   = true;
    $mail->Username   = $config['username'];
    $mail->Password   = $config['password'];
    $mail->Port       = (int)$config['port'];
    $mail->SMTPSecure = $config['encryption'] === 'tls' ? PHPMailer::ENCRYPTION_STARTTLS : PHPMailer::ENCRYPTION_SMTPS;
    
    // Enhanced timeout settings
    $mail->Timeout = 30;
    $mail->SMTPKeepAlive = true;
    
    if (DEBUG_MODE) {
      $mail->SMTPDebug   = 2;
      $mail->Debugoutput = static function ($str, $level) use ($config_name) {
        error_log("SMTP[$config_name][$level] $str");
      };
    }

    $mail->setFrom(SMTP_FROM, SMTP_FROM_NAME);
    $mail->addAddress(SMTP_TO);
    $mail->addReplyTo($email, $name);

    $mail->Subject = $subject;
    $mail->isHTML(true);
    $mail->Body    = $html;
    $mail->AltBody = $plain;

    $mail->send();
    $email_sent = true;
    
    // Log successful send
    @file_put_contents(
      __DIR__ . '/mail_success.log',
      sprintf("[%s] SUCCESS via %s: %s -> %s\n", date('c'), $config['name'], $email, SMTP_TO),
      FILE_APPEND
    );
    
    break; // Exit loop on success
    
  } catch (Exception $e) {
    $last_error = $e->getMessage();
    
    // Log the error
    @file_put_contents(
      __DIR__ . '/mail_error.log',
      sprintf("[%s] FAILED via %s: %s | Error: %s\n", date('c'), $config['name'], $email, $e->getMessage()),
      FILE_APPEND
    );
    
    // Continue to next configuration
    continue;
  }
}

// If all SMTP methods failed, try PHP mail() as last resort
if (!$email_sent) {
  try {
    $headers = [
      'From: ' . SMTP_FROM_NAME . ' <' . SMTP_FROM . '>',
      'Reply-To: ' . $name . ' <' . $email . '>',
      'Content-Type: text/html; charset=UTF-8',
      'MIME-Version: 1.0'
    ];
    
    $email_sent = mail(SMTP_TO, $subject, $html, implode("\r\n", $headers));
    
    if ($email_sent) {
      @file_put_contents(
        __DIR__ . '/mail_success.log',
        sprintf("[%s] SUCCESS via PHP mail(): %s -> %s\n", date('c'), $email, SMTP_TO),
        FILE_APPEND
      );
    }
  } catch (Exception $e) {
    $last_error = $e->getMessage();
  }
}

// Final result
if ($email_sent) {
  json_ok('Ihre Nachricht wurde erfolgreich versendet!');
} else {
  $msg = 'Ihre Nachricht konnte nicht versendet werden! Kontaktieren Sie uns jetzt.';
  if (DEBUG_MODE) $msg .= ' (Debug: ' . $last_error . ')';
  json_fail(500, $msg);
}
