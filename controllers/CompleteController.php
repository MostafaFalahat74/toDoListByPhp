<?php
namespace Controllers;

use Models\Database;
use Models\Todo;
use Helpers\RedirectHelper;

class CompleteController {
    private $todoManager;

    public function __construct() {
        $database = new Database();
        $this->todoManager = new Todo($database);
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['completed'])) {
            $id = intval($_POST['id']);
            $completed = intval($_POST['completed']) ? 1 : 0;
            $this->todoManager->updateTaskStatus($id, $completed);
        }
        RedirectHelper::redirect('/toDoList/');
    }
}