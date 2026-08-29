<?php require_once '../config/db.php'; require_once '../includes/auth.php'; require_role('student');
$q=trim($_GET['q']??'');
$sql="SELECT m.*,s.name subject_name,u.unit_name FROM materials m JOIN subjects s ON s.id=m.subject_id LEFT JOIN units u ON u.id=m.unit_id WHERE m.material_type=? AND m.status='approved'";
$params=['important_questions'];
if($q!==''){ $sql.=" AND (m.title LIKE ? OR s.name LIKE ? OR u.unit_name LIKE ?)"; $like="%$q%"; $params=[$params[0],$like,$like,$like]; }
$sql.=" ORDER BY m.id DESC";$st=$pdo->prepare($sql);$st->execute($params);$rows=$st->fetchAll();
$page_title='Important Questions';$css_path='../assets/css/style.css';$home_path='dashboard.php';$logout_path='../logout.php';$role='student';include '../includes/header.php'; ?><div class="layout"><?php include '../includes/sidebar.php'; ?>
<h1 class="page-title">Important Questions</h1><p class="breadcrumb">Home → Important Questions</p>
<div class="table-card"><form class="toolbar" method="get"><input name="q" value="<?=e($q)?>" placeholder="Search materials..."><button class="btn primary">Search</button></form>
<div class="table-wrap"><table><thead><tr><th>Title</th><th>Subject</th><th>Unit</th><th>Uploaded On</th><th>Download</th></tr></thead><tbody>
<?php if(!$rows): ?><tr><td colspan="5" class="empty">No materials found.</td></tr><?php else: foreach($rows as $r): ?><tr><td><?=e($r['title'])?></td><td><?=e($r['subject_name'])?></td><td><?=e($r['unit_name']??'All Units')?></td><td><?=date('d M Y',strtotime($r['uploaded_at']))?></td><td><a class="action-btn download-btn" href="../download.php?id=<?=$r['id']?>">⇩ Download</a></td></tr><?php endforeach; endif; ?>
</tbody></table></div></div></main></div><?php include '../includes/footer.php'; ?>