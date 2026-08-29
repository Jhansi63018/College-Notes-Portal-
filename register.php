<?php
session_start(); require_once 'config/db.php';
function e($v){return htmlspecialchars((string)$v,ENT_QUOTES,'UTF-8');}
$msg=''; $error='';
if($_SERVER['REQUEST_METHOD']==='POST'){
    $name=trim($_POST['name']??''); $username=trim($_POST['username']??''); $email=trim($_POST['email']??''); $password=$_POST['password']??'';
    if($name===''||$username===''||$email===''||strlen($password)<4) $error='Please fill all fields. Password must be at least 4 characters.';
    else {
        $st=$pdo->prepare("SELECT id FROM users WHERE username=? OR email=?"); $st->execute([$username,$email]);
        if($st->fetch()) $error='Username or email already exists.';
        else {
            $hash=password_hash($password,PASSWORD_DEFAULT);
            $st=$pdo->prepare("INSERT INTO users(name,username,email,password,role,status) VALUES(?,?,?,?, 'student','active')");
            $st->execute([$name,$username,$email,$hash]); $msg='Registration successful. You can now login.';
        }
    }
}
?>
<!DOCTYPE html><html><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0"><title>Register</title><link rel="stylesheet" href="assets/css/style.css"></head>
<body class="auth-page"><div class="auth-card"><div class="auth-logo">📖</div><h1>College Notes Portal</h1><h2>Student Registration</h2>
<?php if($error): ?><div class="alert error"><?=e($error)?></div><?php endif; ?><?php if($msg): ?><div class="alert success"><?=e($msg)?></div><?php endif; ?>
<form method="post"><label>Full Name</label><input name="name" required><label>Username</label><input name="username" required><label>Email</label><input type="email" name="email" required><label>Password</label><input type="password" name="password" required><button class="btn primary full">Register</button></form>
<p>Already registered? <a href="login.php">Login</a></p><p><a href="index.php">← Back to Home</a></p></div></body></html>
