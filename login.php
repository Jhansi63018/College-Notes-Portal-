<?php
session_start(); require_once 'config/db.php';
function e($v){return htmlspecialchars((string)$v,ENT_QUOTES,'UTF-8');}
$error='';
if($_SERVER['REQUEST_METHOD']==='POST'){
    $username=trim($_POST['username']??''); $password=$_POST['password']??'';
    $st=$pdo->prepare("SELECT * FROM users WHERE username=? AND status='active' LIMIT 1"); $st->execute([$username]); $u=$st->fetch();
    if($u && password_verify($password,$u['password'])){
        $_SESSION['user_id']=$u['id']; $_SESSION['role']=$u['role']; $_SESSION['name']=$u['name'];
        $dest=$u['role']==='student'?'student/dashboard.php':($u['role']==='faculty'?'faculty/dashboard.php':'admin/dashboard.php');
        header("Location: $dest"); exit;
    } else $error='Invalid username or password.';
}
?>
<!DOCTYPE html><html><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0"><title>Login</title><link rel="stylesheet" href="assets/css/style.css"></head>
<body class="auth-page"><div class="auth-card"><div class="auth-logo">📖</div><h1>College Notes Portal</h1><h2>Login</h2>
<?php if($error): ?><div class="alert error"><?= e($error) ?></div><?php endif; ?>
<form method="post"><label>Username</label><input type="text" name="username" required>
<label>Password</label><input type="password" name="password" required>
<button class="btn primary full">Login</button></form>
<p class="auth-help">Student? <a href="register.php">Create an account</a></p><p><a href="index.php">← Back to Home</a></p>
</div></body></html>
