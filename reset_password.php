<?php
include "config.php";
$message = "";
$expiry = date("Y-m-d H:i:s", strtotime("+15 minutes"));
if (!isset($_GET['token'])) {
    die("Invalid request");
}

$token = $_GET['token'];

// Check token
$stmt = $conn->prepare("SELECT id, reset_expiry FROM users WHERE reset_token=?");
$stmt->bind_param("s", $token);
$stmt->execute();

$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    die("Invalid token");
}

if (strtotime($user['reset_expiry']) < time()) {
    die("Link expired");
}

// Handle password reset
if (isset($_POST['password'])) {

    $newPass = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("UPDATE users SET password=?, reset_token=NULL, reset_expiry=NULL WHERE id=?");
    $stmt->bind_param("si", $newPass, $user['id']);
    $stmt->execute();

    $message = "✅ Password updated! You can login now.";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Reset Password</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 flex items-center justify-center h-screen">

<div class="bg-gray-800 p-6 rounded-lg w-96 text-center">

<h2 class="text-white text-xl mb-4">Reset Password</h2>

<?php if ($message): ?>
<p class="text-green-400"><?php echo $message; ?></p>
<?php else: ?>

<form method="POST">
<input type="password" name="password" placeholder="New Password"
class="w-full p-2 mb-3 rounded text-black" required>

<button class="w-full bg-green-600 p-2 rounded">Update Password</button>
</form>

<?php endif; ?>

</div>
</body>
</html>