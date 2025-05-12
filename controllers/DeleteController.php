<?php
namespace Controllers;
require_once __DIR__ . '/../vendor/autoload.php';
session_start();
use Models\Todo;
use Inc\Database;
$database = new Database();
$pdo = $database->connect();
$todoManager = new Todo($pdo);

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id']; // تبدیل به عدد صحیح برای اطمینان

    if ($todoManager->deleteTask($id)) {
        header('Location: ../resources/views/HomeView.php?success=task_added'); // بازگشت با پیام موفقیت
        exit();
    } else {
        header('Location:../resources/views/HomeView.php?error=delete_task_failed'); // بازگشت با پیام خطا در صورت عدم موفقیت در حذف
        exit();
    }
} else {
    header('Location:../resources/views/HomeView.php?error=invalid_id'); // بازگشت با پیام خطا برای ID نامعتبر
    exit();
}
?>