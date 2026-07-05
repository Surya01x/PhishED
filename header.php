<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>

<nav class="bg-blue-900 text-white shadow-md sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

        <!-- Left: Logo -->
        <a href="index.html" class="text-2xl font-bold tracking-tight hover:text-blue-200 transition">
            pishEd
        </a>

        <!-- Middle: Navigation -->
        <div class="flex gap-6 text-lg">
            <a href="index.html" class="hover:text-blue-200 transition">Home</a>
            <a href="simulate.php" class="hover:text-blue-200 transition">Simulate</a>
            <a href="quiz.php" class="hover:text-blue-200 transition">Quiz</a>
            <a href="learn.php" class="hover:text-blue-200 transition">Learn</a>
        </div>

        <!-- Right: User + Logout -->
        <div class="flex items-center gap-4">
            <?php if(isset($_SESSION['username'])): ?>
                <span class="text-blue-200 font-semibold flex items-center gap-1">
                    <i class="fas fa-user"></i> <?php echo htmlspecialchars($_SESSION['username']); ?>
                </span>

                <a href="logout.php"
                   class="bg-red-600 px-4 py-2 rounded-lg font-semibold hover:bg-red-700 transition">
                    Logout
                </a>
            <?php else: ?>
                <a href="login.php" class="hover:text-blue-200 transition">Login</a>
                <a href="register.php" class="hover:text-blue-200 transition">Register</a>
            <?php endif; ?>
        </div>

    </div>
</nav>
