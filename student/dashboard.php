<?php require_once '../config/db.php'; require_once '../includes/auth.php'; require_role('student');
$counts=[];
foreach(['unit_notes','question_paper','important_questions','lab_material','reference_material'] as $t){$s=$pdo->prepare("SELECT COUNT(*) FROM materials WHERE material_type=? AND status='approved'");$s->execute([$t]);$counts[$t]=$s->fetchColumn();}
$page_title='Student Dashboard';$css_path='../assets/css/style.css';$home_path='dashboard.php';$logout_path='../logout.php';$role='student';include '../includes/header.php'; ?>
<div class="layout"><?php include '../includes/sidebar.php'; ?>
<h1 class="page-title">Student Dashboard</h1><p>Search and download study materials easily.</p>
<div class="card-grid">
<?php $cards=[['📘','Unit Notes','unit_notes','notes.php','View Notes','primary'],['📄','Question Papers','question_paper','question_papers.php','View Papers','teal'],['⭐','Important Questions','important_questions','important_questions.php','View Questions','orange'],['⚗','Lab Materials','lab_material','lab_materials.php','View Materials','purple'],['📖','Reference Materials','reference_material','reference_materials.php','View Materials','teal']]; foreach($cards as $c): ?>
<div class="dash-card"><div class="big-icon"><?=$c[0]?></div><h3><?=$c[1]?></h3><p class="small-muted"><?=$counts[$c[2]]?> available</p><a class="btn <?=$c[5]?>" href="<?=$c[3]?>"><?=$c[4]?></a></div>
<?php endforeach;?></div><div class="notice">Access notes, question papers, important questions, lab manuals and reference materials by subject and unit.</div>
</main></div><?php include '../includes/footer.php'; ?>
