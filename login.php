<?php

if(isset($_GET['timeout'])): ?>
<p class="text-yellow-600 text-center mb-3">
    ⏱️ Session expired due to inactivity. Please login again.
</p>
<?php endif; 

if (session_status() === PHP_SESSION_NONE) session_start();
include "config.php";

date_default_timezone_set('Asia/Kolkata');

$email = "";
$error = "";
$showResend = false;

if (isset($_POST['login'])) {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // 🔍 Get user for attempt check
    $stmt = $conn->prepare("SELECT id, username, password, is_verified, login_attempts, lock_until FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    
    if (empty($error)) {

        if (!$user) {
            $error = "❌ Invalid email or password!";
        } 
        else {

            // Account is currently locked
if ($user['lock_until'] && strtotime($user['lock_until']) > time()) {

    $remaining = ceil((strtotime($user['lock_until']) - time()) / 60);
    $error = "⛔ Account locked. Try again in $remaining minute(s).";

}
// Lock time has expired -> reset attempts
elseif ($user['lock_until'] && strtotime($user['lock_until']) <= time()) {

    $reset = $conn->prepare("UPDATE users SET login_attempts = 0, lock_until = NULL WHERE id = ?");
    $reset->bind_param("i", $user['id']);
    $reset->execute();

    // Also update the current user array so the rest of the login logic uses the reset values
    $user['login_attempts'] = 0;
    $user['lock_until'] = NULL;
}
            elseif (!password_verify($password, $user['password'])) {

                // ❌ Wrong password
                $attempts = $user['login_attempts'] + 1;

                if ($attempts >= 5) {

                    $lockTime = date("Y-m-d H:i:s", strtotime("+10 minutes"));

                    $stmt = $conn->prepare("UPDATE users SET login_attempts=?, lock_until=? WHERE id=?");
                    $stmt->bind_param("isi", $attempts, $lockTime, $user['id']);
                    $stmt->execute();

                    $error = "⛔ Too many attempts. Account locked for 10 minutes.";

                } else {

                    $stmt = $conn->prepare("UPDATE users SET login_attempts=? WHERE id=?");
                    $stmt->bind_param("ii", $attempts, $user['id']);
                    $stmt->execute();

                    $remaining = 5 - $attempts;
                    $error = "❌ Invalid password. $remaining attempt(s) left.";
                }

                

            } 
            else {
                // ✅ SUCCESS LOGIN

                $stmt = $conn->prepare("UPDATE users SET login_attempts=0, lock_until=NULL WHERE id=?");
                $stmt->bind_param("i", $user['id']);
                $stmt->execute();

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['LAST_ACTIVITY'] = time();
                header("Location: index.php");
                exit();
            }
        }
    }

    $stmt->close();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
<title>Login</title>
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

    <h2 class="text-3xl font-bold text-blue-400 text-center mb-6">Login</h2>

    <!-- ERROR -->
    <?php if ($error): ?>
        <p class="text-red-400 mb-3 text-center">
            <?php echo htmlspecialchars($error); ?>
        </p>
    <?php endif; ?>

    <!-- LOGOUT MESSAGE -->
    <?php if(isset($_GET['user'])): ?>
        <p class="text-green-400 mb-3 text-center">
            👋 <?php echo htmlspecialchars($_GET['user']); ?>, you logged out successfully.
        </p>
    <?php endif; ?>

    <!-- LOGIN FORM -->
    <form method="POST">

        <input type="email" name="email" placeholder="Email"
               value="<?php echo htmlspecialchars($email); ?>"
               class="w-full p-3 mb-3 rounded-lg text-black" required>

        <input type="password" name="password" placeholder="Password"
               class="w-full p-3 mb-4 rounded-lg text-black" required>

        <button type="submit" name="login"
                class="w-full bg-blue-600 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
            Login
        </button>
        

    </form>

    <!-- RESEND VERIFICATION -->
    <?php if ($showResend): ?>
        <form method="POST" action="resend_verification.php">
            <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
            
            <button type="submit"
                    class="w-full bg-yellow-500 py-2 rounded-lg mt-3 hover:bg-yellow-600 transition">
                Resend Verification Email
            </button>
        </form>
    <?php endif; ?>
        <p class="text-center mt-2">
<a href="forgot_password.php" class="text-blue-400">Forgot Password?</a>
</p>
    <p class="text-center text-gray-300 text-sm mt-4">
        Don't have an account?
        <a href="register.php" class="text-blue-400 hover:underline">Register</a>
    </p>

</div>
   
</body>
</html>