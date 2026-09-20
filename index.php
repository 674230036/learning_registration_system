<?php
session_start();
$title = "หน้าแรก";
require "includes/header.php";
?>
<div class="hero mb-4">
  <h1 class="fw-bold">ระบบจัดการการเรียนและลงทะเบียนรายวิชา</h1>
  <p class="mb-0">จัดการรายวิชา การลงทะเบียน และข้อมูลการเรียนผ่านเว็บไซต์</p>
</div>
<div class="row g-4">
  <div class="col-md-4"><div class="card p-4 h-100"><h4>📚 รายวิชา</h4><p>ดูรายวิชาที่เปิดลงทะเบียนและจำนวนที่นั่ง</p></div></div>
  <div class="col-md-4"><div class="card p-4 h-100"><h4>📝 ลงทะเบียน</h4><p>เลือกและลงทะเบียนรายวิชาที่ต้องการเรียน</p></div></div>
  <div class="col-md-4"><div class="card p-4 h-100"><h4>📊 ข้อมูลการเรียน</h4><p>ดูรายวิชาที่ลงทะเบียนและข้อมูลการเรียนของตนเอง</p></div></div>
</div>
<?php require "includes/footer.php"; ?>
