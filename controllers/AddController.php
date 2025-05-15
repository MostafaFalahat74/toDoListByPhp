<?php
namespace Controllers;

use Models\Database;
use Models\Todo;

class AddController {
    private $todoManager;

    public function __construct() {
        $database = new Database();
        $this->todoManager = new Todo($database->connect());
    }

    public function index() {
        // نمایش فرم افزودن وظیفه
        require __DIR__ . '/../resources/views/AddView.php';
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $task = trim($_POST['task']);
            if (!empty($task)) {
                if ($this->todoManager->addTask($task)) {
                    header('Location: /toDoList/?success=task_added');
                    exit();
                } else {
                    header('Location: /toDoList/add/?error=add_task_failed');
                    exit();
                }
            } else {
                header('Location: /toDoList/add/?error=empty_task');
                exit();
            }
        } else {
            header('Location: /toDoList/');
            exit();
        }
    }
}