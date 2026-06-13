<?php
header('Content-Type: application/json');

// Load env
$envFile = dirname(__FILE__) . '/.env';
if (file_exists($envFile)) {
    foreach (file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        $line = trim($line);
        if ($line === '' || $line[0] === '#' || strpos($line, '=') === false) continue;
        list($key, $val) = explode('=', $line, 2);
        $_ENV[trim($key)] = trim($val);
    }
}

// PHPMailer
require_once __DIR__ . '/phpmailer/Exception.php';
require_once __DIR__ . '/phpmailer/PHPMailer.php';
require_once __DIR__ . '/phpmailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Email templates
require_once __DIR__ . '/email_templates/admin_notification.php';
require_once __DIR__ . '/email_templates/client_greeting.php';

// DB
require_once __DIR__ . '/db.php';

// Validate input
$name    = trim($_POST['name']    ?? '');
$email   = trim($_POST['email']   ?? '');
$phone   = trim($_POST['phone']   ?? '');
$project = trim($_POST['project'] ?? '');
$message = trim($_POST['message'] ?? '');
$page    = trim($_POST['page']    ?? 'contact');

if (!$name || !$email || !$message) {
    echo json_encode(['success' => false, 'message' => 'Please fill all required fields.']);
    exit;
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Invalid email address.']);
    exit;
}

$data = compact('name', 'email', 'phone', 'project', 'message');

// Save to DB
try {
    $pdo->prepare("INSERT INTO form_submissions (name, email, phone, project, message, page) VALUES (?,?,?,?,?,?)")
        ->execute([$name, $email, $phone, $project, $message, $page]);
} catch (Exception $e) {
    // DB save failed — still try to send email
}

// Helper: create mailer
function makeMailer() {
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host       = $_ENV['MAIL_HOST'] ?? 'smtp.hostinger.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = $_ENV['MAIL_USER'] ?? '';
    $mail->Password   = $_ENV['MAIL_PASS'] ?? '';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = (int)($_ENV['MAIL_PORT'] ?? 465);
    $mail->setFrom($_ENV['MAIL_FROM'] ?? '', $_ENV['MAIL_FROM_NAME'] ?? 'Renova Marketing Solutions');
    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';
    return $mail;
}

$errors = [];

// 1. Admin notification email
try {
    $mail = makeMailer();
    $mail->addAddress($_ENV['ADMIN_EMAIL'] ?? $_ENV['MAIL_USER'] ?? '');
    $mail->Subject = 'New Enquiry from ' . $name . ' — Renova';
    $mail->Body    = adminEmailTemplate($data);
    $mail->AltBody = "New enquiry from: $name\nEmail: $email\nPhone: $phone\nProject: $project\nMessage: $message";
    $mail->send();
} catch (Exception $e) {
    $errors[] = 'Admin email failed.';
}

// 2. Client greeting email
try {
    $mail = makeMailer();
    $mail->addAddress($email, $name);
    $mail->Subject = 'We received your message — Renova Marketing Solutions';
    $mail->Body    = clientEmailTemplate($data);
    $mail->AltBody = "Hi $name, thank you for reaching out to Renova Marketing Solutions. We'll get back to you within 24 hours.";
    $mail->send();
} catch (Exception $e) {
    $errors[] = 'Client email failed.';
}

echo json_encode([
    'success' => true,
    'message' => 'Thank you ' . $name . '! We\'ll be in touch within 24 hours.',
]);
