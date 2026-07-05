<?php
// activity.php
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['user_id'])) return; // nothing to log for guests

include 'config.php'; // provides $conn (mysqli)

$user_id = (int)$_SESSION['user_id'];
$page = basename($_SERVER['PHP_SELF']);
$event_type = isset($_POST['event_type']) ? $_POST['event_type'] : 'visit';

// optional metadata
$meta = array();
if (!empty($_POST['meta'])) {
    // assume client sends JSON string in meta
    $meta = json_decode($_POST['meta'], true);
}
$meta_json = $meta ? json_encode($meta, JSON_UNESCAPED_UNICODE) : null;
$ip = $_SERVER['REMOTE_ADDR'] ?? null;
$ua = substr($_SERVER['HTTP_USER_AGENT'] ?? '', 0, 255);

// prepared statement
$stmt = $conn->prepare("INSERT INTO user_activity (user_id, page_name, event_type, meta, ip_address, user_agent) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("isssss", $user_id, $page, $event_type, $meta_json, $ip, $ua);
$stmt->execute();
$stmt->close();
?>
