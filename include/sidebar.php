<?php
$current = basename($_SERVER['PHP_SELF']);
$items = [];
if ($role === 'student') {
    $items = [
        ['dashboard.php','⌂','Dashboard'],
        ['notes.php','▣','Notes'],
        ['question_papers.php','▤','Question Papers'],
        ['important_questions.php','★','Important Questions'],
        ['lab_materials.php','⚗','Lab Materials'],
        ['reference_materials.php','▥','Reference Materials'],
        ['downloads.php','⇩','Downloads'],
        ['profile.php','♟','My Profile'],
    ];
    $prefix = '../student/';
} elseif ($role === 'faculty') {
    $items = [
        ['dashboard.php','⌂','Dashboard'],
        ['upload.php','⇧','Upload Material'],
        ['my_materials.php','▣','My Materials'],
        ['subjects.php','▤','Subjects'],
        ['profile.php','♟','Profile'],
    ];
    $prefix = '../faculty/';
} else {
    $items = [
        ['dashboard.php','⌂','Dashboard'],
        ['students.php','♟','Students'],
        ['faculty.php','♟','Faculty'],
        ['subjects.php','▤','Subjects'],
        ['materials.php','▣','Materials'],
        ['question_papers.php','▤','Question Papers'],
        ['reports.php','▥','Reports'],
        ['settings.php','⚙','Settings'],
    ];
    $prefix = '../admin/';
}
?>
<aside class="sidebar">
    <?php foreach ($items as $item): ?>
        <a class="<?= $current === $item[0] ? 'active' : '' ?>" href="<?= $prefix.$item[0] ?>">
            <span class="side-icon"><?= $item[1] ?></span><?= e($item[2]) ?>
        </a>
    <?php endforeach; ?>
</aside>
<main class="content">
