<?php
namespace Controllers;

use Models\Database;
use Models\Todo;
use Helpers\RedirectHelper;

class DeleteController {
    private $todoManager;
//
//    public function __construct() {
//        $database = new Database();
//        $this->todoManager = new Todo($database);
//    }

    public function destroy() {
        echo 'destroy';
//        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
//            $id = (int)$_GET['id'];
//            if ($this->todoManager->deleteTask($id))
//                RedirectHelper::redirect('/toDoList/?success=task_deleted');
//             else
//                RedirectHelper::redirect('/toDoList/?error=delete_task_failed');
//
//        } else
//            RedirectHelper::redirect('/toDoList/?error=invalid_id');
    }
}