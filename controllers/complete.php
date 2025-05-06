<?php
require_once '../inc/Database.php';
require_once '../models/Todo.php';
require_once '../models/TodoRepositoryInterface.php';
$database = new Database();
$pdo = $database->getConnection();
$todoManager = new Todo($pdo);

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id']; // تبدیل به عدد صحیح برای اطمینان

    if ($todoManager->completeTask($id)) {
        header('Location: ../index.php?success=task_added'); // بازگشت با پیام موفقیت
        exit();
    } else {
        header('Location: index.php?error=complete_task_failed'); // بازگشت با پیام خطا در صورت عدم موفقیت در تکمیل
        exit();
    }
} else {
    header('Location: index.php?error=invalid_id'); // بازگشت با پیام خطا برای ID نامعتبر
    exit();
}
?>