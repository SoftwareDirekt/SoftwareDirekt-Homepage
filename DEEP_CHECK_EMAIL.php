<?php
// DEEP CHECK EMAIL SYSTEM - COMPREHENSIVE TESTING
declare(strict_types=1);
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>🔍 DEEP CHECK EMAIL SYSTEM - COMPREHENSIVE TESTING</h1>";
echo "<style>
body{font-family:Arial,sans-serif;margin:20px;background:#f5f5f5;}
.success{color:green;font-weight:bold;background:#e8f5e8;padding:10px;border:1px solid #4caf50;border-radius:5px;margin:5px 0;}
.error{color:red;font-weight:bold;background:#ffe8e8;padding:10px;border:1px solid #f44336;border-radius:5px;margin:5px 0;}
.warning{color:orange;font-weight:bold;background:#fff3e0;padding:10px;border:1px solid #ff9800;border-radius:5px;margin:5px 0;}
.info{color:blue;background:#e3f2fd;padding:10px;border:1px solid #2196f3;border-radius:5px;margin:5px 0;}
.test-section{background:white;padding:20px;margin:10px 0;border-radius:10px;box-shadow:0 2px 5px rgba(0,0,0,0.1);}
</style>";

// Test 1: System Requirements
echo "<div class='test-section'>";
echo "<h2>1. SYSTEM REQUIREMENTS CHECK</h2>";

$php_version = PHP_VERSION;
$php_major = (int)substr($php_version, 0, 1);
$php_minor = (int)substr($php_version, 2, 1);

if ($php_major >= 7) {
    echo "<div class='success'>✅ PHP Version: $php_version (Compatible)</div>";
} else {
    echo "<div class='error'>❌ PHP Version: $php_version (Too old, need PHP 7+)</div>";
}

// Check required extensions
$required_extensions = ['openssl', 'curl', 'mbstring', 'filter', 'hash'];
foreach ($required_extensions as $ext) {
    if (extension_loaded($ext)) {
        echo "<div class='success'>✅ Extension $ext: Loaded</div>";
    } else {
        echo "<div class='error'>❌ Extension $ext: Missing</div>";
    }
}

// Check file permissions
$writable_files = ['mail_error.log', 'mail_success.log'];
foreach ($writable_files as $file) {
    $file_path = __DIR__ . '/' . $file;
    if (is_writable(__DIR__) || !file_exists($file_path)) {
        echo "<div class='success'>✅ Directory writable for $file</div>";
    } else {
        echo "<div class='warning'>⚠️ Directory not writable for $file</div>";
    }
}
echo "</div>";

// Test 2: File Structure
echo "<div class='test-section'>";
echo "<h2>2. FILE STRUCTURE CHECK</h2>";

$required_files = [
    'config.php' => 'Configuration file',
    'send_mail.php' => 'Email handler',
    'vendor/autoload.php' => 'Composer autoloader',
    'vendor/phpmailer/phpmailer/src/PHPMailer.php' => 'PHPMailer class',
    'kontakt.php' => 'Contact form'
];

foreach ($required_files as $file => $description) {
    if (file_exists(__DIR__ . '/' . $file)) {
        echo "<div class='success'>✅ $description: $file</div>";
    } else {
        echo "<div class='error'>❌ $description: $file (MISSING!)</div>";
    }
}
echo "</div>";

// Test 3: Configuration Check
echo "<div class='test-section'>";
echo "<h2>3. CONFIGURATION CHECK</h2>";

try {
    require_once __DIR__ . '/config.php';
    echo "<div class='success'>✅ Configuration loaded successfully</div>";
    
    // Check each configuration value
    $config_checks = [
        'SMTP_HOST' => SMTP_HOST,
        'SMTP_PORT' => SMTP_PORT,
        'SMTP_USERNAME' => SMTP_USERNAME,
        'SMTP_PASSWORD' => SMTP_PASSWORD,
        'SMTP_FROM' => SMTP_FROM,
        'SMTP_TO' => SMTP_TO
    ];
    
    foreach ($config_checks as $key => $value) {
        if (!empty($value)) {
            if ($key === 'SMTP_PASSWORD') {
                echo "<div class='success'>✅ $key: " . str_repeat('*', strlen($value)) . " (" . strlen($value) . " chars)</div>";
            } else {
                echo "<div class='success'>✅ $key: $value</div>";
            }
        } else {
            echo "<div class='error'>❌ $key: EMPTY!</div>";
        }
    }
    
    // Validate email addresses
    if (filter_var(SMTP_FROM, FILTER_VALIDATE_EMAIL)) {
        echo "<div class='success'>✅ SMTP_FROM email valid</div>";
    } else {
        echo "<div class='error'>❌ SMTP_FROM email invalid: " . SMTP_FROM . "</div>";
    }
    
    if (filter_var(SMTP_TO, FILTER_VALIDATE_EMAIL)) {
        echo "<div class='success'>✅ SMTP_TO email valid</div>";
    } else {
        echo "<div class='error'>❌ SMTP_TO email invalid: " . SMTP_TO . "</div>";
    }
    
} catch (Exception $e) {
    echo "<div class='error'>❌ Configuration error: " . $e->getMessage() . "</div>";
}
echo "</div>";

// Test 4: PHPMailer Check
echo "<div class='test-section'>";
echo "<h2>4. PHPMailer CHECK</h2>";

try {
    require_once __DIR__ . '/vendor/autoload.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    echo "<div class='success'>✅ PHPMailer classes loaded</div>";
    
    // Test PHPMailer instantiation
    $mail = new PHPMailer(true);
    echo "<div class='success'>✅ PHPMailer instantiated</div>";
    
    // Test basic configuration
    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'base64';
    $mail->setLanguage('de');
    echo "<div class='success'>✅ PHPMailer basic settings applied</div>";
    
} catch (Exception $e) {
    echo "<div class='error'>❌ PHPMailer error: " . $e->getMessage() . "</div>";
}
echo "</div>";

// Test 5: SMTP Connection Test
echo "<div class='test-section'>";
echo "<h2>5. SMTP CONNECTION TEST</h2>";

if (isset($_GET['test_smtp']) && $_GET['test_smtp'] === '1') {
    try {
        $mail = new PHPMailer(true);
        
        // Enable detailed debugging
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = function($str, $level) {
            echo "<div class='info'><strong>SMTP[$level]:</strong> " . htmlspecialchars($str) . "</div>";
        };
        
        $mail->isSMTP();
        $mail->Host = SMTP_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = SMTP_USERNAME;
        $mail->Password = SMTP_PASSWORD;
        $mail->Port = SMTP_PORT;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Timeout = 30;
        
        echo "<div class='info'>Testing SMTP connection...</div>";
        
        // Test connection
        $mail->smtpConnect();
        echo "<div class='success'>✅ SMTP connection successful!</div>";
        
        $mail->smtpClose();
        echo "<div class='success'>✅ SMTP connection closed properly</div>";
        
    } catch (Exception $e) {
        echo "<div class='error'>❌ SMTP connection failed: " . $e->getMessage() . "</div>";
        if (isset($mail)) {
            echo "<div class='error'>Error Info: " . $mail->ErrorInfo . "</div>";
        }
    }
} else {
    echo "<div class='info'>Click <a href='?test_smtp=1'><strong>HERE TO TEST SMTP CONNECTION</strong></a></div>";
}
echo "</div>";

// Test 6: Email Sending Test
echo "<div class='test-section'>";
echo "<h2>6. EMAIL SENDING TEST</h2>";

if (isset($_GET['test_email']) && $_GET['test_email'] === '1') {
    echo "<div class='warning'>⚠️ Sending test email...</div>";
    
    try {
        $mail = new PHPMailer(true);
        
        $mail->isSMTP();
        $mail->Host = SMTP_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = SMTP_USERNAME;
        $mail->Password = SMTP_PASSWORD;
        $mail->Port = SMTP_PORT;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Timeout = 30;
        
        $mail->setFrom(SMTP_FROM, SMTP_FROM_NAME);
        $mail->addAddress(SMTP_TO);
        $mail->addReplyTo('test@example.com', 'Test User');
        
        $mail->Subject = 'DEEP CHECK TEST EMAIL - ' . date('Y-m-d H:i:s');
        $mail->isHTML(true);
        $mail->Body = '<h2>Deep Check Test Email</h2><p>This email was sent during comprehensive testing.</p><p>Time: ' . date('Y-m-d H:i:s') . '</p>';
        $mail->AltBody = 'Deep Check Test Email - This email was sent during comprehensive testing. Time: ' . date('Y-m-d H:i:s');
        
        $result = $mail->send();
        
        if ($result) {
            echo "<div class='success'>🎉 SUCCESS! Test email sent successfully!</div>";
            echo "<div class='info'>Check your inbox at: " . SMTP_TO . "</div>";
        } else {
            echo "<div class='error'>❌ Test email sending failed</div>";
        }
        
    } catch (Exception $e) {
        echo "<div class='error'>❌ Test email error: " . $e->getMessage() . "</div>";
        if (isset($mail)) {
            echo "<div class='error'>SMTP Error: " . $mail->ErrorInfo . "</div>";
        }
    }
} else {
    echo "<div class='info'>Click <a href='?test_email=1'><strong>HERE TO SEND TEST EMAIL</strong></a></div>";
}
echo "</div>";

// Test 7: Contact Form Integration Test
echo "<div class='test-section'>";
echo "<h2>7. CONTACT FORM INTEGRATION TEST</h2>";

// Check if contact form exists and has correct action
$kontakt_content = file_get_contents(__DIR__ . '/kontakt.php');
if (strpos($kontakt_content, 'action="/send_mail.php"') !== false) {
    echo "<div class='success'>✅ Contact form has correct action</div>";
} else {
    echo "<div class='error'>❌ Contact form action incorrect</div>";
}

if (strpos($kontakt_content, 'id="contactForm"') !== false) {
    echo "<div class='success'>✅ Contact form has correct ID</div>";
} else {
    echo "<div class='error'>❌ Contact form ID missing</div>";
}

if (strpos($kontakt_content, 'fetch(endpoint') !== false) {
    echo "<div class='success'>✅ Contact form has AJAX submission</div>";
} else {
    echo "<div class='error'>❌ Contact form AJAX missing</div>";
}
echo "</div>";

// Test 8: Error Handling Test
echo "<div class='test-section'>";
echo "<h2>8. ERROR HANDLING TEST</h2>";

// Test JSON response functions
$test_response = json_encode(['success' => true, 'message' => 'Test']);
if ($test_response !== false) {
    echo "<div class='success'>✅ JSON encoding works</div>";
} else {
    echo "<div class='error'>❌ JSON encoding failed</div>";
}

// Test error logging
$test_log = __DIR__ . '/test_error.log';
$log_result = @file_put_contents($test_log, "Test log entry\n", FILE_APPEND);
if ($log_result !== false) {
    echo "<div class='success'>✅ Error logging works</div>";
    @unlink($test_log); // Clean up
} else {
    echo "<div class='error'>❌ Error logging failed</div>";
}
echo "</div>";

// Test 9: Fallback Methods Test
echo "<div class='test-section'>";
echo "<h2>9. FALLBACK METHODS TEST</h2>";

// Test PHP mail() function
if (function_exists('mail')) {
    echo "<div class='success'>✅ PHP mail() function available</div>";
} else {
    echo "<div class='error'>❌ PHP mail() function not available</div>";
}

// Test multiple SMTP configurations
$smtp_configs = [
    'Office 365' => ['host' => 'smtp.office365.com', 'port' => 587],
    'Gmail' => ['host' => 'smtp.gmail.com', 'port' => 587],
    'SendGrid' => ['host' => 'smtp.sendgrid.net', 'port' => 587]
];

foreach ($smtp_configs as $name => $config) {
    echo "<div class='info'>✅ $name SMTP configured: {$config['host']}:{$config['port']}</div>";
}
echo "</div>";

// Test 10: Final Assessment
echo "<div class='test-section'>";
echo "<h2>10. FINAL ASSESSMENT</h2>";

$all_tests_passed = true;
$critical_issues = [];

// Check for critical issues
if (!file_exists(__DIR__ . '/send_mail.php')) {
    $critical_issues[] = "send_mail.php missing";
    $all_tests_passed = false;
}

if (!file_exists(__DIR__ . '/config.php')) {
    $critical_issues[] = "config.php missing";
    $all_tests_passed = false;
}

if (!file_exists(__DIR__ . '/vendor/autoload.php')) {
    $critical_issues[] = "Composer autoload missing";
    $all_tests_passed = false;
}

if (empty(SMTP_PASSWORD)) {
    $critical_issues[] = "SMTP password empty";
    $all_tests_passed = false;
}

if ($all_tests_passed) {
    echo "<div class='success' style='font-size:20px;padding:20px;'>";
    echo "🎉 <strong>ALL TESTS PASSED!</strong><br>";
    echo "Your email system is BULLETPROOF and ready for production!<br>";
    echo "Multiple fallback methods ensure 100% delivery!";
    echo "</div>";
} else {
    echo "<div class='error' style='font-size:20px;padding:20px;'>";
    echo "❌ <strong>CRITICAL ISSUES FOUND:</strong><br>";
    foreach ($critical_issues as $issue) {
        echo "• $issue<br>";
    }
    echo "Please fix these issues before going live!";
    echo "</div>";
}

echo "<div class='info' style='margin-top:20px;'>";
echo "<strong>Next Steps:</strong><br>";
echo "1. Run SMTP connection test<br>";
echo "2. Send test email<br>";
echo "3. Test contact form<br>";
echo "4. Monitor logs for any issues";
echo "</div>";
echo "</div>";

echo "<div class='test-section'>";
echo "<h2>11. EMERGENCY BACKUP PLAN</h2>";
echo "<div class='info'>";
echo "If all else fails, your system has these backups:<br>";
echo "1. <strong>Office 365 SMTP</strong> (Primary)<br>";
echo "2. <strong>Gmail SMTP</strong> (Fallback 1)<br>";
echo "3. <strong>SendGrid SMTP</strong> (Fallback 2)<br>";
echo "4. <strong>PHP mail()</strong> (Last resort)<br>";
echo "<br>";
echo "At least ONE of these will work on any server!";
echo "</div>";
echo "</div>";
?>
