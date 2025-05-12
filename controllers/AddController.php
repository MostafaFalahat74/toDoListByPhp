<?php
namespace Controllers;
session_start();
require_once __DIR__ . '/../vendor/autoload.php';
require_once  __DIR__.'/../config/Security.php';
use Inc\Database;
use Models\Todo;


$database = new Database();
$pdo = $database->connect();
$todoManager = new Todo($pdo);

if (isset($_POST['task']) && !empty($_POST['task'])) {
    $task = $_POST['task'];

    if ($todoManager->addTask($task)) {
        header('Location: ../resources/views/HomeView.php?success=task_added'); // بازگشت به صفحه اصلی با پیام موفقیت
        exit();
    } else {
        header('Location: ../resources/views/HomeView.php?error=add_task_failed'); // بازگشت با پیام خطا در صورت عدم موفقیت در افزودن
        exit();
    }
} else {
    header('Location: ../resources/views/HomeView.php?error=empty_task'); // بازگشت با پیام خطا
    exit();
}
?>