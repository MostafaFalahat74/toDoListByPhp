<?php
session_start(); // شروع جلسه

require_once './Database.php'; // فایل db.php در همین پوشه (inc/) قرار دارد
require_once '../models/User.php'; // از پوشه فعلی (inc/) یک سطح به عقب رفته و سپس وارد پوشه models/ شوید
require_once '../models/DatabaseInterface.php';
// ایجاد اتصال به پایگاه داده و شیء User
$database = new Database();
$pdo = $database->connect();
$user = new User($pdo);

$error = null; // متغیری برای ذخیره پیام خطا

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($user->login($username, $password)) {
        // ورود موفقیت‌آمیز، هدایت به صفحه اصلی یا داشبورد
        header('Location: ../index.php'); // فرض بر این است که index.php در سطح ریشه پروژه است
        exit();
    } else {
        // ورود ناموفق، تنظیم پیام خطا
        $error = 'نام کاربری یا رمز عبور اشتباه است.';
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>ورود</title>
</head>
<body>
    <h1>ورود</h1>
    <?php if ($error): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="post">
        <div>
            <label for="username">نام کاربری:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <br>
        <div>
            <label for="password">رمز عبور:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <br>
        <button type="submit">ورود</button>
    </form>
</body>
</html>