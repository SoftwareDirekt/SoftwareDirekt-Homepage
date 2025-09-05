<?php
// Debug script for email issues
declare(strict_types=1);
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>🔍 Email System Debug</h1>";
echo "<style>body{font-family:Arial,sans-serif;margin:20px;} .success{color:green;} .error{color:red;} .warning{color:orange;} .info{color:blue;}</style>";

// Test 1: Basic PHP and file loading
echo "<h2>1. Basic System Check</h2>";
echo "<div class='info'>PHP Version: " . PHP_VERSION . "</div>";
echo "<div class='info'>Current Directory: " . __DIR__ . "</div>";

if (file_exists(__DIR__ . '/config.php')) {
    echo "<div class='success'>✅ config.php exists</div>";
} else {
    echo "<div class='error'>❌ config.php not found</div>";
    exit;
}

if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    echo "<div class='success'>✅ Composer autoload exists</div>";
} else {
    echo "<div class='error'>❌ Composer autoload not found</div>";
    exit;
}

// Test 2: Load configuration
echo "<h2>2. Configuration Check</h2>";
try {
    require_once __DIR__ . '/config.php';
    echo "<div class='success'>✅ Configuration loaded</div>";
    echo "<div class='info'>SMTP Host: " . SMTP_HOST . "</div>";
    echo "<div class='info'>SMTP Port: " . SMTP_PORT . "</div>";
    echo "<div class='info'>SMTP Username: " . SMTP_USERNAME . "</div>";
    echo "<div class='info'>SMTP From: " . SMTP_FROM . "</div>";
    echo "<div class='info'>SMTP To: " . SMTP_TO . "</div>";
} catch (Exception $e) {
    echo "<div class='error'>❌ Configuration error: " . $e->getMessage() . "</div>";
    exit;
}

// Test 3: PHPMailer availability
echo "<h2>3. PHPMailer Check</h2>";
try {
    require_once __DIR__ . '/vendor/autoload.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    echo "<div class='success'>✅ PHPMailer classes loaded</div>";
} catch (Exception $e) {
    echo "<div class='error'>❌ PHPMailer error: " . $e->getMessage() . "</div>";
    exit;
}

// Test 4: Test actual email sending with detailed debugging
echo "<h2>4. Email Sending Test</h2>";
echo "<div class='warning'>⚠️ This will attempt to send a real test email!</div>";

if (isset($_GET['send_test']) && $_GET['send_test'] === '1') {
    try {
        $mail = new PHPMailer(true);
        
        // Enable detailed debugging
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = function($str, $level) {
            echo "<div class='info'>SMTP[$level]: " . htmlspecialchars($str) . "</div>";
        };
        
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';
        $mail->setLanguage('de');
        
        $mail->isSMTP();
        $mail->Host = SMTP_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = SMTP_USERNAME;
        $mail->Password = SMTP_PASSWORD;
        $mail->Port = (int)SMTP_PORT;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        
        $mail->setFrom(SMTP_FROM, SMTP_FROM_NAME);
        $mail->addAddress(SMTP_TO);
        $mail->addReplyTo('test@example.com', 'Test User');
        
        $mail->Subject = 'Test Email - ' . date('Y-m-d H:i:s');
        $mail->isHTML(true);
        $mail->Body = '<p><strong>Test Email</strong></p><p>This is a test email from your contact form system.</p>';
        $mail->AltBody = 'Test Email - This is a test email from your contact form system.';
        
        echo "<div class='info'>Attempting to send email...</div>";
        $mail->send();
        echo "<div class='success'>✅ Test email sent successfully!</div>";
        
    } catch (Exception $e) {
        echo "<div class='error'>❌ Email sending failed: " . $e->getMessage() . "</div>";
        if (isset($mail)) {
            echo "<div class='error'>Error Info: " . $mail->ErrorInfo . "</div>";
        }
    }
} else {
    echo "<div class='info'>Click <a href='?send_test=1'>here</a> to send a test email</div>";
}

// Test 5: Check common issues
echo "<h2>5. Common Issues Check</h2>";

// Check if password looks like an app password
if (strlen(SMTP_PASSWORD) < 16) {
    echo "<div class='warning'>⚠️ Password seems too short. Office 365 app passwords are usually 16+ characters</div>";
}

// Check if it's using the right port
if (SMTP_PORT != 587) {
    echo "<div class='warning'>⚠️ Using port " . SMTP_PORT . ". Office 365 typically uses port 587</div>";
}

// Check if it's using the right encryption
if (SMTP_ENCRYPTION != 'tls') {
    echo "<div class='warning'>⚠️ Using " . SMTP_ENCRYPTION . " encryption. Office 365 typically uses TLS</div>";
}

// Test 6: Check send_mail.php file
echo "<h2>6. send_mail.php Check</h2>";
if (file_exists(__DIR__ . '/send_mail.php')) {
    echo "<div class='success'>✅ send_mail.php exists</div>";
    
    // Check if it has the right permissions
    if (is_readable(__DIR__ . '/send_mail.php')) {
        echo "<div class='success'>✅ send_mail.php is readable</div>";
    } else {
        echo "<div class='error'>❌ send_mail.php is not readable</div>";
    }
} else {
    echo "<div class='error'>❌ send_mail.php not found</div>";
}

// Test 7: Check for error logs
echo "<h2>7. Error Logs Check</h2>";
$error_log = __DIR__ . '/mail_error.log';
if (file_exists($error_log)) {
    echo "<div class='warning'>⚠️ Error log found. Recent errors:</div>";
    $log_content = file_get_contents($error_log);
    $lines = explode("\n", $log_content);
    $recent_lines = array_slice($lines, -10); // Last 10 lines
    echo "<pre style='background:#f5f5f5;padding:10px;border:1px solid #ddd;'>";
    echo htmlspecialchars(implode("\n", $recent_lines));
    echo "</pre>";
} else {
    echo "<div class='info'>No error log found (this is normal if no errors occurred)</div>";
}

echo "<h2>8. Troubleshooting Tips</h2>";
echo "<div class='info'>";
echo "<strong>If emails aren't being delivered:</strong><br>";
echo "1. Check if you're using an <strong>App Password</strong> (not your regular password)<br>";
echo "2. Ensure 2FA is enabled on your Office 365 account<br>";
echo "3. Check if your hosting provider blocks SMTP ports<br>";
echo "4. Verify the email address exists and is correct<br>";
echo "5. Check spam/junk folders<br>";
echo "6. Try with a different email provider (Gmail, etc.)<br>";
echo "</div>";

echo "<h2>9. Quick Fixes to Try</h2>";
echo "<div class='info'>";
echo "1. <a href='?send_test=1'>Send Test Email</a><br>";
echo "2. Check the contact form: <a href='kontakt.php'>kontakt.php</a><br>";
echo "3. Try with debug mode: <a href='send_mail.php?debug=1'>send_mail.php?debug=1</a><br>";
echo "</div>";
?>
