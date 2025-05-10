<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Inc\Database;
use Models\Todo;

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../inc/login_process.php');
    exit();
}
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    die('درخواست نامعتبر (CSRF token).');
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['completed'])) {
    $id = intval($_POST['id']);
    $completed = intval($_POST['completed']) ? 1 : 0;


    $database = new Database();
    $pdo = $database->connect();
    $todo = new Todo($pdo);

    $todo->updateTaskStatus($id, $completed);
}

header('Location: ../index.php');
exit();
