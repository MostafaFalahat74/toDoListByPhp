<?php
namespace Controllers;
require_once __DIR__ . '/../vendor/autoload.php';
//require_once  __DIR__.'/../config/Security.php';
echo($_SESSION['csrf_token']);

exit();
use Models\Todo;
use Inc\Database;
$database = new Database();
$pdo = $database->connect();
$todoManager = new Todo($pdo);

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id']; // تبدیل به عدد صحیح برای اطمینان

    if ($todoManager->deleteTask($id)) {
        header('Location: ../index.php?success=task_added'); // بازگشت با پیام موفقیت
        exit();
    } else {
        header('Location: index.php?error=delete_task_failed'); // بازگشت با پیام خطا در صورت عدم موفقیت در حذف
        exit();
    }
} else {
    header('Location: index.php?error=invalid_id'); // بازگشت با پیام خطا برای ID نامعتبر
    exit();
}
?>