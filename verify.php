
<?php
include "config.php";

$message = "";
$success = false;

if (!isset($_GET['token'])) {
    $message = "❌ Invalid verification link.";
} else {

    $token = $_GET['token'];

    $stmt = $conn->prepare("
        SELECT id 
        FROM users 
        WHERE verification_token = ?
        AND token_expiry > NOW()
    ");

    $stmt->bind_param("s", $token);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        // verify user
        $update = $conn->prepare("
            UPDATE users 
            SET is_verified = 1,
                verification_token = NULL,
                token_expiry = NULL
            WHERE verification_token = ?
        ");

        $update->bind_param("s", $token);
        $update->execute();

        $message = "✅ Your email has been verified successfully!";
        $success = true;

    } else {
        $message = "❌ Invalid or expired verification link.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Email Verification</title>

<script src="https://cdn.tailwindcss.com"></script>

<style>
body {
    background-color: #111827;
    color: white;
    font-family: Arial, sans-serif;
}
</style>

</head>

<body class="flex justify-center items-center h-screen">

<div class="bg-gray-800 p-8 rounded-xl w-96 text-center shadow-lg">

    <h2 class="text-2xl font-bold mb-4">
        Email Verification
    </h2>

    <p class="<?php echo $success ? 'text-green-400' : 'text-red-400'; ?>">
        <?php echo $message; ?>
    </p>

    <a href="login.php"
       class="mt-6 inline-block bg-blue-600 px-5 py-2 rounded hover:bg-blue-700 transition">
        Go to Login
    </a>

</div>

</body>
</html>