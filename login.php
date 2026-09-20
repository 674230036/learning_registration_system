<?php
session_start();
require_once "classes/Auth.php";
if (Auth::check()) { header("Location: dashboard.php"); exit; }

$error = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        if ((new Auth())->login(trim($_POST["username"] ?? ""), $_POST["password"] ?? "")) {
            header("Location: dashboard.php");
            exit;
        }
        $error = "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง";
    } catch (Throwable $e) {
        $error = "ไม่สามารถเชื่อมต่อฐานข้อมูลได้";
    }
}
$title = "เข้าสู่ระบบ";
require "includes/header.php";
?>
<div class="row justify-content-center">
<div class="col-md-5">
<div class="card p-4">
<h3 class="fw-bold mb-3">🔐 เข้าสู่ระบบ</h3>
<?php if ($error): ?><div class="alert alert-danger auto-hide"><?= htmlspecialchars($error) ?></div><?php endif; ?>
<form method="post">
<label class="form-label">ชื่อผู้ใช้</label>
<input class="form-control mb-3" name="username" required>
<label class="form-label">รหัสผ่าน</label>
<input class="form-control mb-3" type="password" name="password" required>
<button class="btn btn-primary w-100">เข้าสู่ระบบ</button>
</form>
<div class="mt-3 small text-muted">
ทดสอบ: student / 123456
</div>
</div></div></div>
<?php require "includes/footer.php"; ?>
