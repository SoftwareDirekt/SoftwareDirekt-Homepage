<?php
// send_mail.php – robust, M365-konform, JSON-only
declare(strict_types=1);
session_start();
header('Content-Type: application/json; charset=UTF-8');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config.php'; // definiert SMTP_* Konstanten

// ---------- Helper ----------
function json_fail(int $code, string $msg): void
{
  http_response_code($code);
  echo json_encode(['success' => false, 'message' => $msg], JSON_UNESCAPED_UNICODE);
  exit;
}
function json_ok(string $msg = 'OK'): void
{
  echo json_encode(['success' => true, 'message' => $msg], JSON_UNESCAPED_UNICODE);
  exit;
}
function has_crlf(string $s): bool
{
  return preg_match('/\r|\n/', $s) === 1;
}

// ---------- Method & simple rate limit ----------
if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
  json_fail(405, 'Ungültige Anfrage');
}
$now = time();
$last = (int)($_SESSION['last_submit_ts'] ?? 0);
if ($now - $last < 10) { // 10s Throttle
  json_fail(429, 'Bitte kurz warten und erneut senden.');
}
$_SESSION['last_submit_ts'] = $now;

// ---------- Honeypot ----------
$hp = trim((string)($_POST['website'] ?? '')); // verstecktes Feld im Formular
if ($hp !== '') {
  // still succeed to bots
  json_ok('Danke.');
}

// ---------- Input ----------
$nameRaw    = (string)($_POST['name']    ?? '');
$emailRaw   = (string)($_POST['email']   ?? '');
$messageRaw = (string)($_POST['message'] ?? '');

// Header-Injection verhindern
if (has_crlf($nameRaw) || has_crlf($emailRaw)) {
  json_fail(400, 'Ungültige Zeichen in Feldern.');
}

$name    = trim(filter_var($nameRaw, FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES));
$email   = trim($emailRaw);
$message = trim($messageRaw);

// Pflichtfelder & Plausibilität
if ($name === '' || $email === '' || $message === '') {
  json_fail(400, 'Bitte alle Pflichtfelder korrekt ausfüllen.');
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  json_fail(400, 'Bitte eine gültige E-Mail angeben.');
}
// Länge begrenzen (Missbrauch vermeiden)
if (mb_strlen($name) > 200)    $name    = mb_substr($name, 0, 200);
if (mb_strlen($email) > 254)   $email   = mb_substr($email, 0, 254);
if (mb_strlen($message) > 5000) $message = mb_substr($message, 0, 5000);

// ---------- Mail ----------
try {
  $mail = new PHPMailer(true);
  $mail->CharSet    = 'UTF-8';
  $mail->Encoding   = 'base64';
  $mail->setLanguage('de');

  // SMTP
  $mail->isSMTP();
  $mail->Host       = SMTP_HOST;          // z.B. smtp.office365.com
  $mail->SMTPAuth   = true;
  $mail->Username   = SMTP_USERNAME;      // z.B. office@softwaredirekt.at
  $mail->Password   = SMTP_PASSWORD;      // App-Passwort bei M365
  // Microsoft 365 verlangt STARTTLS auf 587
  if ((int)SMTP_PORT === 587) {
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
  } elseif ((int)SMTP_PORT === 465) {
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
  } else {
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Default sicher
  }
  $mail->Port = (int)SMTP_PORT;

  // Absender/Empfänger
  $mail->setFrom(SMTP_FROM, SMTP_FROM_NAME);
  $mail->addAddress(SMTP_TO);
  $mail->addReplyTo($email, $name);
  // Optional bessere Bounces:
  // $mail->Sender = SMTP_FROM; // Return-Path (muss zur Domain passen)

  // DKIM (optional; nur aktivieren, wenn Schlüssel vorhanden)
  // $mail->DKIM_domain = 'deinedomain.tld';
  // $mail->DKIM_selector = 'default';
  // $mail->DKIM_private = __DIR__ . '/dkim-private.key';
  // $mail->DKIM_identity = SMTP_FROM;

  // Inhalt (Text + HTML)
  $subject = 'Kontaktformular – ' . $name;
  $plain   = "Name: {$name}\nE-Mail: {$email}\n\nNachricht:\n{$message}\n";
  $html    = '<p><strong>Name:</strong> ' . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . '</p>'
    . '<p><strong>E-Mail:</strong> ' . htmlspecialchars($email, ENT_QUOTES, 'UTF-8') . '</p>'
    . '<p><strong>Nachricht:</strong><br>' . nl2br(htmlspecialchars($message, ENT_QUOTES, 'UTF-8')) . '</p>';

  $mail->Subject = $subject;
  $mail->isHTML(true);
  $mail->Body    = $html;
  $mail->AltBody = $plain;

  $mail->send();

  json_ok('Ihre Nachricht wurde erfolgreich versendet!');
} catch (Exception $e) {
  // detailliertes Logging lokal
  @file_put_contents(
    __DIR__ . '/mail_error.log',
    sprintf("[%s] PHPMailer: %s | ErrorInfo: %s\n", date('c'), $e->getMessage(), isset($mail) ? $mail->ErrorInfo : '-'),
    FILE_APPEND
  );
  json_fail(500, 'Ihre Nachricht konnte nicht versendet werden! Kontaktieren Sie uns jetzt.');
}
