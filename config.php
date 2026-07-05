<?php
$conn = mysqli_connect("localhost", "root", "YOUR_DATABASE_PASSWORD", "pished_db", 3307);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>