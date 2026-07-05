<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// ⏱️ Timeout duration (in seconds)
$timeout = 600; // 10 minutes

// Check if session exists
if (isset($_SESSION['user_id'])) {

    // If last activity exists
    if (isset($_SESSION['LAST_ACTIVITY'])) {

        // Check inactivity
        if (time() - $_SESSION['LAST_ACTIVITY'] > $timeout) {

            // Destroy session
            session_unset();
            session_destroy();

            header("Location: login.php?timeout=1");
            exit();
        }
    }

    // Update last activity time
    $_SESSION['LAST_ACTIVITY'] = time();
} else {
    // Not logged in
    header("Location: login.php");
    exit();
}
?>