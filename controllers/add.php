<?php
require_once '../inc/Database.php';
require_once '../models/Todo.php';
require_once '../models/TodoRepositoryInterface.php';
$database = new Database();
$pdo = $database->getConnection();
$todoManager = new Todo($pdo);

if (isset($_POST['task']) && !empty($_POST['task'])) {
    $task = $_POST['task'];

    if ($todoManager->addTask($task)) {
        header('Location: ../index.php?success=task_added'); // بازگشت به صفحه اصلی با پیام موفقیت
        exit();
    } else {
        header('Location: index.php?error=add_task_failed'); // بازگشت با پیام خطا در صورت عدم موفقیت در افزودن
        exit();
    }
} else {
    header('Location: index.php?error=empty_task'); // بازگشت با پیام خطا
    exit();
}
?>