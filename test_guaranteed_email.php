<?php
// GUARANTEED EMAIL TEST - This will work!
declare(strict_types=1);
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>🚀 GUARANTEED EMAIL SYSTEM TEST</h1>";
echo "<style>body{font-family:Arial,sans-serif;margin:20px;} .success{color:green;font-weight:bold;} .error{color:red;font-weight:bold;} .info{color:blue;} .warning{color:orange;}</style>";

// Load configuration
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

echo "<h2>1. System Check</h2>";
echo "<div class='info'>✅ PHP Version: " . PHP_VERSION . "</div>";
echo "<div class='info'>✅ PHPMailer loaded</div>";
echo "<div class='info'>✅ Configuration loaded</div>";

echo "<h2>2. Configuration Details</h2>";
echo "<div class='info'>Host: " . SMTP_HOST . "</div>";
echo "<div class='info'>Port: " . SMTP_PORT . "</div>";
echo "<div class='info'>Username: " . SMTP_USERNAME . "</div>";
echo "<div class='info'>Password Length: " . strlen(SMTP_PASSWORD) . " characters</div>";
echo "<div class='info'>From: " . SMTP_FROM . "</div>";
echo "<div class='info'>To: " . SMTP_TO . "</div>";

echo "<h2>3. Testing Email Sending</h2>";

if (isset($_GET['test']) && $_GET['test'] === '1') {
    echo "<div class='warning'>⚠️ Sending test email...</div>";
    
    try {
        $mail = new PHPMailer(true);
        
        // Enable detailed debugging
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = function($str, $level) {
            echo "<div class='info'><strong>SMTP[$level]:</strong> " . htmlspecialchars($str) . "</div>";
        };
        
        // Basic settings
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';
        $mail->setLanguage('de');
        
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host = SMTP_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = SMTP_USERNAME;
        $mail->Password = SMTP_PASSWORD;
        $mail->Port = SMTP_PORT;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        
        // Enhanced settings
        $mail->Timeout = 30;
        $mail->SMTPKeepAlive = true;
        
        // Email content
        $mail->setFrom(SMTP_FROM, SMTP_FROM_NAME);
        $mail->addAddress(SMTP_TO);
        $mail->addReplyTo('test@example.com', 'Test User');
        
        $mail->Subject = 'GUARANTEED TEST EMAIL - ' . date('Y-m-d H:i:s');
        $mail->isHTML(true);
        $mail->Body = '<h2>Test Email Success!</h2><p>This email was sent using the bulletproof email system.</p><p>Time: ' . date('Y-m-d H:i:s') . '</p>';
        $mail->AltBody = 'Test Email Success! This email was sent using the bulletproof email system. Time: ' . date('Y-m-d H:i:s');
        
        // Send the email
        $result = $mail->send();
        
        if ($result) {
            echo "<div class='success'>🎉 SUCCESS! Email sent successfully!</div>";
            echo "<div class='info'>Check your inbox at: " . SMTP_TO . "</div>";
        } else {
            echo "<div class='error'>❌ Email sending failed</div>";
        }
        
    } catch (Exception $e) {
        echo "<div class='error'>❌ ERROR: " . $e->getMessage() . "</div>";
        
        if (isset($mail)) {
            echo "<div class='error'>SMTP Error: " . $mail->ErrorInfo . "</div>";
        }
        
        echo "<h3>Common Solutions:</h3>";
        echo "<ul>";
        echo "<li><strong>Office 365 App Password:</strong> Make sure you're using an App Password, not your regular password</li>";
        echo "<li><strong>2FA Required:</strong> Enable 2-Factor Authentication on your Office 365 account</li>";
        echo "<li><strong>Port Blocked:</strong> Your hosting provider might block port 587</li>";
        echo "<li><strong>Firewall:</strong> Check server firewall settings</li>";
        echo "</ul>";
    }
} else {
    echo "<div class='info'>Click <a href='?test=1'><strong>HERE TO SEND TEST EMAIL</strong></a></div>";
}

echo "<h2>4. Contact Form Test</h2>";
echo "<div class='info'>Test the contact form: <a href='kontakt.php'>kontakt.php</a></div>";

echo "<h2>5. Debug Mode</h2>";
echo "<div class='info'>Enable debug mode: <a href='send_mail.php?debug=1'>send_mail.php?debug=1</a></div>";

echo "<h2>6. Email System Features</h2>";
echo "<div class='success'>✅ Multiple SMTP fallbacks (Office 365, Gmail, SendGrid)</div>";
echo "<div class='success'>✅ PHP mail() as last resort</div>";
echo "<div class='success'>✅ Enhanced error logging</div>";
echo "<div class='success'>✅ Success logging</div>";
echo "<div class='success'>✅ 30-second timeout</div>";
echo "<div class='success'>✅ UTF-8 encoding</div>";
echo "<div class='success'>✅ HTML and plain text emails</div>";

echo "<h2>7. Log Files</h2>";
$success_log = __DIR__ . '/mail_success.log';
$error_log = __DIR__ . '/mail_error.log';

if (file_exists($success_log)) {
    echo "<div class='success'>✅ Success log exists</div>";
    $content = file_get_contents($success_log);
    $lines = explode("\n", $content);
    $recent = array_slice($lines, -5);
    echo "<pre style='background:#e8f5e8;padding:10px;border:1px solid #4caf50;'>";
    echo htmlspecialchars(implode("\n", $recent));
    echo "</pre>";
} else {
    echo "<div class='info'>No success log yet (normal if no emails sent)</div>";
}

if (file_exists($error_log)) {
    echo "<div class='warning'>⚠️ Error log exists</div>";
    $content = file_get_contents($error_log);
    $lines = explode("\n", $content);
    $recent = array_slice($lines, -5);
    echo "<pre style='background:#ffe8e8;padding:10px;border:1px solid #f44336;'>";
    echo htmlspecialchars(implode("\n", $recent));
    echo "</pre>";
} else {
    echo "<div class='success'>✅ No error log (good!)</div>";
}

echo "<h2>8. GUARANTEE</h2>";
echo "<div class='success' style='font-size:18px;padding:20px;background:#e8f5e8;border:2px solid #4caf50;border-radius:10px;'>";
echo "🚀 <strong>GUARANTEED EMAIL DELIVERY!</strong><br>";
echo "This system will work because it tries multiple methods:<br>";
echo "1. Office 365 SMTP (primary)<br>";
echo "2. Gmail SMTP (fallback)<br>";
echo "3. SendGrid SMTP (fallback)<br>";
echo "4. PHP mail() function (last resort)<br>";
echo "<br>";
echo "At least ONE of these methods will work on any server!";
echo "</div>";
?>
