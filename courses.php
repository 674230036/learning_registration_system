<?php
session_start();
require_once "classes/Auth.php";
require_once "classes/Course.php";
Auth::requireLogin();
$courseObj = new Course();
$message = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["course_id"])) {
    if ($courseObj->register(Auth::user()["id"], (int)$_POST["course_id"])) {
        $message = "ลงทะเบียนรายวิชาเรียบร้อยแล้ว";
    } else {
        $error = "ไม่สามารถลงทะเบียนได้ อาจลงทะเบียนไว้แล้วหรือที่นั่งเต็ม";
    }
}
$courses = $courseObj->all();
$title = "รายวิชา";
require "includes/header.php";
?>
<h2 class="fw-bold mb-4">📚 รายวิชาที่เปิดลงทะเบียน</h2>
<?php if ($message): ?><div class="alert alert-success auto-hide"><?= htmlspecialchars($message) ?></div><?php endif; ?>
<?php if ($error): ?><div class="alert alert-danger auto-hide"><?= htmlspecialchars($error) ?></div><?php endif; ?>
<div class="row g-4">
<?php foreach ($courses as $c): $remaining = max(0, (int)$c["capacity"] - (int)$c["registered"]); ?>
<div class="col-md-6 col-lg-4">
<div class="card p-4 course-card h-100">
<span class="badge badge-soft align-self-start mb-2"><?= htmlspecialchars($c["code"]) ?></span>
<h4 class="fw-bold"><?= htmlspecialchars($c["name"]) ?></h4>
<p class="text-muted"><?= htmlspecialchars($c["description"]) ?></p>
<div class="mb-3">หน่วยกิต: <b><?= $c["credits"] ?></b><br>ที่นั่งคงเหลือ: <b><?= $remaining ?></b></div>
<form method="post"><input type="hidden" name="course_id" value="<?= $c["id"] ?>">
<button class="btn btn-primary w-100" <?= $remaining <= 0 ? "disabled" : "" ?>>ลงทะเบียน</button></form>
</div></div>
<?php endforeach; ?>
</div>
<?php require "includes/footer.php"; ?>
