<?php
// Simple email test - minimal code to identify the issue
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Simple Email Test</h1>";

try {
    // Load configuration
    require_once __DIR__ . '/config.php';
    require_once __DIR__ . '/vendor/autoload.php';
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    echo "<p>✅ Configuration loaded successfully</p>";
    
    // Create PHPMailer instance
    $mail = new PHPMailer(true);
    
    // Enable debugging
    $mail->SMTPDebug = 2;
    $mail->Debugoutput = function($str, $level) {
        echo "<p><strong>SMTP Debug [$level]:</strong> " . htmlspecialchars($str) . "</p>";
    };
    
    // Basic configuration
    $mail->isSMTP();
    $mail->Host = SMTP_HOST;
    $mail->SMTPAuth = true;
    $mail->Username = SMTP_USERNAME;
    $mail->Password = SMTP_PASSWORD;
    $mail->Port = SMTP_PORT;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    
    echo "<p>✅ SMTP configuration set</p>";
    echo "<p><strong>Host:</strong> " . SMTP_HOST . "</p>";
    echo "<p><strong>Port:</strong> " . SMTP_PORT . "</p>";
    echo "<p><strong>Username:</strong> " . SMTP_USERNAME . "</p>";
    echo "<p><strong>Password length:</strong> " . strlen(SMTP_PASSWORD) . " characters</p>";
    
    // Set email details
    $mail->setFrom(SMTP_FROM, SMTP_FROM_NAME);
    $mail->addAddress(SMTP_TO);
    $mail->Subject = 'Test Email - ' . date('Y-m-d H:i:s');
    $mail->Body = 'This is a test email from your contact form system.';
    
    echo "<p>✅ Email details set</p>";
    echo "<p><strong>From:</strong> " . SMTP_FROM . "</p>";
    echo "<p><strong>To:</strong> " . SMTP_TO . "</p>";
    
    // Try to send
    echo "<p><strong>Attempting to send email...</strong></p>";
    $result = $mail->send();
    
    if ($result) {
        echo "<p style='color: green;'><strong>✅ SUCCESS: Email sent successfully!</strong></p>";
    } else {
        echo "<p style='color: red;'><strong>❌ FAILED: Email was not sent</strong></p>";
    }
    
} catch (Exception $e) {
    echo "<p style='color: red;'><strong>❌ ERROR:</strong> " . $e->getMessage() . "</p>";
    
    if (isset($mail)) {
        echo "<p><strong>SMTP Error Info:</strong> " . $mail->ErrorInfo . "</p>";
    }
    
    // Common solutions
    echo "<h2>Common Solutions:</h2>";
    echo "<ul>";
    echo "<li><strong>App Password Issue:</strong> Make sure you're using an Office 365 App Password, not your regular password</li>";
    echo "<li><strong>2FA Required:</strong> Enable 2-Factor Authentication on your Office 365 account</li>";
    echo "<li><strong>Port Blocked:</strong> Check if your hosting provider blocks port 587</li>";
    echo "<li><strong>Firewall:</strong> Check if your server firewall allows SMTP connections</li>";
    echo "<li><strong>Account Issues:</strong> Verify the email account exists and is active</li>";
    echo "</ul>";
}
?>
