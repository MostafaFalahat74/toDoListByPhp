<?php
require_once __DIR__ . '/../vendor/autoload.php';
use Inc\Database;
use Models\Todo;

session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: inc/login_process.php');
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die("توکن CSRF نامعتبر است");
    }

    $database = new Database();
    $pdo = $database->connect();
    $todoManager = new Todo($pdo);

    $task = trim($_POST['task']);
    if (!empty($task)) {
        $todoManager->addTask($task); // مطمئن شو این متد در کلاس Todo هست
    }
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>افزودن وظیفه</title>
    <link rel="stylesheet" href="../public/Style.css">
</head>
<body>
<div class="add-task-container">
    <h1>افزودن وظیفه جدید</h1>
    <form action="add_task.php" method="post" class="add-task-form">
        <input type="text" name="task" placeholder="افزودن وظیفه جدید" required>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <button type="submit">افزودن</button>
    </form>
    <a href="../index.php" class="back-link">بازگشت به لیست</a>
</div>
</body>
</html>
