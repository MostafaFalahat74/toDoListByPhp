<?php
namespace Controllers;

use Models\Database;
use Models\Todo;

class HomeController
{
    private $todoManager;

    public function __construct()
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: /toDoList/login/');
            exit();
        }
        $database = new Database();
        $this->todoManager = new Todo($database);
    }

    public function index()
    {
       
        $tasks = $this->todoManager->getAllTasks();
       require_once __DIR__ . '/../resources/views/HomeView.php'; 
    }
}