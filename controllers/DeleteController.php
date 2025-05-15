<?php
namespace Controllers;

use Models\Todo;
use Models\Database;

require_once __DIR__ . '/../models/Todo.php';
require_once __DIR__ . '/../models/Database.php';

class DeleteController {
    private $database;
    private $pdo;
    private $todoManager;

    public function __construct() {
        session_start();
        $this->database = new Database();
        $this->pdo = $this->database->connect();
        $this->todoManager = new Todo($this->pdo);
    }

    public function deleteTaskAction() {
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $id = (int)$_GET['id']; // تبدیل به عدد صحیح برای اطمینان

            if ($this->todoManager->deleteTask($id)) {
                header('Location: ../resources/views/HomeView.php?success=task_deleted'); // بازگشت با پیام موفقیت (اصلاح پیام)
                exit();
            } else {
                header('Location: ../resources/views/HomeView.php?error=delete_task_failed'); // بازگشت با پیام خطا در صورت عدم موفقیت در حذف
                exit();
            }
        } else {
            header('Location: ../resources/views/HomeView.php?error=invalid_id'); // بازگشت با پیام خطا برای ID نامعتبر
            exit();
        }
    }
}

// برای استفاده از کنترلر و فراخوانی متد
$controller = new DeleteController();
$controller->deleteTaskAction();

?>