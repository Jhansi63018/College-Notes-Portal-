<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$page_title = $page_title ?? "College Notes Portal";
$role = $_SESSION['role'] ?? '';
$display_name = $_SESSION['name'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($page_title) ?> | College Notes Portal</title>
<link rel="stylesheet" href="<?= $css_path ?? '../assets/css/style.css' ?>">
</head>
<body>
<header class="topbar">
    <a class="brand" href="<?= $home_path ?? 'index.php' ?>">
        <span class="brand-icon">📖</span>
        <span>COLLEGE NOTES PORTAL</span>
    </a>
    <div class="top-user">
        <?php if ($display_name): ?>
            <span>Welcome, <?= e($display_name) ?></span>
            <a href="<?= $logout_path ?? 'logout.php' ?>" class="logout-link">↪ Logout</a>
        <?php else: ?>
            <a href="<?= $login_path ?? 'login.php' ?>">Login</a>
            <a href="<?= $register_path ?? 'register.php' ?>" class="register-mini">Register</a>
        <?php endif; ?>
    </div>
</header>
