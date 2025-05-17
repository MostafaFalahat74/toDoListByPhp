<?php
namespace Controllers;

use Models\Database;
use Models\Todo;

class DeleteController {
    private $todoManager;

    public function __construct() {
        $database = new Database();
        $this->todoManager = new Todo($database);
    }

    public function destroy() {
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $id = (int)$_GET['id'];
            if ($this->todoManager->deleteTask($id)) {
                header('Location: /toDoList/?success=task_deleted');
                exit();
            } else {
                header('Location: /toDoList/?error=delete_task_failed');
                exit();
            }
        } else {
            header('Location: /toDoList/?error=invalid_id');
            exit();
        }
    }
}