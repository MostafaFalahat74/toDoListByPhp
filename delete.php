<?php
require 'db.php';
require 'Todo.php';
$database = new Database();
$pdo = $database->getConnection();
$todoManager = new Todo($pdo);
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id']; // تبدیل به عدد صحیح برای اطمینان

    if ($todoManager->deleteTask($id)) {
        header('Location: index.php?success=task_deleted'); // بازگشت با پیام موفقیت
        exit();
    } else {
        header('Location: index.php?error=delete_task_failed'); // بازگشت با پیام خطا در صورت عدم موفقیت در حذف
        exit();
    }
} else {
    header('Location: index.php?error=invalid_id'); // بازگشت با پیام خطا برای ID نامعتبر
    exit();
}

header('Location: index.php'); // بازگشت به صفحه اصلی
exit();
?>