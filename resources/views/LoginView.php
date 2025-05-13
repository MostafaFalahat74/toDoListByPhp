<?php

namespace resources\views;
//require_once __DIR__ . '/../../vendor/autoload.php';

session_start(); // شروع جلسه

use Models\User;
use Models\Database;

$database = new Database();
$pdo = $database->connect();
$user = new User($pdo);

$error = null; // متغیری برای ذخیره پیام خطا

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($user->login($username, $password)) {
        // ورود موفقیت‌آمیز، هدایت به صفحه اصلی یا داشبورد
        header('Location: ./HomeView.php'); // فرض بر این است که index.php در سطح ریشه پروژه است
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
    <link rel="stylesheet" href="../../public/Style.css">
</head>
<body>
<div class="login-container"> <h1>ورود</h1>
    <?php if ($error): ?>
        <p class="error-message"><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="post">
        <div class="form-group">
            <label for="username">نام کاربری:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">رمز عبور:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">ورود</button>
    </form>
</div> </body>
</html>