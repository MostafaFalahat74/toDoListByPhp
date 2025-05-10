<?php
require_once __DIR__ . '/vendor/autoload.php';

use Inc\Database;
use Models\User;
use Models\DatabaseInterface;
use Models\Todo;
session_start(); // شروع جلسه در ابتدای فایل

if (!isset($_SESSION['user_id'])) {
    // اگر کاربر لاگین نکرده است، به صفحه لاگین ریدایرکت شود
    header('Location: inc/login_process.php');
    exit();
}

$database = new Database();
$pdo = $database->connect();
$todoManager = new Todo($pdo);
$tasks = $todoManager->getAllTasks();
?>

<!DOCTYPE html>
<html>
<head>
    <title>To-Do List</title>
    <link rel="stylesheet" href="public/Style.css">
</head>
<body>
<h1>To-Do List</h1>

<ul>
    <?php if (empty($tasks)): ?>
        <li>هیچ وظیفه‌ای وجود ندارد.</li>
    <?php else: ?>
        <?php foreach ($tasks as $task): ?>
            <li>
                <input type="checkbox" <?php if ($task['is_completed']): ?>checked<?php endif; ?> onclick="window.location='controllers/complete.php?id=<?php echo $task['id']; ?>'">
                <span class="<?php if ($task['is_completed']): ?>completed<?php endif; ?>"><?php echo htmlspecialchars($task['task']); ?></span>
                <div class="actions">
                    <a href="controllers/delete.php?id=<?php echo $task['id']; ?>" class="delete">حذف</a>
                </div>
            </li>
        <?php endforeach; ?>
    <?php endif; ?>
</ul>

<form action="controllers/add.php" method="post">
    <input type="text" name="task" placeholder="افزودن وظیفه جدید" required>
    <button type="submit">افزودن</button>
</form>
</body>
</html>