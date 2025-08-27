<?php
session_start();
header('Content-Type: application/json; charset=UTF-8');

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$response = ['success' => false];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  $response['message'] = 'Ungültige Anfrage';
  echo json_encode($response);
  exit;
}

// Eingabewerte holen und bereinigen
$name    = trim(htmlspecialchars($_POST['name'] ?? '', ENT_QUOTES, 'UTF-8'));
$email   = trim($_POST['email'] ?? '');
$message = trim(htmlspecialchars($_POST['message'] ?? '', ENT_QUOTES, 'UTF-8'));

// Pflichtfelder prüfen
if (!$name || !$email || !$message || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $response['message'] = 'Bitte alle Pflichtfelder korrekt ausfüllen.';
  echo json_encode($response);
  exit;
}

// PHPMailer versand
try {
  $mail = new PHPMailer(true);
  $mail->isSMTP();
  $mail->Host       = SMTP_HOST;
  $mail->SMTPAuth   = true;
  $mail->Username   = SMTP_USERNAME;
  $mail->Password   = SMTP_PASSWORD;
  $mail->SMTPSecure = SMTP_ENCRYPTION;
  $mail->Port       = SMTP_PORT;

  $mail->setFrom(SMTP_FROM, SMTP_FROM_NAME);
  $mail->addAddress(SMTP_TO);
  $mail->isHTML(true);

  $mail->Subject = "Neue Kontaktanfrage von $name";
  $mail->Body    = "
        <p><strong>Name:</strong> $name</p>
        <p><strong>E-Mail:</strong> $email</p>
        <p><strong>Nachricht:</strong><br>" . nl2br($message) . "</p>
    ";
  $mail->addReplyTo($email, $name);

  $mail->send();
  $response['success'] = true;
  $response['message'] = 'Ihre Nachricht wurde erfolgreich versendet!';
} catch (Exception $e) {
  file_put_contents(__DIR__ . '/mail_error.log', date('c') . ' – ' . $e->getMessage() . "\n", FILE_APPEND);
  $response['message'] = 'Ihre Nachricht konnte nicht versendet werden! Kontaktieren Sie uns jetzt.';
}

echo json_encode($response);
exit;
