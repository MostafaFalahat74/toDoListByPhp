<?php
namespace Controllers;

require_once __DIR__.'/../config/Security.php';
require_once __DIR__ . '/../models/Database.php';
require_once __DIR__ . '/../models/Todo.php';
use Models\Database;
use Models\Todo;

class AddController {
    private $database;
    private $pdo;
    private $todoManager;

    public function __construct() {
        session_start();
        $this->database = new Database();
        $this->pdo = $this->database->connect();
        $this->todoManager = new Todo($this->pdo);
    }

    public function addTaskAction() {
        if (isset($_POST['task']) && !empty($_POST['task'])) {
            $task = $_POST['task'];

            if ($this->todoManager->addTask($task)) {
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
    }
}

// برای استفاده از کنترلر و فراخوانی متد
$controller = new AddController();
$controller->addTaskAction();

?>