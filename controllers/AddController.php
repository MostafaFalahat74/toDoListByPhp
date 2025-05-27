<?php
namespace Controllers;

use Models\Database;
use Models\Todo;
use Helpers\RedirectHelper;

class AddController {
//    private $todoManager;

//    public function __construct() {
//        $database = new Database();
//        $this->todoManager = new Todo($database);
//    }

    public function index() {
        require __DIR__ . '/../resources/views/AddView.php';
    }

    public function store() {
            $task = trim($_POST['task']);
            if (!empty($task)) {
                if ($this->todoManager->addTask($task))
                    RedirectHelper::redirect('/toDoList/?success=task_added');
                 else
                    RedirectHelper::redirect('/toDoList/add/?error=add_task_failed');
            } else {
                RedirectHelper::redirect('/toDoList/add/?error=empty_task');
            }

    }
}