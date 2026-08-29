<?php require_once '../config/db.php'; require_once '../includes/auth.php'; require_role('student');
$sid=(int)($_GET['id']??0);$st=$pdo->prepare("SELECT * FROM subjects WHERE id=?");$st->execute([$sid]);$subject=$st->fetch();if(!$subject) die("Subject not found.");
$u=$pdo->prepare("SELECT * FROM units WHERE subject_id=? ORDER BY unit_no");$u->execute([$sid]);$units=$u->fetchAll();
$page_title=$subject['name'];$css_path='../assets/css/style.css';$home_path='dashboard.php';$logout_path='../logout.php';$role='student';include '../includes/header.php';?><div class="layout"><?php include '../includes/sidebar.php';?>
<h1 class="page-title"><?=e($subject['name'])?></h1><p class="breadcrumb">Home → <?=e($subject['course'])?> → <?=e($subject['year'])?> → <?=e($subject['semester'])?> → <?=e($subject['name'])?></p>
<div class="table-card"><table><thead><tr><th>Unit</th><th>Unit Name</th><th>Action</th></tr></thead><tbody><?php foreach($units as $x):?><tr><td>Unit <?=e($x['unit_no'])?></td><td><?=e($x['unit_name'])?></td><td><a class="action-btn" href="unit.php?id=<?=$x['id']?>">View</a></td></tr><?php endforeach;?></tbody></table></div>
</main></div><?php include '../includes/footer.php';?>