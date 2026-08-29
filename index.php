<?php
session_start();
function e($v){return htmlspecialchars((string)$v,ENT_QUOTES,'UTF-8');}
if (isset($_SESSION['user_id'])) {
    header("Location: ".($_SESSION['role']==='student'?'student/dashboard.php':($_SESSION['role']==='faculty'?'faculty/dashboard.php':'admin/dashboard.php')));
    exit;
}
?>
<!DOCTYPE html>
<html lang="en"><head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>College Notes Portal</title><link rel="stylesheet" href="assets/css/style.css">
</head><body class="landing">
<header class="landing-top">
<a class="brand dark-brand" href="index.php"><span class="brand-icon">📖</span> COLLEGE NOTES PORTAL</a>
<nav><a href="#about">About</a><a href="#contact">Contact</a><a class="nav-login" href="login.php">Login</a><a class="nav-register" href="register.php">Register</a></nav>
</header>
<section class="hero">
<div class="hero-copy">
<h1>COLLEGE NOTES &<br>STUDY MATERIAL PORTAL</h1>
<p>Find notes, question papers and study materials<br>for your courses.</p>
<div class="hero-buttons"><a href="login.php" class="btn primary">Student Login</a><a href="register.php" class="btn white">Register</a></div>
</div>
<div class="books-art"><div class="cap">🎓</div><div class="book b1"></div><div class="book b2"></div><div class="book b3"></div><div class="book b4"></div></div>
</section>
<section class="feature-row" id="about">
<?php
$cards=[['📘','Unit Notes','Access unit-wise study notes'],['📄','Question Papers','Previous year exam papers'],['⭐','Important Questions','Important questions for exams'],['📑','Lab Materials','Lab manuals and materials']];
foreach($cards as $c): ?>
<div class="feature-card"><div class="feature-icon"><?= $c[0] ?></div><h3><?= $c[1] ?></h3><p><?= $c[2] ?></p></div>
<?php endforeach; ?>
</section>
<section class="about-strip" id="contact"><h2>Everything you need for exam preparation</h2><p>Students can access materials by course, semester, subject and unit. Faculty can upload materials and administrators can manage the portal.</p></section>
</body></html>
