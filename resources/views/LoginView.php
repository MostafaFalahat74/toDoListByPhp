<?php

namespace resources\views;

session_start(); 
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf = $_SESSION['csrf_token'];
use Models\User;
use Models\Database;
require_once __DIR__ . '/../../models/User.php';
require_once __DIR__ . '/../../models/Database.php';

$database = new Database();
$user = new User($database);

$error = null; // متغیری برای ذخیره پیام خطا

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($user->login($username, $password)) {
        // ورود موفقیت‌آمیز، هدایت به صفحه اصلی یا داشبورد
        header('Location: /toDoList/');
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
    <link rel="stylesheet" href="/toDoList/public/Style.css">
</head>
<body>
<div class="login-container"> <h1>ورود</h1>
    <?php if ($error): ?>
        <p class="error-message"><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="post" action="/toDoList/login/">
        <div class="form-group">
            <label for="username">نام کاربری:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">رمز عبور:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <button type="submit">ورود</button>
    </form>
</div> </body>
</html>