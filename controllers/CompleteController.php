<?php

require_once  __DIR__.'/../config/Security.php';

use Models\Database;
use Models\Todo;

require_once __DIR__ . '/../models/Database.php';
require_once __DIR__ . '/../models/Todo.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../resources/views/login_process.php');
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['completed'])) {
    $id = intval($_POST['id']);
    $completed = intval($_POST['completed']) ? 1 : 0;


    $database = new Database();
    $pdo = $database->connect();
    $todo = new Todo($pdo);

    $todo->updateTaskStatus($id, $completed);
}

header('Location: ../resources/views/HomeView.php');
exit();
