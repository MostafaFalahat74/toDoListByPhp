<?php

use Models\Database;
use Models\DatabaseInterface;
use Models\Todo;

require_once __DIR__ . '/../../models/Database.php';
require_once __DIR__ . '/../../models/Interfaces/DatabaseInterface.php';
require_once __DIR__ . '/../../models/Todo.php';


session_start(); // شروع جلسه در ابتدای فایل
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if (!isset($_SESSION['user_id'])) {
    // اگر کاربر لاگین نکرده است، به صفحه لاگین ریدایرکت شود
    header('Location: resources/views/loginView.php');
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
    <link rel="stylesheet" href="../../public/Style.css">
</head>
<body>
<h1>To-Do List</h1>

<ul>
    <?php if (empty($tasks)): ?>
        <li>هیچ وظیفه‌ای وجود ندارد.</li>
    <?php else: ?>
        <?php foreach ($tasks as $task): ?>
            <li>
                <form method="post" action="../../controllers/CompleteController.php" style="display:inline;">
                    <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                    <input type="hidden" name="completed" value="<?php echo $task['is_completed'] ? 0 : 1; ?>">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <input type="checkbox" onchange="this.form.submit()" <?php if ($task['is_completed']): ?>checked<?php endif; ?>>
                </form>

                <span class="<?php if ($task['is_completed']): ?>completed<?php endif; ?>"><?php echo htmlspecialchars($task['task']); ?></span>
                <div class="actions">
                    <a href="../../controllers/DeleteController.php?id=<?php echo $task['id']; ?>" class="delete">حذف</a>
                </div>
            </li>
        <?php endforeach; ?>
    <?php endif; ?>
</ul>

<a href="AddView.php" class="go_to_add_page">افزودن</a>
</body>
</html>