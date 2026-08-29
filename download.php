<?php
require_once 'config/db.php';require_once 'includes/auth.php';require_login();
$id=(int)($_GET['id']??0);$st=$pdo->prepare("SELECT * FROM materials WHERE id=? AND status='approved'");$st->execute([$id]);$m=$st->fetch();if(!$m)die("Material not found.");
$path=__DIR__.'/uploads/'.$m['file_path'];if(!is_file($path))die("File not found on server.");
$pdo->prepare("INSERT INTO downloads(user_id,material_id) VALUES(?,?)")->execute([$_SESSION['user_id'],$id]);
header('Content-Type: application/pdf');header('Content-Disposition: attachment; filename="'.basename($m['file_name']).'"');header('Content-Length: '.filesize($path));readfile($path);exit;
?>