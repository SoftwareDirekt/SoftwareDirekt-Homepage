<?php

/**
 * send_mail.php — Stabil, produktionsreif, Office 365 via PHPMailer (PHP ≥5.6)
 * Ziele:
 *  - Immer valides JSON (Success/Fehler) ohne HTML-Noise
 *  - Kein CORS-Geraffel nötig (Same-Origin), aber OPTIONS wird sofort beantwortet
 *  - Robuste Validierung, Logging mit Fehler-ID, klare Support-Nachricht
 *
 * Voraussetzungen:
 *   composer require phpmailer/phpmailer
 *   config.php mit SMTP_* und optional SUPPORT_* Konstanten
 */

ini_set('display_errors', '0');
ini_set('log_errors', '1');
@set_time_limit(15);
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

/* -------------------- Response Header -------------------- */
header('Content-Type: application/json; charset=UTF-8');
header('X-Content-Type-Options: nosniff');
header('Cache-Control: no-store, no-cache, must-revalidate');

/* -------------------- Schnelle Antworten -------------------- */
/* Preflight/Fehlklicks nicht hängen lassen: sofort 204 liefern */
$method = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : '';
if ($method === 'OPTIONS') {
  http_response_code(204);
  exit;
}

/* Optional: harte Same-Origin-Policy (keine „API“-Nutzung über Fremd-Origins) */
if (!empty($_SERVER['HTTP_ORIGIN'])) {
  $originHost = parse_url($_SERVER['HTTP_ORIGIN'], PHP_URL_HOST);
  $thisHost   = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '';
  if (!hash_equals($thisHost, $originHost)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Ungültige Herkunft.'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
  }
}

/* -------------------- Helpers -------------------- */
if (!defined('JSON_FLAGS')) {
  define('JSON_FLAGS', JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
}
function make_error_id()
{
  if (function_exists('random_int')) {
    return date('YmdHis') . '-' . sprintf('%04x', random_int(0, 0xffff));
  }
  return date('YmdHis') . '-' . sprintf('%04x', mt_rand(0, 0xffff));
}
function json_fail($code, $msg, $errorId = null)
{
  while (ob_get_level()) {
    ob_end_clean();
  }
  http_response_code($code);
  $out = array('success' => false, 'message' => $msg);
  if ($errorId) {
    $out['error_id'] = $errorId;
  }
  echo json_encode($out, JSON_FLAGS);
  exit;
}
function json_ok($msg)
{
  while (ob_get_level()) {
    ob_end_clean();
  }
  echo json_encode(array('success' => true, 'message' => $msg), JSON_FLAGS);
  exit;
}
function has_crlf($s)
{
  return (bool)preg_match('/\r|\n/', $s);
}

/* -------------------- Request Guards -------------------- */
if ($method !== 'POST') {
  json_fail(405, 'Ungültige Anfrage');
}

/* Rate Limit pro Session */
$now  = time();
$last = isset($_SESSION['last_submit_ts']) ? (int)$_SESSION['last_submit_ts'] : 0;
if ($now - $last < 10) {
  json_fail(429, 'Bitte kurz warten und erneut senden.');
}
$_SESSION['last_submit_ts'] = $now;

/* Honeypot */
if (isset($_POST['website']) && trim((string)$_POST['website']) !== '') {
  json_ok('Vielen Dank!');
}

/* -------------------- Autoload / Config -------------------- */
$autoload = __DIR__ . '/vendor/autoload.php';
if (!is_file($autoload)) {
  $id = make_error_id();
  @file_put_contents(__DIR__ . '/mail_error.log', sprintf("[%s] %s | Autoload fehlt: %s\n", date('c'), $id, $autoload), FILE_APPEND);
  json_fail(500, "Technischer Fehler. Bitte wenden Sie sich telefonisch an unseren Kundenservice oder per E-Mail an uns. (Fehler-ID: {$id})", $id);
}
require_once $autoload;

$configFile = __DIR__ . '/config.php';
if (!is_file($configFile)) {
  $id = make_error_id();
  @file_put_contents(__DIR__ . '/mail_error.log', sprintf("[%s] %s | config.php fehlt\n", date('c'), $id), FILE_APPEND);
  json_fail(500, "Technischer Fehler. Bitte kontaktieren Sie uns telefonisch oder per E-Mail. (Fehler-ID: {$id})", $id);
}
require_once $configFile;

/* -------------------- Environment Checks -------------------- */
if (!extension_loaded('openssl')) {
  $id = make_error_id();
  @file_put_contents(__DIR__ . '/mail_error.log', sprintf("[%s] %s | OpenSSL-Extension fehlt\n", date('c'), $id), FILE_APPEND);
  json_fail(500, "Der Versand ist derzeit nicht möglich. Bitte kontaktieren Sie uns telefonisch oder per E-Mail. (Fehler-ID: {$id})", $id);
}
$must = array('SMTP_HOST', 'SMTP_USERNAME', 'SMTP_PASSWORD', 'SMTP_FROM', 'SMTP_TO');
foreach ($must as $k) {
  if (!defined($k)) {
    $id = make_error_id();
    @file_put_contents(__DIR__ . '/mail_error.log', sprintf("[%s] %s | SMTP-Konstante fehlt: %s\n", date('c'), $id, $k), FILE_APPEND);
    json_fail(500, "Konfigurationsfehler. Bitte kontaktieren Sie uns telefonisch oder per E-Mail. (Fehler-ID: {$id})", $id);
  }
}

/* -------------------- Input -------------------- */
$nameRaw    = isset($_POST['name'])    ? (string)$_POST['name']    : '';
$emailRaw   = isset($_POST['email'])   ? (string)$_POST['email']   : '';
$messageRaw = isset($_POST['message']) ? (string)$_POST['message'] : '';

if (has_crlf($nameRaw) || has_crlf($emailRaw)) {
  json_fail(400, 'Ungültige Zeichen.');
}
$name    = trim(filter_var($nameRaw, FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES));
$email   = trim($emailRaw);
$message = trim($messageRaw);

if ($name === '' || $email === '' || $message === '') {
  json_fail(400, 'Bitte alle Pflichtfelder korrekt ausfüllen.');
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  json_fail(400, 'Bitte eine gültige E-Mail angeben.');
}
if (mb_strlen($name) > 200) {
  $name    = mb_substr($name, 0, 200);
}
if (mb_strlen($email) > 254) {
  $email   = mb_substr($email, 0, 254);
}
if (mb_strlen($message) > 5000) {
  $message = mb_substr($message, 0, 5000);
}

/* -------------------- Mail-Inhalt -------------------- */
$subject  = 'Kontaktformular – ' . $name;
$remoteIp = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'n/a';
$plain = "Name: {$name}\nE-Mail: {$email}\n\nNachricht:\n{$message}\nIP: {$remoteIp}";
$html  = '<p><strong>Name:</strong> ' . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . '</p>'
  . '<p><strong>E-Mail:</strong> ' . htmlspecialchars($email, ENT_QUOTES, 'UTF-8') . '</p>'
  . '<p><strong>Nachricht:</strong><br>' . nl2br(htmlspecialchars($message, ENT_QUOTES, 'UTF-8')) . '</p>'
  . '<p><small>IP: ' . htmlspecialchars((string)$remoteIp, ENT_QUOTES, 'UTF-8') . '</small></p>';

/* -------------------- Versand via PHPMailer (Office 365) -------------------- */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$emailSent = false;
$errorId   = null;
$lastError = '';
// timing info
$sendMethod = '';
$sendMs     = 0;

try {
  $mail = new PHPMailer(true);
  $mail->CharSet    = 'UTF-8';
  $mail->Encoding   = 'base64';
  // $mail->setLanguage('de'); // optional

  $mail->isSMTP();
  // Prefer IPv4 to avoid potential IPv6 route delays
  if (defined('SMTP_FORCE_IPV4') && SMTP_FORCE_IPV4) {
    $mail->Host = gethostbyname(SMTP_HOST);
  } else {
    $mail->Host = SMTP_HOST;
  }
  $mail->SMTPAuth    = true;
  $mail->Username    = SMTP_USERNAME;
  $mail->Password    = SMTP_PASSWORD;
  $mail->Port        = defined('SMTP_PORT') ? (int)SMTP_PORT : 587;
  $enc               = defined('SMTP_ENCRYPTION') ? SMTP_ENCRYPTION : 'tls';
  $mail->SMTPSecure  = ($enc === 'tls') ? PHPMailer::ENCRYPTION_STARTTLS : PHPMailer::ENCRYPTION_SMTPS;
  $mail->SMTPAutoTLS = true;

  if (defined('SMTP_TIMEOUT')) {
    $mail->Timeout   = (int)SMTP_TIMEOUT;
    if (property_exists($mail, 'Timelimit')) {
      $mail->Timelimit = (int)SMTP_TIMEOUT + 5;
    }
  }
  if (defined('SMTP_KEEPALIVE')) {
    $mail->SMTPKeepAlive = (bool)SMTP_KEEPALIVE;
  }

  if (defined('SMTP_TLS_VERIFY') && SMTP_TLS_VERIFY === false) {
    $mail->SMTPOptions = array(
      'ssl' => array(
        'verify_peer'       => false,
        'verify_peer_name'  => false,
        'allow_self_signed' => true,
      )
    );
  }

  // From MUSS dem authentifizierten Postfach entsprechen (M365)
  $fromName = defined('SMTP_FROM_NAME') ? SMTP_FROM_NAME : 'Kontaktformular';
  $mail->setFrom(SMTP_FROM, $fromName);
  $mail->addAddress(SMTP_TO);
  $mail->addReplyTo($email, $name);

  $mail->Subject = $subject;
  $mail->isHTML(true);
  $mail->Body    = $html;
  $mail->AltBody = $plain;

  $t0 = microtime(true);
  $mail->send();
  $emailSent = true;
  $sendMethod = 'SMTP';
  $sendMs = (int)round((microtime(true) - $t0) * 1000);
} catch (Exception $ex) {
  $lastError = $ex->getMessage();
  $errorId   = make_error_id();
  @file_put_contents(
    __DIR__ . '/mail_error.log',
    sprintf("[%s] %s | SMTP ERROR: %s\n", date('c'), $errorId, $lastError),
    FILE_APPEND
  );
}

/* -------------------- Letzter Fallback: mail() -------------------- */
if (!$emailSent) {
  try {
    $t1 = microtime(true);
    $headers = array(
      'From: ' . (defined('SMTP_FROM_NAME') ? SMTP_FROM_NAME : 'Kontaktformular') . ' <' . SMTP_FROM . '>',
      'Reply-To: ' . $name . ' <' . $email . '>',
      'MIME-Version: 1.0',
      'Content-Type: text/html; charset=UTF-8',
    );
    $emailSent = @mail(
      SMTP_TO,
      '=?UTF-8?B?' . base64_encode($subject) . '?=',
      $html,
      implode("\r\n", $headers)
    );
    if ($emailSent) {
      $sendMethod = 'mail()';
      $sendMs = (int)round((microtime(true) - $t1) * 1000);
    }
    if (!$emailSent && !$errorId) {
      $errorId = make_error_id();
      @file_put_contents(__DIR__ . '/mail_error.log', sprintf("[%s] %s | mail() failed\n", date('c'), $errorId), FILE_APPEND);
    }
  } catch (Exception $t) {
    if (!$errorId) {
      $errorId = make_error_id();
    }
    @file_put_contents(__DIR__ . '/mail_error.log', sprintf("[%s] %s | mail() Throwable: %s\n", date('c'), $errorId, $t->getMessage()), FILE_APPEND);
  }
}

/* -------------------- Logging & Antwort -------------------- */
if ($emailSent) {
  @file_put_contents(
    __DIR__ . '/mail_success.log',
    sprintf("[%s] SUCCESS via %s in %dms: %s -> %s\n", date('c'), ($sendMethod ?: 'unknown'), (int)$sendMs, $email, SMTP_TO),
    FILE_APPEND
  );
  if ($sendMethod) {
    @header('X-Mail-Method: ' . $sendMethod);
  }
  if ($sendMs) {
    @header('X-Mail-Duration: ' . (int)$sendMs . 'ms');
  }
  json_ok('Vielen Dank! Ihre Nachricht wurde übermittelt.');
}

$supportTel  = defined('SUPPORT_TEL') ? SUPPORT_TEL : 'unseren Kundenservice';
$supportMail = defined('SUPPORT_EMAIL') ? SUPPORT_EMAIL : 'office@softwaredirekt.at';
$msg = "Ihre Nachricht konnte nicht versendet werden. Bitte wenden Sie sich telefonisch an {$supportTel} oder schreiben Sie an {$supportMail}.";
if ($errorId) {
  $msg .= " (Fehler-ID: {$errorId})";
}
json_fail(500, $msg, $errorId);
