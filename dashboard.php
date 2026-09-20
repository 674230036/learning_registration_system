<?php
session_start();
require_once "classes/Auth.php";
require_once "classes/Course.php";
Auth::requireLogin();
$user = Auth::user();
$course = new Course();
$myCourses = $course->myCourses($user["id"]);
$all = $course->all();
$title = "Dashboard";
require "includes/header.php";
?>
<div class="d-flex justify-content-between align-items-center mb-4">
  <div><h2 class="fw-bold mb-1">สวัสดี <?= htmlspecialchars($user["name"]) ?> 👋</h2><p class="text-muted mb-0">ข้อมูลการเรียนของคุณ</p></div>
  <a href="courses.php" class="btn btn-primary">+ ลงทะเบียนรายวิชา</a>
</div>
<div class="row g-3 mb-4">
  <div class="col-md-4"><div class="stat"><div class="text-muted">รายวิชาที่ลงทะเบียน</div><div class="display-6 fw-bold"><?= count($myCourses) ?></div></div></div>
  <div class="col-md-4"><div class="stat"><div class="text-muted">รายวิชาที่เปิด</div><div class="display-6 fw-bold"><?= count($all) ?></div></div></div>
  <div class="col-md-4"><div class="stat"><div class="text-muted">สถานะ</div><div class="display-6 fw-bold text-success">ปกติ</div></div></div>
</div>
<div class="card p-4">
<h4 class="fw-bold">📚 รายวิชาของฉัน</h4>
<div class="table-responsive">
<table class="table align-middle">
<thead><tr><th>รหัส</th><th>รายวิชา</th><th>หน่วยกิต</th><th>วันที่ลงทะเบียน</th></tr></thead>
<tbody>
<?php foreach ($myCourses as $c): ?>
<tr><td><?= htmlspecialchars($c["code"]) ?></td><td><?= htmlspecialchars($c["name"]) ?></td><td><?= $c["credits"] ?></td><td><?= htmlspecialchars($c["registered_at"]) ?></td></tr>
<?php endforeach; ?>
<?php if (!$myCourses): ?><tr><td colspan="4" class="text-center text-muted">ยังไม่มีรายวิชาที่ลงทะเบียน</td></tr><?php endif; ?>
</tbody></table></div>
</div>
<?php require "includes/footer.php"; ?>
