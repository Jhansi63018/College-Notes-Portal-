<?php
if (session_status() === PHP_SESSION_NONE) session_start();

function require_login() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../login.php");
        exit;
    }
}
function require_role($role) {
    require_login();
    if (($_SESSION['role'] ?? '') !== $role) {
        http_response_code(403);
        die("Access denied.");
    }
}
function e($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}
function role_home() {
    $role = $_SESSION['role'] ?? '';
    if ($role === 'student') return 'student/dashboard.php';
    if ($role === 'faculty') return 'faculty/dashboard.php';
    if ($role === 'admin') return 'admin/dashboard.php';
    return 'login.php';
}
?>