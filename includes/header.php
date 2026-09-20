<?php
require_once __DIR__ . "/../classes/Auth.php";
if (session_status() === PHP_SESSION_NONE) session_start();
$user = Auth::user();
?>
<!doctype html>
<html lang="th">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= htmlspecialchars($title ?? "ระบบลงทะเบียนเรียน") ?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.php">🎓 ระบบลงทะเบียนเรียน</a>
    <div class="d-flex align-items-center gap-2">
      <?php if ($user): ?>
        <a class="btn btn-light btn-sm" href="dashboard.php">หน้าหลัก</a>
        <a class="btn btn-outline-light btn-sm" href="courses.php">รายวิชา</a>
        <span class="text-white small"><?= htmlspecialchars($user["name"]) ?></span>
        <a class="btn btn-warning btn-sm" href="logout.php">ออกจากระบบ</a>
      <?php else: ?>
        <a class="btn btn-light btn-sm" href="login.php">เข้าสู่ระบบ</a>
      <?php endif; ?>
    </div>
  </div>
</nav>
<main class="container py-4">
