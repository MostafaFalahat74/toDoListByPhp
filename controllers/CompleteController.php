<?php
namespace Controllers;

require_once __DIR__.'/../config/Security.php';
require_once __DIR__ . '/../models/Database.php';
require_once __DIR__ . '/../models/Todo.php';

use Models\Database;
use Models\Todo;

class CompleteController {
    private $database;
    private $pdo;
    private $todoManager;

    public function __construct() {
        session_start();
        $this->database = new Database();
        $this->pdo = $this->database->connect();
        $this->todoManager = new Todo($this->pdo);
    }

    public function completeTaskAction() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ../resources/views/login_process.php');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['completed'])) {
            $id = intval($_POST['id']);
            $completed = intval($_POST['completed']) ? 1 : 0;

            $this->todoManager->updateTaskStatus($id, $completed);
        }

        header('Location: ../resources/views/HomeView.php');
        exit();
    }
}

// برای استفاده از کنترلر و فراخوانی متد
$controller = new CompleteController();
$controller->completeTaskAction();

?>