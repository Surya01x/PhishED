<?php
date_default_timezone_set('Asia/Kolkata');
include "config.php";
require __DIR__ . '/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;

if (!isset($_POST['email'])) {
    die("Invalid request");
}

$email = trim($_POST['email']);

// Check user
$stmt = $conn->prepare("SELECT id, username, is_verified FROM users WHERE email=?");
$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    die("User not found");
}

if ($user['is_verified'] == 1) {
    die("Account already verified");
}

// Generate new token
$token  = bin2hex(random_bytes(32));
$expiry = date("Y-m-d H:i:s", strtotime("+15 minutes"));

// Update DB
$stmt = $conn->prepare("UPDATE users SET verification_token=?, token_expiry=? WHERE email=?");
$stmt->bind_param("sss", $token, $expiry, $email);
$stmt->execute();

// Send email
$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username   = "YOUR_GMAIL@gmail.com";;       // 🔁 CHANGE YOUR_GMAIL@gmail.com
    $mail->Password   = "YOUR_GMAIL_APP_PASSWORD";          // 🔁 CHANGE YOUR_GMAIL_APP_PASSWORD
    $mail->SMTPSecure = "tls";
    $mail->Port = 587;

    $mail->setFrom("your_email@gmail.com", "PhishED");
    $mail->addAddress($email, $user['username']);

    $verifyLink = "http://localhost/PhishED-main/PhishED-main/verify.php?token=" . urlencode($token);

    $mail->isHTML(true);
    $mail->Subject = "Resend Verification - PhishED";
    $mail->Body = "
        <p>Click below to verify your account:</p>
        <a href='$verifyLink'>Verify Email</a>
    ";

    $mail->send();

    echo "Success! Check again your mail to verify!!";

} catch (Exception $e) {
    echo "❌ Mail Error: " . $mail->ErrorInfo;;
}