<?php
include "config.php";
require __DIR__ . '/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;

$message = "";

if (isset($_POST['email'])) {

    $email = trim($_POST['email']);

    $stmt = $conn->prepare("SELECT id, username FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {

        $token  = bin2hex(random_bytes(32));
        $expiry = date("Y-m-d H:i:s", strtotime("+15 minutes"));

        // Save token
        $stmt = $conn->prepare("UPDATE users SET reset_token=?, reset_expiry=? WHERE email=?");
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

            $mail->SMTPOptions = [
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                ]
            ];

            $mail->setFrom("suryavishnux4@gmail.com", "PhishED");
            $mail->addAddress($email, $user['username']);

            $link = "http://localhost/PhishED-main/PhishED-main/reset_password.php?token=" . urlencode($token);

            $mail->isHTML(true);
            
            $mail->Subject = "Reset Your Password";
            $mail->Body = "<a href='$link'>Click here to reset your password</a>";
            $mail->Body = "
    <h2>Password Reset Request</h2>

    <p>We received a request to reset your password.</p>

    <p>
        <a href='$link' style='background:#2563eb;color:white;padding:10px 15px;
        text-decoration:none;border-radius:5px;'>
        Reset Password
        </a>
    </p>

    <p style='color:gray;'>
        ⚠️ This link is valid for <b>15 minutes</b>.
    </p>
";
           
            $mail->send();

        } catch (Exception $e) {
            // Don't expose error
        }
    }

    // Always show same message (security)
    $message = "If this email exists, a reset link has been sent. ";
}
?>


<!DOCTYPE html>
<html>
<head>
<title>Forgot Password</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 flex items-center justify-center h-screen">

<div class="bg-gray-800 p-6 rounded-lg w-96 text-center">

<h2 class="text-xl text-white mb-4">Forgot Password</h2>

<?php if ($message): ?>
<p class="text-green-400 mb-3"><?php echo $message; ?></p>
<?php endif; ?>

<form method="POST">
<input type="email" name="email" placeholder="Enter your email"
class="w-full p-2 mb-3 rounded text-black" required>

<button class="w-full bg-blue-600 p-2 rounded">Send Reset Link</button>
</form>

</div>
</body>
</html>