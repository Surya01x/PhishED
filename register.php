<?php
date_default_timezone_set('Asia/Kolkata');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include "config.php";
require __DIR__ . '/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;

$error = "";
$success = "";

if (isset($_POST['register'])) {

    $username = trim($_POST['username']);
    $email    = trim($_POST['email']);
    $password = $_POST['password'];

    // Validation
    if (empty($username) || empty($email) || empty($password)) {
        $error = "All fields are required.";
    } else {

        // Check existing email
        $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $error = "Email already registered!";
        } else {

            // Hash password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Generate token
            $token  = bin2hex(random_bytes(32));
            $expiry = date("Y-m-d H:i:s", strtotime("+1 hour"));

            // Insert user
            $stmt = $conn->prepare(
                "INSERT INTO users (username, email, password, verification_token, token_expiry) VALUES (?, ?, ?, ?, ?)"
            );
            $stmt->bind_param("sssss", $username, $email, $hashedPassword, $token, $expiry);

            if ($stmt->execute()) {

                // Send email
                $mail = new PHPMailer(true);

                try {
                    $mail->isSMTP();
                    $mail->Host       = "smtp.gmail.com";
                    $mail->SMTPAuth   = true;
                    $mail->Username   = "YOUR_GMAIL@gmail.com";;       // 🔁 CHANGE YOUR_GMAIL@gmail.com
                    $mail->Password   = "YOUR_GMAIL_APP_PASSWORD";          // 🔁 CHANGE YOUR_GMAIL_APP_PASSWORD
                    $mail->SMTPSecure = "tls";
                    $mail->Port       = 587;

                    $mail->setFrom("YOUR_GMAIL@gmail.com", "PhishED");
                    $mail->addAddress($email, $username);

                    $verifyLink = "http://localhost/PhishED-main/PhishED-main/verify.php?token=$token";

                    $mail->isHTML(true);
                    $mail->Subject = "Verify Your Email - PhishED";
                    $mail->Body = "
                        <h2>Welcome to PhishED 🛡️</h2>
                        <p>Click the button below to verify your account:</p>
                        <a href='$verifyLink' style='padding:10px 20px;background:#16a34a;color:#fff;text-decoration:none;border-radius:5px;'>
                            Verify Email
                        </a>
                        <p>This link expires in 1 hour.</p>
                    ";

                    $mail->send();

                    $success = "✅ Registration successful! Check your email to verify.";

                } catch (Exception $e) {
                    $error = "❌ Email could not be sent.";
                }

            } else {
                $error = "Registration failed. Please try again.";
            }

            $stmt->close();
        }

        $check->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register | PhishED</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #1a202c;
            color: #e2e8f0;
            background-image: radial-gradient(circle at 1px 1px, rgba(255,255,255,0.05) 1px, transparent 0);
            background-size: 20px 20px;
        }
    </style>
</head>

<body class="h-screen flex justify-center items-center">

<div class="bg-gray-800 p-8 w-96 rounded-xl border border-gray-700 shadow-lg">

    <h2 class="text-3xl font-bold text-green-400 text-center mb-6">
        Create Account
    </h2>

    <!-- ERROR -->
    <?php if ($error): ?>
        <p class="text-red-400 mb-4 text-center">
            <?php echo htmlspecialchars($error); ?>
        </p>
    <?php endif; ?>

    <!-- SUCCESS -->
    <?php if ($success): ?>
        <p class="text-green-400 mb-4 text-center">
            <?php echo htmlspecialchars($success); ?>
        </p>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
        </div>
        <input type="text" name="username" placeholder="Username"
               class="w-full p-3 mb-3 rounded-lg text-black" required>

        <input type="email" name="email" placeholder="Email"
               class="w-full p-3 mb-3 rounded-lg text-black" required>

        <input type="password" name="password" placeholder="Password"
               class="w-full p-3 mb-4 rounded-lg text-black" required>

        <button type="submit" name="register"
                class="w-full bg-green-600 py-3 rounded-lg font-semibold hover:bg-green-700 transition">
            Register
        </button>

    </form>

    <p class="text-center text-gray-300 text-sm mt-4">
        Already have an account?
        <a href="/PhishED-main/PhishED-main/login.php" class="text-blue-400 hover:underline">
            Login
        </a>
    </p>

</div>

</body>
</html>
